<?php
namespace app\common\model;

use think\Model;

class Order extends Model
{
    // 指定表名,不含前缀
    protected $name = 'order';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function user()
    {
        return  $this->belongsTo('User','user_id','id');
    }

    protected function getPayWayAttr($val)
    {
        $pay_way = config('order.pay_way');
        return !empty($pay_way[$val])?$pay_way[$val]:'未定义';
    }
    protected function getStatusTextAttr($val,$data)
    {
        $pay_status = config('order.pay_status');
        return !empty($pay_status[$data['status']])?$pay_status[$data['status']]:'未定义';
    }
    protected function getPayTimeAttr($val)
    {
        return $val?date('Y-m-d H:i:s',$val):'-';
    }
}
