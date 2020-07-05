<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/26
 * Time: 16:02
 */

namespace app\api\service;


use app\api\model\Order as OrderModel;
use app\api\model\OrderFee;
use app\api\model\PayRecord;
use app\api\model\Quarter;
use app\api\model\User;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\AliyunException;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;
use WxPay\WxAppPay;

//Loader::import('WxPay.WxPay', EXTEND_PATH, '.Data.php');
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');
Loader::import('appalipay.aop.AopClient', EXTEND_PATH, '.php');
Loader::import('appalipay.aop.request.AlipayTradeAppPayRequest', EXTEND_PATH, '.php');


class Pay
{
    private $orderNo;
    private $orderID;
    private $orderTotalPrice;
    private $orderTitle;
    private $orderUserid;
//    private $orderModel;

    function __construct($orderID)
    {
        if (!$orderID)
        {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

//
//    public function pay()
//    {
//        $this->checkOrderValid();
//        $order = new Order();
//        $status = $order->checkOrderStock($this->orderID);
//        if (!$status['pass'])
//        {
//            return $status;
//        }
//        return $this->makeWxPreOrder($status['orderPrice']);
//        //        $this->checkProductStock();
//    }

    public function Pay()
    {
        $this->checkOrderValid();
        return $this->makeWxPreOrder();
    }

    public function wxAppPay()
    {
        $this->checkOrderValid();
        return $this->makeWxPreOrderForWxApp();
    }
    
    public function aliAppPay()
    {
        $this->checkOrderValid();
        return $this->makeWxPreOrderForAliApp();
    }
    // 构建微信支付订单信息
    private function makeWxPreOrder()
    {
        $openid = Token::getCurrentTokenVar('openid');

        if (!$openid){
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($this->orderTotalPrice * 100);
        $wxOrderData->SetBody($this->orderTitle);
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));

        return $this->getPaySignature($wxOrderData);
    }

    // 构建微信支付订单信息
    private function makeWxPreOrderForWxApp()
    {
        $params['body'] = $this->orderTitle;                       //商品描述
        $params['out_trade_no'] = $this->orderNo;    //自定义的订单号
        $params['total_fee'] = $this->orderTotalPrice * 100;       //订单金额 只能为整数 单位为分
        $params['trade_type'] = 'APP';
        $option = config('secure.wxpay');
        $wxAppPay = new wxAppPay($option);   //交易类型 JSAPI | NATIVE | APP | WAP
        $result = $wxAppPay->unifiedOrder( $params );
        if($result['return_code']=='SUCCESS'){
            $data = @$wxAppPay->getAppPayParams( $result['prepay_id'] );
            $this->recordPreOrder($result);
            return $data;
        }else{
            Log::record(json_encode($result),'error');
            Log::record('获取预支付订单失败','error');
            throw new Exception('获取预支付订单失败');
        }
    }

    //向微信请求订单号并生成签名
    private function getPaySignature($wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
            throw new Exception('获取预支付订单失败');
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
    }

    private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        OrderModel::update(['prepay_id' => $wxOrder['prepay_id'],'userid'=>$this->orderUserid],['id'=>$this->orderID]);
    }

    // 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }

    /**
     * @return bool
     * @throws OrderException
     * @throws TokenException
     */
    private function checkOrderValid()
    {
        $order = self::checkOrder($this->orderID);
        $currentUid = Token::getCurrentUid();
        self::isValidHouse($currentUid,$order->house_id);
        if($order->pay_status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg' => '订单已支付',
                'error_code' => 60001,
                'code' => 400
            ]);
        }
        $this->orderNo = $order->order_no;
        $this->orderTotalPrice = $order->total_price;
        $this->orderTitle = $order->title;
        $this->orderUserid = $currentUid;
        return true;
    }

    protected static function isValidHouse($uid,$house_id)
    {
        $user = Identify::checkAuditUser($uid);
        if($user->house_id != $house_id){
            throw new OrderException([
                'msg'=>'订单对应的住址与用户住址不匹配',
                'error_code'=>1000
            ]);
        }
    }

    public static function checkOrder($order_id)
    {
        $order = OrderModel::getNormalOneById($order_id);
        if (!$order){
            throw new OrderException();
        }
        return $order;
    }

    private function makeWxPreOrderForAliApp()
    {
        $alipay_config=config('secure.alipay');
        $aop = new \AopClient;
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = $alipay_config['app_id'];
        $aop->rsaPrivateKey = file_get_contents($alipay_config['private_key']);//私钥
        $aop->rsaPrivateKeyFilePath = $alipay_config['private_key'];//私钥路径
        $aop->format = $alipay_config['format'];
        $aop->charset = $alipay_config['input_charset'];
        $aop->signType = $alipay_config['signType'];
        $aop->alipayrsaPublicKey = $alipay_config['public_key'];//公钥
//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
        $request = new \AlipayTradeAppPayRequest();
//SDK已经封装掉了公共参数，这里只需要传入业务参数
        $bizcontent = json_encode([
            'body'=>$this->orderTitle,//商品描述，可空
            'subject'=>$this->orderTitle,//订单名称，必填
            'out_trade_no'=>$this->orderNo,
            'total_amount'=>$this->orderTotalPrice,
            'timeout_express'=>'30m',
            'product_code'=>'QUICK_MSECURITY_PAY',
        ]);
        $request->setNotifyUrl($alipay_config['notify_url']);
        $request->setBizContent($bizcontent);
//这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->sdkExecute($request);
//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题

        if(!$response){
            throw new AliyunException();
        }
        return $response;//就是orderString 可以直接给客户端请求，无需再做处理。
    }


    public static function savePayRecord($order)
    {
        $carts = (new OrderFee())->where(['order_id'=>$order->id])->select();
        if(!empty($carts)){
            foreach ($carts as $cart) {
                $p_data['property_id'] = $order->property_id;
                $p_data['quarter_id'] = Quarter::getTopOne($order->house_id)->id;
                $p_data['userid'] = $order->userid;
                $p_data['amount'] = $cart->fee_snapshot['price'] * $cart->count;
                $p_data['title'] = date('Y年m月',$cart->getData('create_time')).$cart->fee_snapshot['name'];
                $p_data['order_fee_id'] = $cart->id;
                PayRecord::create($p_data,true);
            }
        }
    }
}