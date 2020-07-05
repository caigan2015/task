<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Business;
use app\api\model\Order as OrderModel;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderCommit;
use app\api\validate\OrderGet;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\BusinessException;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use app\lib\exception\UserException;
use think\Controller;
use think\Exception;
use think\Request;

class Order extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder,orderCommit,orderCancel,orderClose'],
        'checkPrimaryScope' => ['only' => 'getDetail,getSummaryByUser'],
//        'checkSuperScope' => ['only' => 'delivery,getSummary']
    ];

    /**
     * 简单的业务订单提交
     * @return $this|mixed
     * @throws BusinessException
     * @throws Exception
     * @throws \app\lib\exception\ParameterException
     */
    public function orderCommit()
    {
        (new OrderCommit())->goCheck();
        $data = input('post.');
        $uid = Token::getCurrentUid();
        $user = UserModel::getNormalOneById($uid,['id','mobile']);
        if(!$user){
            throw new UserException();
        }
        if(!$user->mobile){
            throw new UserException([
                'error_code'=>10011,
                'msg'=>'请先绑定手机号码'
            ]);
        }
        //是否绑定手机
        $business = Business::getNormalOneById($data['business_id']);
        if(!$business){
            throw new BusinessException();
        }

        $save['business_id'] = $business->id;
        $save['count'] = 1;
        $save['price'] = $business->price;
        $save['total_price'] = $business->price*1;
        $save['name'] = !empty($data['name'])?$data['name']:$business->title;
        $save['order_no'] = OrderService::makeOrderNo();
        $save['user_id'] = $uid;
        $save['snap_items'] = json_encode($business->toArray());

        $order = OrderModel::create($save);
        if(!$order){
            throw new Exception('创建订单失败');
        }

        return new SuccessReturn([
            'info'=>$order->visible(['id','order_no','total_price','name','create_time'])->toArray()
        ]);
//        return $order->visible(['id','order_no','total_price','name','create_time'])->toArray();
    }

    /**
     * 取消订单
     * @param $id
     * @throws Exception
     * @throws OrderException
     * @throws SuccessMessage
     */
    public function orderCancel()
    {
        (new IDMustBePositiveInt())->goCheck();

        $id = Request::instance()->post('id');
        $order = OrderService::checkOrder($id);

        if($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'code' => 400,
                'msg' => '对不起！订单不允许取消',
                'error_code' => 60002
            ]);
        }
        $res = OrderModel::update(['status'=>OrderStatusEnum::CANCELED],['id'=>$id]);
        if(!$res){
            throw new Exception('取消订单失败');
        }
        return new SuccessMessage();
        
    }
    /**
     * 关闭订单
     * @param $id
     * @throws Exception
     * @throws OrderException
     * @throws SuccessMessage
     */
    public function orderClose()
    {
        (new IDMustBePositiveInt())->goCheck();

        $id = Request::instance()->post('id');
        $order = OrderService::checkOrder($id);
        if($order->status != OrderStatusEnum::CANCELED){
            throw new OrderException([
                'code' => 400 ,
                'msg' => '对不起！订单不允许关闭',
                'error_code' => 60003
            ]);
        }
        $res = OrderModel::update(['status'=>OrderStatusEnum::CLOSED],['id'=>$id]);
        if(!$res){
            throw new Exception('关闭订单失败');
        }
        return new SuccessMessage();

    }
    /**
     * 从购物车下单
     * @url /order
     * @HTTP POST
     */
    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = Token::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $products);

        return new SuccessReturn([
            'info'=>$status
        ]);
//        return $status;
    }

    /**
     * 获取订单详情
     * @param $id
     * @return static
     * @throws OrderException
     * @throws \app\lib\exception\ParameterException
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $uid = Token::getCurrentUid();
        $house_id = User::getDataValue(['id'=>$uid],'house_id');
        $order = OrderModel::getDetail(['id'=>$id,'house_id'=>$house_id]);
        if (!$order)
        {
            throw new OrderException([
                'msg'=>'订单不存在或订单与用户住址信息不符'
            ]);
        }

        $order->append(['pay_way_text','pay_time_text','pay_status_text','expenditure_date']);

        return new SuccessReturn([
            'info'=>$order
        ]);
//        return $order;
    }

    /**
     * 根据用户id分页获取订单列表（简要信息）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummaryByUser($page = 1, $size = 15)
    {
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $house_id = User::getDataValue(['id'=>$uid],'house_id');
        $pagingOrders = OrderModel::getSummaryByData(['house_id'=>$house_id],['id','title','pay_amount','pay_way','pay_time','pay_status','create_time','total_price'], $page, $size);
        if ($pagingOrders->isEmpty())
        {
            $pagingOrders = [
                'current_page' => $pagingOrders->currentPage(),
                'total' => $pagingOrders->total(),
                'data' => []
            ];
        }else{
            $pagingOrders->append(['pay_way_text','pay_status_text','pay_time_text','year','month']);
        }
        
        return new SuccessReturn([
            'info'=>$pagingOrders
        ]);
//        return $pagingOrders;
    }

    /**
     * 获取全部订单简要信息（分页）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummary($page=1, $size = 20){
        (new PagingParameter())->goCheck();
//        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if ($pagingOrders->isEmpty())
        {
            $pagingOrders = [
                'current_page' => $pagingOrders->currentPage(),
                'total' => $pagingOrders->total(),
                'data' => []
            ];
        }else{
            $pagingOrders->append(['pay_way_text','pay_status_text','year','month'])->visible(['id','title','pay_amount','pay_way','pay_time','pay_status','create_time']);
        }
        return new SuccessReturn([
            'info'=>$pagingOrders
        ]);
//        return $pagingOrders->visible(['id','title','pay_amount','pay_way','pay_time','pay_status','create_time']);
    }

    /**
     * @param $date
     * @return SuccessReturn
     * @throws OrderException
     */
    public function getDetailByDate()
    {
        (new OrderGet())->goCheck();
        $uid = Token::getCurrentUid();
        $date = Request::instance()->param('date',date('Y-m'));
        $startTime = strtotime($date.'-01');
        $lastDay = date('t',$startTime);
        $endTtime = strtotime($date.'-'.$lastDay);

        $house_id = User::getDataValue(['id'=>$uid],'house_id');

        $order = OrderModel::getDetail(['create_time'=>['between',[$startTime,$endTtime]],'house_id'=>$house_id]);
        if (!$order)
        {
            $order_period = Quarter::getTopOne($house_id,['order_period'])->order_period;
            $order_period = getPeriodDay($order_period);
            $order['period'] = OrderService::getOrderPeriod($date,$order_period);
            $order['expenditure_date'] =  date('Y年m月d日',strtotime($date.'-'.$order_period));
//            $order['titile'] = Quarter::getBreads($house_id).date('Y年m月',$startTime).'物业费';
            throw new OrderException([
                'msg'=>'订单未出账或不存在,请检查订单日期',
                'info'=>$order
            ]);
        }

        $order->append(['pay_way_text','pay_time_text','pay_status_text','expenditure_date']);

        return new SuccessReturn([
            'info'=>$order
        ]);
//        return $order;
    }
}






















