<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Offer as OfferModel;
use app\api\service\Offer as OfferService;
use app\api\service\Token as TokenService;
use app\api\model\Order as OrderModel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\OfferNew;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OfferException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Request;

class Offer extends BaseController
{
    protected $beforeActionList = [

    ];

    /**
     * @return SuccessMessage
     */
    public function createOffer()
    {
        (new OfferNew())->goCheck([], 'create');
        OfferService::create();

        return new SuccessMessage();
    }

    /**
     * @return SuccessMessage
     */
    public function saveOffer()
    {
        (new OfferNew())->goCheck([], 'save');
        OfferService::save();

        return new SuccessMessage();
    }

    /**
     * @param int $page
     * @param int $size
     * @return SuccessReturn
     */
    public function getOffers($page = 1, $size = 20)
    {
        (new PagingParameter())->goCheck();
        (new OfferNew())->goCheck([], 'get');
        $data = Request::instance()->post();
        //条件検索　todo
//        $order_offer_ids = OrderModel ::getDataColumn('status BETWEEN ' . OrderStatusEnum::WAIT_PAID .' AND '. OrderStatusEnum::PAID_DONE,'offer_id');
//        $data['offer_id'] = ['NOT IN',$order_offer_ids];
        $offers = OfferModel::getSummary($data, [], true, $page, $size);
        if ($offers->isEmpty()) {
            $offers = [
                'current_page' => $offers->currentPage(),
                'total' => $offers->total(),
                'data' => []
            ];
        }
        foreach ($offers as $offer) {
            $offer-> append(['request_type_text'])->hidden(['category_id', 'description', 'update_time', 'request_type', 'remark', 'image', 'status']);
        }

        return new SuccessReturn([
            'info' => $offers,
        ]);
    }

    /**
     * @return SuccessReturn
     * @throws OfferException
     */
    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $offer = OfferModel::getDetail(['id' => $id]);
        if (!$offer) {
            throw new OfferException();
        }
        return new SuccessReturn([
            'info' => $offer->append(['request_type_text'])->hidden(['category_id', 'update_time', 'request_type', 'status'])
        ]);
    }

    /**
     * @return SuccessReturn
     */
    public function getMyOffers()
    {
        (new OfferNew())->goCheck([], 'get');
        (new PagingParameter())->goCheck();
        $data = Request::instance()->post();
        $uid = TokenService::getCurrentUid();
        $data['user_id'] = $uid;
        //条件検索
        $offers = OfferModel::getSummary($data, [], false);
        if ($offers->isEmpty()) {
            throw new OfferException();
        }
        return new SuccessReturn([
            'info' => $offers->append(['request_type_text'])->hidden(['category_id', 'description', 'update_time', 'request_type', 'remark', 'image', 'status'])
        ]);
    }

    /**
     * @return SuccessReturn
     * @throws OfferException
     */
    public function getMyOfferDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $offer = OfferModel::getDetail(['id' => $id, 'user_id' => $uid]);
        if (!$offer) {
            throw new OfferException();
        }
        return new SuccessReturn([
            'info' => $offer->append(['request_type_text'])->hidden(['category_id', 'update_time', 'request_type', 'status'])
        ]);
    }

    /**
     * @return SuccessMessage
     * @throws OfferException
     */
    public function cancel()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $offer = OfferService::checkOffer(['id' => $id, 'user_id' => $uid]);
        $offer->status = 0;
        $result = $offer->save();
        if ($result === false) {
            throw new OfferException([
                'msg' => 'キャンセルできませんでした',
                'error' => 30003
            ]);
        }
        return new SuccessMessage();
    }
}