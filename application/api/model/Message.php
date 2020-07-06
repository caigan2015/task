<?php
namespace app\api\model;

use think\Model;

class Message extends BaseModel
{

    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {

    }


    public static function getDetail($data,$field=[])
    {
        return self::where($data)->where(['status'=>1])->field($field)->with(['orders','notice.img','push','pastport','pay.orderFee'])->find();
    }

}
