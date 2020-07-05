<?php

namespace app\api\model;

use think\Model;

class Config extends BaseModel
{
    protected $hidden = ['status','create_time','update_time'];

    public static function getValue($data,$tags=0)
    {
        $value = self::where(['status'=>1])->where($data)->value('value');
        $value = html_entity_decode($value);
        if($tags==0){
            $value = strip_tags($value);
        }
        return ['value'=>$value];
    }

    public static function getColumns($data,$tags=0)
    {
        $values = self::where(['status'=>1])->where($data)->column('value','code');
        foreach ($values as &$value) {
            $value = html_entity_decode($value);
            if($tags==0){
                $value = strip_tags($value);
            }
        }
        return $values;
    }
}
