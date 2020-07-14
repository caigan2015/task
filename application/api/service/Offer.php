<?php
namespace app\api\service;

use app\api\service\Token as TokenService;
use app\api\model\Offer as OfferModel;
use app\lib\exception\ImageException;
use app\lib\exception\OfferException;
use think\Request;

class Offer
{
    /**
     * @throws OfferException
     */
    public static function create()
    {
        $uid = TokenService::getCurrentUid();
        $data = Request::instance()->post();
        $data['user_id'] = $uid;
        $data['image'] = !empty($data['image']) ? self::saveImage($data['image']):config('app.default_offer_image');
        $data['description'] = htmlentities($data['description']);
        $res = OfferModel::create($data,true);
        if(!$res){
            throw new OfferException([
                'msg'=>'オファーを作成できませんでした',
                'error_code'=>30001
            ]);
        }
    }

    /**
     * @throws OfferException
     */
    public static function save()
    {
        $uid = TokenService::getCurrentUid();
        $data = Request::instance()->post();
        $offer = self::checkOffer(['id' => $data['id']]);
        $data['user_id'] = $uid;
        !empty($data['image'])?($data['image'] = self::saveImage($data['image'])):'';
        $data['description'] = htmlentities($data['description']);
        $res = $offer->save($data);
        if(!$res){
            throw new OfferException([
                'msg'=>'クーポンを保存できませんでした',
                'error_code'=>30002
            ]);
        }
    }

    /**
     * @param $data
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws OfferException
     */
    public static function checkOffer($data)
    {
        $offer = OfferModel::getOneByData($data);
        if(!$offer){
            throw new OfferException() ;
        }
        return $offer;
    }

    /**
     * @param $head_img
     * @return string
     * @throws ImageException
     */
    public static function saveImage($head_img)
    {
        if(file_exists('.'.$head_img)){
            return $head_img;
        }

        $fileDir = "./tmp/uploads/offer/".date('YmdHis');
        if(!file_exists($fileDir)){
            mkdir($fileDir,0777,true);
        }
        $fileImg = $fileDir . '/' . md5(microtime(true)).'.jpg';
        //保存图片
        if(!file_put_contents($fileImg, base64_decode($head_img))){
            throw new ImageException([
                'msg' => '画像を保存できませんでした',
                'error_code'=> 40001 ,
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg,'.');
    }
}