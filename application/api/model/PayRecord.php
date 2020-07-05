<?php
namespace app\api\model;

use think\Model;

class PayRecord extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','userid','order_fee_id','issend','status','sort','isdelete','create_time','update_time','send_time'];


    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['status'=>1,'isdelete'=>0])->order(['send_time'=>'desc'])->field($field);
        if (!$paginate)
        {
            return $query->select();
        }else{
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, false, [
                'page' => $page
            ]);
        }
    }


    public static function getDetail($data,$field=[])
    {
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->field($field)->with(['orderFee'])->find();
    }

    public function orderFee(){
        return $this->belongsTo('OrderFee','order_fee_id','id');
    }

    public function getSendTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }

}