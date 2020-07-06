<?php


namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\service\Offer as OfferService;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;

class Order
{
    public static function checkOrder($id)
    {
        $user_id = Token::getCurrentUid();
        $order = OrderModel::get(['id' => $id]);
        if (!$order) {
            throw new OrderException();
        }
        OfferService::checkOffer(['id' => $order->offer_id]);
        if ($order->user_id != $user_id) {
            throw new OrderException([
                'msg' => '对不起！你没有权限更改订单状态',
                'error_code' => 60007,
                'code' => 403
            ]);
        }

        return $order;
    }

    /**
     * @param $data
     * @throws OrderException
     */
    public static function checkOrderQuote($data, $isConfirm = 0)
    {
        $user_id = Token::getCurrentUid();
        $order = OrderModel::get(['id' => $data['id']]);
        if (!$order) {
            throw new OrderException();
        }
        $offer = OfferService::checkOffer(['id' => $order->offer_id]);
        $offer_user_id = $offer->user_id;
        if (!in_array($user_id, [$order->user_id, $offer_user_id])) {
            throw new OrderException([
                'code' => 400,
                'msg' => '对不起！你没有报价权',
                'error_code' => 60003
            ]);
        }
        if ($order->status != OrderStatusEnum::WAIT_CONFIRM) {
            throw new OrderException([
                'code' => 400,
                'msg' => '对不起！订单不允许报价',
                'error_code' => 60003
            ]);
        }
        if (!$isConfirm) {
            $order->quote_type = $user_id == $offer_user_id ? 0 : 1;
            $order->price = $data['price'];
        } else {
            if (!$order->price) {
                throw new OrderException([
                    'code' => 400,
                    'msg' => '对不起！订单未报价',
                    'error_code' => 60003
                ]);
            }
            $order->status = OrderStatusEnum::WAIT_PAID;
        }
        return $order;
    }

    public static function checkOrderForChattingReturnUserType($id,$user_id)
    {
        $order = OrderModel::get(['id' => $id]);
        if (!$order || $order->status == OrderStatusEnum::CLOSED) {
            throw new OrderException();
        }

        $offer = OfferService::checkOffer(['id' => $order->offer_id]);
        $offer_user_id = $offer->user_id;
        if (!in_array($user_id, [$order->user_id, $offer_user_id])) {
            throw new OrderException([
                'code' => 400,
                'msg' => '对不起！你无权聊天',
                'error_code' => 60003
            ]);
        }

        return ($user_id == $offer_user_id) ? 0 : 1;;
    }

    public static function makeOrderNo()
    {
        return 'TASK' . (new \DateTime)->format('YmdHisu');
    }

}