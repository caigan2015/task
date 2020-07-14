<?php

namespace app\api\model;

class Order extends BaseModel
{
    protected $hidden = ['update_time', 'snap_items','pay_time','pay_way','pay_amount'];
    public static function getSummaryByData($data1,$data2, $field = [], $paginate = true, $page = 1, $size = 15)
    {
        $query = self::where($data1)->where($data2)->order(['create_time' => 'desc'])->with(['offer','user'])->field($field);
        if (!$paginate) {
            return $query->select();
        } else {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, false, [
                'page' => $page
            ]);
        }
    }

    public static function getDetail($data)
    {
        return self::where($data)->where(['status' => ['neq', -1]])->with(['offer','user'])->find();
    }

    public static function getNormalOneById($id)
    {
        return self::where(['id' => $id])->where(['status' => ['neq', -1]])->find();
    }

    public static function getOneByData($data,$field=[])
    {
        return self::where($data)->where(['status' => ['neq', -1]])->field($field)->find();
    }

    public static function getDataColumn($data,$field)
    {
        return self::where($data)->where(['status' => ['neq', -1]])->column($field);
    }

    protected function getPayWayTextAttr($val, $data)
    {
        $pay_ways = config('order.pay_way');
        return !empty($pay_ways[$data['pay_way']]) ? $pay_ways[$data['pay_way']] : '他の方法';
    }
    protected function getStatusTextAttr($val, $data)
    {
        $status = config('order.status');
        return !empty($status[$data['status']]) ? $status[$data['status']] : '他の方法';
    }

    public function offer()
    {
        return $this->belongsTo('Offer', 'offer_id', 'id')->with(['user','category']);
    }

}
