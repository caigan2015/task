<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Quarter;
use app\api\service\Token as TokenService;
use app\api\model\Offer as OfferModel;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\OfferException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
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
        !empty($data['image'])?($data['image'] = self::saveImage($data['image'])):'';

        $res = OfferModel::create($data,true);
        if(!$res){
            throw new OfferException([
                'msg'=>'失败',
                'error_code'=>10000
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

        $res = $offer->save($data);
        if(!$res){
            throw new OfferException([
                'msg'=>'失败',
                'error_code'=>10000
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

        $fileDir = "./tmp/uploads/".date('YmdHis');
        if(!file_exists($fileDir)){
            mkdir($fileDir,0777,true);
        }
        $fileImg = $fileDir . '/' . md5(microtime(true)).'.jpg';
        //保存图片
        if(!file_put_contents($fileImg, base64_decode($head_img))){
            throw new ImageException([
                'msg' => '保存图片失败',
                'error_code'=> 40001 ,
                'code' =>  403
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg,'.');
    }
}