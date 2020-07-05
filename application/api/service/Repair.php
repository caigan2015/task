<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Quarter;
use app\api\model\Repair as RepairModel;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\RepairException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Repair
{
    public static function create($user)
    {
        $data = Request::instance()->post();
        !empty($data['image_1'])?($data['image_id_1'] = Identify::uploadImage($data['image_1'])->id):'';
        !empty($data['image_2'])?($data['image_id_2'] = Identify::uploadImage($data['image_2'])->id):'';
        !empty($data['image_3'])?($data['image_id_3'] = Identify::uploadImage($data['image_3'])->id):'';
        !empty($data['image_4'])?($data['image_id_4'] = Identify::uploadImage($data['image_4'])->id):'';

        $quarter = Quarter::getTopOne($user->house_id,['id','name','pid','property_id']);
        $data['property_id'] = $quarter->property_id;
        $data['quarter_id'] = $quarter->id;
        $data['repair_no'] = 'BX'. date('YmdHis');
        $data['userid'] = $user->id;
        $data['position'] = $user->address?$user->address:Quarter::getBreads($user->house_id);
        $data['contact'] = $user->username;
        $data['tel'] = $user->mobile;
        $res = RepairModel::create($data,true);
        if(!$res){
            throw new RepairException([
                'msg'=>'添加报修失败',
                'error_code'=>10000
            ]);
        }
    }


    public static function checkRepair($data)
    {
        $repair = RepairModel::getOneByData($data);
        if(!$repair){
            throw new RepairException() ;
        }
        return $repair;
    }
}