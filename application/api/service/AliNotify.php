<?php
/**
 * Created by 七月
 * Author: 七月
 * 微信公号: 小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/28
 * Time: 18:12
 */

namespace app\api\service;

use app\api\model\Order;
use app\api\model\User;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;
Loader::import('appalipay.aop.AopClient', EXTEND_PATH, '.php');

class AliNotify
{

    public function NotifyProcess()
    {
        $alipay_config=config('secure.alipay');
        $aop = new \AopClient();
        $aop->alipayrsaPublicKey = $alipay_config['public_key'];//'请填写支付宝公钥，一行字符串'
        $flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");
        Log::write("[".date("Y-m-d H:i:s",time())."-支付宝支付]:【校验rsa通知】: flag:".$flag."\n".json_encode($_POST));
        if($flag){
            $parameter['out_trade_no'] = $_POST['out_trade_no'];//订单id
            $parameter['subject'] = $_POST['subject'];//商品名称
            $parameter['trade_no'] = $_POST['trade_no'];//支付宝交易号
            $parameter['trade_status'] = $_POST['trade_status'];//交易状态
            $parameter['total_fee'] = $_POST['total_amount'];//交易金额
            $parameter['notify_time'] = $_POST['notify_time'];//支付时间
            if ($parameter['trade_status'] == 'TRADE_SUCCESS') {
                $orderNo = $parameter['out_trade_no'];
                Db::startTrans();
                $orderM = new Order();
                try {
                    $order = $orderM->where(['order_no'=> $orderNo])->lock(true)->find();
                    if ($order->pay_status == OrderStatusEnum::UNPAID) {
                        //修改状态
                        $update['pay_status'] = OrderStatusEnum::PAID;
                        $update['pay_amount'] = (float)$parameter['total_fee']/100;
                        $update['pay_way'] = 2;
                        $update['pay_time'] = strtotime($parameter['notify_time']);
                        $res = $orderM->update($update,['id'=>$order->id]);
                        if($res!==false){
                            //记账
                            Pay::savePayRecord($order);
                            //发信息
                            if($order->userid){
                                $users = User::getAllByData(['house_id'=>$order->house_id],['id','mobile','property_id','house_id']);
                                $content = '您的订单'.$order->order_no.'已支付成功，祝您生活愉快！';
                                Message::sendMsg($users,$content,$order->id,1);

                            }
                        }
                    }
                    Db::commit();
                } catch (Exception $ex) {
                    Db::rollback();
                    Log::error($ex);
                    // 如果出现异常，向微信返回false，请求重新发送通知
                    return false;
                }
            }else{
                Log::write("[".date("Y-m-d H:i:s",time())."-支付宝支付]:【支付宝支付出错】:".$parameter['trade_status']);
            }
        }
        return true;
    }

}