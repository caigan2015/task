<?php
namespace app\api\model;

use think\Model;

class Fee extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','code','admin_id','suplement','status','isdelete','create_time','update_time'];


    public function getTypeTextAttr($val,$data)
    {
        $type = config('app.fee_type');
        return !empty($type[$data['type']])?$type[$data['type']]:'未定义';
    }
}
