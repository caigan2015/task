<?php

namespace app\api\model;

use think\Model;

class UserVers extends BaseModel
{
    protected $autoWriteTimestamp = true;

    public static function getByPhone($phone,$field,$array=false)
    {
        $query = self::where(['phone'=>$phone])->order(['create_time'=>'desc']);
        if($array){
            return $query->field($field)->find();
        }
        return $query->value($field);
    }

//    public static function saveCode($phone,$code)
//    {
//        $data['phone'] = $phone;
//        $data['code'] = $code;
//        return self::save($data)
//    }
}
