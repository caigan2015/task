<?php
namespace app\api\model;

use think\Model;

class OrderFee extends BaseModel
{
    protected $hidden = ['order_id','fee_id','update_time'];

    public function fee()
    {
        return $this->belongsTo('Fee','fee_id','id');
    }


    protected function getFeeSnapshotAttr($val,$data)
    {
        if(empty($val)){
            return null;
        }
        return json_decode($val,true);
    }
}
