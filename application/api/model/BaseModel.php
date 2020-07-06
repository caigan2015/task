<?php

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
//    protected $field = true;
    protected $autoWriteTimestamp = 'datetime';//配置开启了


    public static function getDataColumn($data,$field)
    {
        return self::where($data)->where(['status'=>1])->column($field);
    }

    public static function getDataValue($data,$field)
    {
        return self::where($data)->where(['status'=>1])->value($field);
    }


    public static function getAllByData($data,$field = [],$order = [])
    {
        return self::where($data)->where(['status'=>1])->field($field)->order($order)->select();
    }
    public static function getOneByData($data,$field=[])
    {
        return self::where($data)->where(['status'=>1])->field($field)->find();
    }


    protected function  prefixImgUrl($value){
        return $value ? config('app.base_url').$value : '';
    }

    public function user()
    {
        return $this->belongsTo('User','user_id','id')->field(['id','username','head_img']);
    }
}