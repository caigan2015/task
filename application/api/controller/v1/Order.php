<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Offer as OfferModel;
use app\api\model\Order as OrderModel;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderCommit;
use app\api\validate\OrderGet;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\api\validate\PriceCommit;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\BusinessException;
use app\lib\exception\OfferException;
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
    ];

    /**
     */
    public function orderCommit()
    {
        (new OrderCommit())->goCheck();
        $data = input('post.');
        $uid = Token::getCurrentUid();
        $user = UserModel::getNormalOneById($uid);
        if(!$user){
            throw new UserException();
        }
        //是否绑定手机
        $offer = OfferModel::getOneByData(['id' =>$data['offer_id']]);
        if(!$offer){
            throw new OfferException();
        }

        $save['order_no'] = OrderService::makeOrderNo();
        $save['offer_id'] = $offer->id;
        $save['user_id'] = $uid;
        $save['snap_items'] = json_encode($offer->toArray());
        $order = OrderModel::create($save);
        if(!$order){
            throw new Exception('创建订单失败');
        }

        return new SuccessReturn([
            'info'=>$order->hidden(['snap_items'])
        ]);
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

        if($order->status >= OrderStatusEnum::CONFIRM_PAID){
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
        $order->status = OrderStatusEnum::CLOSED;
        $res = $order->save();
        if(!$res){
            throw new Exception('关闭订单失败');
        }
        return new SuccessMessage();

    }

    public function priceCommit()
    {
        (new PriceCommit())->goCheck();
        $data = Request::instance()->post();
        $order = OrderService::checkOrderQuote($data);
        $res = $order->save();
        if(!$res){
            throw new Exception('pirce commit fail');
        }
        return new SuccessMessage();
    }

    /**
     * @return SuccessMessage
     * @throws Exception
     */
    public function priceConfirm()
    {
        (new IDMustBePositiveInt())->goCheck();

        $data = Request::instance()->post();
        $order = OrderService::checkOrderQuote($data,1);
        $res = $order->save();
        if(!$res){
            throw new Exception('confirm fail');
        }
        return new SuccessMessage();
    }

    public function taskDone()
    {
        (new IDMustBePositiveInt())->goCheck();

        $id = Request::instance()->post('id');
        $order = OrderService::checkOrder($id);
        if($order->status != OrderStatusEnum::CONFIRM_PAID){
            throw new OrderException([
                'code' => 400 ,
                'msg' => '对不起！金額を確認しません',
                'error_code' => 60003
            ]);
        }
        $order->status = OrderStatusEnum::TASK_DONE;
        $res = $order->save();
        if(!$res){
            throw new Exception('task done fail');
        }
        return new SuccessMessage();
    }

    /**
     * @param $id
     * @return SuccessReturn
     * @throws OrderException
     */
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $uid = Token::getCurrentUid();
        $order = OrderModel::getDetail(['id'=>$id,'user_id'=>$uid]);
        if (!$order)
        {
            throw new OrderException([
                'msg'=>'订单不存在或订单与用户住址信息不符'
            ]);
        }

        $order->append(['pay_way_text']);

        return new SuccessReturn([
            'info'=>$order
        ]);
    }

    /**
     * @param int $page
     * @param int $size
     * @return SuccessReturn
     */
    public function getSummaryByUser($page = 1, $size = 1)
    {
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByData(['user_id'=>$uid],[],true, $page, $size);
        if ($pagingOrders->isEmpty())
        {
            $pagingOrders = [
                'current_page' => $pagingOrders->currentPage(),
                'total' => $pagingOrders->total(),
                'data' => []
            ];
        }else{
            $pagingOrders->append(['pay_way_text']);
        }
        
        return new SuccessReturn([
            'info'=>$pagingOrders
        ]);
    }

}






















