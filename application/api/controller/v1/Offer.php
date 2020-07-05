<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 2:56
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Offer as OfferModel;
use app\api\service\Offer as OfferService;
use app\api\service\Token as TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\OfferNew;
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
        (new OfferNew())->goCheck([],'create');

        OfferService::create();

        return new SuccessMessage();
    }

    /**
     * @return SuccessMessage
     */
    public function saveOffer()
    {
        (new OfferNew())->goCheck([],'save');

        OfferService::save();

        return new SuccessMessage();
    }

    /**
     * @param int $page
     * @param int $size
     * @return SuccessReturn
     */
    public function getOffers($page = 1,$size = 1)
    {
        (new OfferNew())->goCheck([],'get');
        (new PagingParameter())->goCheck();
        $data = Request::instance()->post();
        $offers = OfferModel::getSummary($data,[],true, $page, $size);
        if($offers->isEmpty()){
            $offers = [
                'current_page' => $offers->currentPage(),
                'total' => $offers->total(),
                'data' => []
            ];
        }
        return new SuccessReturn([
            'info'=>$offers
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
        $offer = OfferModel::getDetail(['id'=>$id]);
        if(!$offer){
            throw new OfferException() ;
        }

        return new SuccessReturn([
            'info'=>$offer
        ]);
    }

    /**
     * @return SuccessReturn
     */
    public function getMyOffers()
    {
        (new OfferNew())->goCheck([],'get');
        (new PagingParameter())->goCheck();
        $data = Request::instance()->post();
        $uid = TokenService::getCurrentUid();
        $data['user_id'] = $uid;
        $offers = OfferModel::getSummary($data,[],false);
        return new SuccessReturn([
            'info'=>$offers
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
        $offer = OfferModel::getDetail(['id'=>$id,'user_id'=>$uid]);
        if(!$offer){
            throw new OfferException() ;
        }
        return new SuccessReturn([
            'info'=>$offer
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
        OfferService::checkOffer(['id'=>$id,'user_id'=>$uid]);
        $result = OfferModel::update(['status'=>0],['id'=>$id]);
        if($result===false){
            throw new OfferException([
                'msg'=>'失败',
                'error'=>30011
            ]);
        }
        return new SuccessMessage();
    }
}