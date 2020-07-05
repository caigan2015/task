<?php
namespace app\api\service;

use app\api\model\FeeCount;
use app\api\model\File;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\FeeException;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Fee
{
    public static function createCount($user)
    {
        $data = Request::instance()->post();
        !empty($data['image_1'])?($data['image_id_1'] = Identify::uploadImage($data['image_1'])->id):'';
        !empty($data['image_2'])?($data['image_id_2'] = Identify::uploadImage($data['image_2'])->id):'';
        !empty($data['image_3'])?($data['image_id_3'] = Identify::uploadImage($data['image_3'])->id):'';
        !empty($data['image_4'])?($data['image_id_4'] = Identify::uploadImage($data['image_4'])->id):'';
//        $quarter = Quarter::getTopOne($user->house_id,['id','name','pid','property_id']);
        $house_id = $user->house_id;
        $data['property_id'] = $user->property_id;
        $data['house_id'] = $user->house_id;
        $data['userid'] = $user->id;
        $data['datetime'] = time();
        $feeCount = FeeCount::getOneByData(['house_id'=>$house_id,'fee_id'=>$data['fee_id'],'FROM_UNIXTIME(datetime,"%Y-%m")'=>date('Y-m')]);
        if($feeCount){
            $res = $feeCount->allowField(true)->save($data);
        }else{
            $res = FeeCount::create($data,true);
        }
        if(!$res){
            throw new FeeException([
                'msg'=>'提交水电煤报数失败',
                'error_code'=>30008
            ]);
        }
    }


    public static function checkFeeCount($data)
    {
        $feeCount = FeeCount::getOneByData($data);
        if(!$feeCount){
            throw new FeeException() ;
        }
        return $feeCount;
    }
}