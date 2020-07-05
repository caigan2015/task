<?php
namespace app\api\model;

use think\Model;

class Device extends BaseModel
{
    protected $autoWriteTimestamp = true;//配置开启了

    public static function getControlPortBySid($structureid)
    {
        $port = '';
        $property_id = Structure::getDataValue(['id'=>$structureid],'property_id');
        if(!empty($property_id)){
            $port = Property::getDataValue(['id'=>$property_id],'port');
        }
        return $port;
    }
}
