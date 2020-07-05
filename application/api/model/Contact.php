<?php
namespace app\api\model;

use think\Model;

class Contact extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','address','description','contact','email','supplement','update_time','create_time','status'];

    public static function getSummary($data,$field=[])
    {
        return  self::where($data)->where(['status'=>1])->order(['dept_type'=>'asc'])->field($field)->select();
    }

    public function getDeptTypeTextAttr($val,$data)
    {
        $type = config('app.dept_type');
        return !empty($type[$data['dept_type']])?$type[$data['dept_type']]:'未定义';
    }
    
}
