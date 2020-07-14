<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Offer as OfferModel;
use app\api\model\Order as OrderModel;
use app\api\model\Chatting as ChattingModel;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderCommit;
use app\api\validate\OrderGet;
use app\api\validate\PagingParameter;
use app\api\validate\PriceCommit;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OfferException;
use app\lib\exception\OrderException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use phpmailer\Email;
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
        //
        $offer = OfferModel::getOneByData(['id' => $data['offer_id']]);
        if (!$offer) {
            throw new OfferException();
        }
        //
        OrderService::checkOrderCommit($data['offer_id'], $uid);
        $save['order_no'] = OrderService::makeOrderNo();
        $save['offer_id'] = $offer->id;
        $save['user_id'] = $uid;
        $save['snap_items'] = json_encode($offer->toArray());
        $order = OrderModel::create($save);
//        $order->user = $user->visible(['id','username','head_img']);
//        $order->offer = $offer->append(['request_type_text'])->hidden(['category_id', 'update_time', 'request_type', 'status']);
        $mail = UserModel::getDataValue(['id'=>$offer->user_id],'e_mail');
        Email::send($mail,$offer->title,'SOMEBODY APPLY.');
        return new SuccessReturn([
            'info' => ['order_id' => $order->id]
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
        $id = Request::instance()->param('id');
        $order = OrderService::checkOrder($id,1);
        $mail = $order->mail;
        $title = $order->title;
        unset($order->mail);
        unset($order->title);
        if ($order->status == OrderStatusEnum::CANCELED) {
            return new SuccessMessage();
        }
        if ($order->status >= OrderStatusEnum::CONFIRM_PAID) {
            throw new OrderException([
                'code' => 400,
                'msg' => 'ごめんなさい！ 注文は進行中です。キャンセルはできません',
                'error_code' => 60002
            ]);
        }
        $order->status = OrderStatusEnum::CANCELED;
        $order->save();
        Email::send($mail,$title,'ORDERCANCEL.');
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
        $id = Request::instance()->param('id');
        $order = OrderService::checkOrder($id,0);
        if ($order->status == OrderStatusEnum::CLOSED) {
            return new SuccessMessage();
        }
        if ($order->status != OrderStatusEnum::CANCELED) {
            throw new OrderException([
                'msg' => 'ごめんなさい！ 注文は進行中です、閉鎖は許可されていません',
                'error_code' => 60003
            ]);
        }
        $order->status = OrderStatusEnum::CLOSED;
        $order->save();
        return new SuccessMessage();

    }

    /**
     * @return SuccessMessage
     * @throws Exception
     */
    public function priceCommit()
    {
        (new PriceCommit())->goCheck();
        $data = Request::instance()->post();
        $order = OrderService::checkOrderQuote($data);
        $mail = $order->mail;
        $title = $order->title;
        unset($order->mail);
        unset($order->title);
        $order->save();
        Email::send($mail,$title,'priceCommit');
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
        $order = OrderService::checkOrderQuote($data, 1);
        $mail = $order->mail;
        $title = $order->title;
        unset($order->mail);
        unset($order->title);
        $res = $order->save();
        if (!$res) {
            throw new Exception('confirm fail');
        }
        Email::send($mail,$title,'priceConfirm');
        return new SuccessMessage();
    }

    public function taskDone()
    {
        (new IDMustBePositiveInt())->goCheck();

        $id = Request::instance()->post('id');
        $order = OrderService::checkOrder($id, 0);
        $mail = $order->mail;
        $title = $order->title;
        unset($order->mail);
        unset($order->title);
        if ($order->status != OrderStatusEnum::CONFIRM_PAID) {
            throw new OrderException([
                'msg' => 'ごめんなさい！ 金額確認しません',
                'error_code' => 60008
            ]);
        }
        $order->status = OrderStatusEnum::TASK_DONE;
        $res = $order->save();
        if (!$res) {
            throw new Exception('task done fail');
        }
        Email::send($mail,$title,'task done.');
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
        $order = OrderModel::getDetail(['id' => $id, 'user_id' => $uid]);
        if (!$order) {
            throw new OrderException();
        }

        $order->offer->append(['request_type_text'])->hidden(['category_id', 'update_time', 'request_type', 'order_no', 'status']);
        $order->messages = ChattingModel::getSummary(['order_id' => $id], ['user_id', 'user_type', 'content', 'file', 'create_time']);
        return new SuccessReturn([
            'info' => $order->append(['status_text'])->hidden(['order_no'])
        ]);
    }

    /**
     * @param int $page
     * @param int $size
     * @return SuccessReturn
     */
    public function getSummaryByUser($page = 1, $size = 20)
    {
        (new PagingParameter())->goCheck();
        (new OrderGet())->goCheck();
        $uid = Token::getCurrentUid();
        $my_offer_ids = OfferModel::getDataColumn(['user_id' => $uid], 'id');
        //todo 検索
        $data = $this->request->post();
        $query = 'user_id = ' . $uid . ' OR offer_id IN (' . implode(',', $my_offer_ids) . ')';
        $pagingOrders = OrderModel::getSummaryByData($data, $query, [], true, $page, $size);
        if ($pagingOrders->isEmpty()) {
            $pagingOrders = [
                'current_page' => $pagingOrders->currentPage(),
                'total' => $pagingOrders->total(),
                'data' => []
            ];
        } else {
            foreach ($pagingOrders as $pagingOrder) {
                if ($pagingOrder->user_id != $uid) {
                    $pagingOrder->user_msg = $pagingOrder->offer->user;
                    $pagingOrder->user_role = 'Worker';
                } else {
                    $pagingOrder->user_msg = $pagingOrder->user;
                    $pagingOrder->user_role = 'Client';
                }
                $pagingOrder->title = $pagingOrder->offer->title;
                $pagingOrder->category = $pagingOrder->offer->category->name;
                $pagingOrder->hidden(['order_no', 'price', 'quote_type', 'remark', 'user', 'offer', 'status'])->append(['status_text']);
            }
        }

        return new SuccessReturn([
            'info' => $pagingOrders
        ]);
    }

}






















