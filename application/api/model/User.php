<?php

namespace app\api\model;


class User extends BaseModel
{
    protected $createTime = 'register_time';
    protected $hidden = ['status','update_time','register_time'];

    public static function getUserValue($data,$field)
    {
        return self::where($data)->value($field);
    }

    public static function getNormalOneById($id,$field = [])
    {
        return self::where(['id'=>$id,'status'=>1])->field($field)->find();
    }

    public static function updatePass($newPass,$where)
    {
        return self::update(['password'=>\IAuth::setPassword($newPass)],$where);
    }

    protected function getHeadImgAttr($val)
    {
        return $this->prefixImgUrl($val);
    }


}
