<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Pastport as PastportModel;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\PastportException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Pastport
{
    public static function create($user)
    {
        $data = Request::instance()->post();

//        $quarter = Quarter::getTopOne($user->house_id,['id','name','pid','property_id']);
        $data['property_id'] = $user->property_id;
//        $data['quarter_id'] = $quarter->id;
        $data['userid'] = $user->id;
        $s_time = strtotime($data['schedule_time']);
        $data['expire_time'] = strtotime(date('Y-m-d',$s_time).' 23:59:59');
        $res = PastportModel::create($data,true);
        if(!$res){
            throw new PastportException([
                'msg'=>'生成通行证失败',
                'error_code'=>10000
            ]);
        }
        return $res;
    }
    
    public static function checkPastport($data)
    {
        $pastport = PastportModel::getOneByData($data);
        if(!$pastport){
            throw new PastportException() ;
        }
        return $pastport;
    }
}