<?php
namespace app\api\model;

use think\Model;

class Message extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','userid','status','isdelete','update_time','keywords'];

    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where(['status'=>1,'isdelete'=>0]);
//        whereOr(function($query){
//            $query->where(['property_id'=>(!empty($data['property_id'])?$data['property_id']:0),'quarter_id'=>0]);
//        })->whereOr(function($query){
//            $query->where(['property_id'=>0,'quarter_id'=>0]);
//        })->

        if(!empty($data['property_id'])){
            $query = $query->where('property_id',['=',$data['property_id']],['=',0],'or');
            unset($data['property_id']);
        }
        if(!empty($data['quarter_id'])){
            $query = $query->where('quarter_id',['=',$data['quarter_id']],['=',0],'or');
            unset($data['quarter_id']);
        }
        $query=$query->where($data)->order(['create_time'=>'desc'])->field($field);
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
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->field($field)->with(['orders','notice.img','push','pastport','pay.orderFee'])->find();
    }

    public function orders()
    {
        return $this->belongsTo('Order','order_id','id');
    }
    public function notice()
    {
        return $this->belongsTo('Notice','notice_id','id');
    }
    public function push()
    {
        return $this->belongsTo('Push','push_id','id');
    }
    public function pastport()
    {
        return $this->belongsTo('Pastport','pastport_id','id');
    }
    public function pay()
    {
        return $this->belongsTo('PayRecord','pay_id','id');
    }



    public function getTypeTextAttr($val,$data)
    {
        $type = config('app.msg_type');
        return !empty($type[$data['type']])?$type[$data['type']]:'未定义';
    }
}
