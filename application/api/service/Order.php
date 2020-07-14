<?php

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\model\User as UserModel;
use app\api\service\Offer as OfferService;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;

class Order
{
    public static function checkOrderCommit($offer_id, $user_id)
    {
        $order = OrderModel::getOneByData(['offer_id' => $offer_id, 'user_id' => $user_id, 'status' => ['neq', 5]]);
        if ($order) {
            throw new OrderException(
                [
                    'msg' => 'ごめんなさい！ 注文はすでに進行中です',
                    'error_code' => 60010,
                ]
            );
        }
    }

    /**
     * @param $id
     * @param $isCommon
     * @return null|static
     * @throws OrderException
     */
    public static function checkOrder($id, $isCommon)
    {
        $user_id = Token::getCurrentUid();
        $order = OrderModel::get(['id' => $id]);
        if (!$order) {
            throw new OrderException();
        }
        $offer = OfferService::checkOffer(['id' => $order->offer_id]);

        if ((!$isCommon && $order->user_id != $user_id) || ($isCommon && !in_array($user_id, [$order->user_id, $offer->user_id]))) {
            throw new OrderException([
                'msg' => 'ごめんなさい！ 注文ステータスを変更する権限がありません',
                'error_code' => 60001,
            ]);
        }
        $mail = UserModel::getDataValue(['id' => ($order->user_id != $user_id ? $user_id : $offer->user_id)], 'e_mail');
        $order->mail = $mail;
        $order->title = $offer->title;
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
                'msg' => 'ごめんなさい！ 見積もりの権利はありません',
                'error_code' => 60004
            ]);
        }
        if ($order->status != OrderStatusEnum::WAIT_CONFIRM) {
            throw new OrderException([
                'msg' => 'ごめんなさい！ 注文は見積もりを許可していません',
                'error_code' => 60005
            ]);
        }
        if (!$isConfirm) {
            $order->quote_type = $user_id == $offer_user_id ? 0 : 1;
            $order->price = $data['price'];
        } else {
            if (!$order->price) {
                throw new OrderException([
                    'msg' => 'ごめんなさい！ 見積りなし',
                    'error_code' => 60006
                ]);
            }
            $order->status = OrderStatusEnum::WAIT_PAID;
        }
        $mail = UserModel::getDataValue(['id' => ($order->user_id != $user_id ? $user_id : $offer->user_id)], 'e_mail');
        $order->mail = $mail;
        $order->title = $offer->title;
        return $order;
    }

    public static function checkOrderForChattingReturnUserType($id, $user_id)
    {
        $order = OrderModel::get(['id' => $id]);
        if (!$order || $order->status == OrderStatusEnum::CLOSED) {
            throw new OrderException();
        }

        $offer = OfferService::checkOffer(['id' => $order->offer_id]);
        $offer_user_id = $offer->user_id;
        if (!in_array($user_id, [$order->user_id, $offer_user_id])) {
            throw new OrderException([
                'msg' => 'ごめんなさい！ チャットする権利がありません',
                'error_code' => 60007
            ]);
        }

        return ($user_id == $offer_user_id) ? 0 : 1;;
    }

    public static function makeOrderNo()
    {
        return 'TASK' . (new \DateTime)->format('YmdHisu');
    }

}