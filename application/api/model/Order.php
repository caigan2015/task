<?php

namespace app\api\model;

use think\Model;

class Order extends BaseModel
{
    protected $hidden = ['house_id','userid', 'update_time','isdelete','property_id','transaction_id','referer','issend','prepay_id','status','send_time','coupon','phone','discounts','remark'];
    protected $autoWriteTimestamp = true;
//
//    public function getSnapAddressAttr($value){
//        if(empty($value)){
//            return null;
//        }
//        return json_decode(($value));
//    }
    
    public static function getSummaryByData($data,$field = [], $page=1, $size=15)
    {
        $pagingData = self::where($data)->where(['status'=>1,'isdelete'=>0])
            ->order('create_time desc')->field($field)
            ->paginate($size, false, ['page' => $page]);
        return $pagingData ;
    }

    public static function getSummaryByPage($page=1, $size=20){
        $pagingData = self::order('create_time desc')->where(['status'=>1,'isdelete'=>0])
            ->paginate($size, false, ['page' => $page]);
        return $pagingData ;
    }

    public static function getDetail($data)
    {
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->with(['cart'])->find();
    }
    public static function getNormalOneById($id)
    {
        return self::where(['id'=>$id])->where(['status'=>1,'isdelete'=>0])->find();
    }
    public function cart()
    {
        return $this->hasMany('OrderFee', 'order_id', 'id');
    }


    protected function getPayWayTextAttr($val,$data)
    {
        $pay_ways = config('order.pay_way');
        return !empty($pay_ways[$data['pay_way']])?$pay_ways[$data['pay_way']]:'其它方式';
    }

    protected function getPayTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }

    protected function getPayStatusTextAttr($val,$data)
    {
        $pay_status = config('order.pay_status');
        return !empty($pay_status[$data['pay_status']])?$pay_status[$data['pay_status']]:'未定义';
    }

    protected function getYearAttr($val,$data)
    {
        return date('Y',$data['create_time']);
    }
    protected function getMonthAttr($val,$data)
    {
        return date('m',$data['create_time']);
    }

    protected function getExpenditureDateAttr($val,$data)
    {
        return date('Y年m月d日',$data['create_time']);
    }

//    protected function getOrderPeriodAttr($val,$data)
//    {
//        $countDay = (new Quarter())->where(['id'=>$data['quarter_id']])->value('order_period');
////        if($countDay)
//        $yearMonth = date('Y-m',$data['create_time']);
//        $endTime = strtotime($yearMonth.'-'.$countDay);
//        $endDate = date('Y-m-d',$endTime);
//        $BeginTime = strtotime('-1 month',$endTime);
//        $BeginDate=date('Y-m-d', $BeginTime);
//        return $BeginDate.' ~ '.$endDate;
//    }
    protected function getPayTimeTextAttr($val,$data)
    {
        return !empty($data['pay_time'])?tranTime($data['pay_time']):'';
    }

    
}
