<?php

namespace app\api\model;

class Order extends BaseModel
{
    public static function getSummaryByData($data, $field = [], $paginate = true, $page = 1, $size = 15)
    {
        $query = self::where($data)->where(['status' => ['neq' , -1]])
            ->order(['create_time' => 'desc'])->field($field);
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
        return self::where($data)->where(['status' => 1])->find();
    }

    public static function getNormalOneById($id)
    {
        return self::where(['id' => $id])->where(['status' => 1])->find();
    }


    protected function getPayWayTextAttr($val, $data)
    {
        $pay_ways = config('order.pay_way');
        return !empty($pay_ways[$data['pay_way']]) ? $pay_ways[$data['pay_way']] : '其它方式';
    }


    public function offer()
    {
        return $this->belongsTo('Offer','offer_id','id');
    }

}
