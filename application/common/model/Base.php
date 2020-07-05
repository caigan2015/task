<?php
namespace app\common\model;

use think\Model;

class Base extends Model
{
    protected function user()
    {
        return $this->belongsTo('User', 'userid', 'id');
    }

    public static function getBreads($id){
        $data = self::field(['id','name','pid','level'])->find($id);
        $breads = !empty($data['name'])?$data['name']:'';
        if($data['pid']>0){
            $breads = self::getBreads($data['pid']).$breads;
        }
        return $breads;
    }


    protected function  prefixImgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('app.base_url').$value;
        }
        return $finalUrl;
    }

    public static function getDataColumn($data,$field)
    {
        return self::where($data)->column($field);
    }

    public static function getDataValue($data,$field)
    {
        return self::where($data)->value($field);
    }


    public static function getAllByData($data,$field=[])
    {
        return self::where($data)->where(['status'=>1])->field($field)->select();
    }

    public static function getNormalOne($data,$field = [])
    {
        return self::where($data)->where(['status'=>1])->field($field)->find();
    }


    public static function getTopOne($id,$field=[])
    {
        $current = self::getNormalOne(['id'=>$id],$field);
        if($current->pid>0){
            return self::getTopOne($current['pid'],$field);
        }
        return $current;
    }

}
