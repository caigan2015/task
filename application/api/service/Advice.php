<?php
namespace app\api\service;

use app\api\model\Advice as AdviceModel;
use app\api\model\File;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\AdviceException;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Advice
{
    public static function create($user)
    {
        $data = Request::instance()->post();
        !empty($data['image_1'])?($data['image_id_1'] = Identify::uploadImage($data['image_1'])->id):'';
        !empty($data['image_2'])?($data['image_id_2'] = Identify::uploadImage($data['image_2'])->id):'';
        !empty($data['image_3'])?($data['image_id_3'] = Identify::uploadImage($data['image_3'])->id):'';
        !empty($data['image_4'])?($data['image_id_4'] = Identify::uploadImage($data['image_4'])->id):'';

//        $quarter = Quarter::getTopOne($user->house_id,['id','name','pid','property_id']);
//        $data['quarter_id'] = $quarter->id;
        $data['property_id'] = $user->property_id;
        $data['userid'] = $user->id;
        $res = AdviceModel::create($data,true);
        if(!$res){
            throw new AdviceException([
                'msg'=>'提交失败',
                'error_code'=>30006
            ]);
        }
        return $res;
    }
    
}