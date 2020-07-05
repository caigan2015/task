<?php
namespace app\api\model;

use think\Model;

class Push extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','image_id','from','status','sort','isdelete','create_time','update_time','keywords'];


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
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->field($field)->with(['img'=>function($query){
            $query->withField('id,name,from');
        }])->find();
    }

    public function img(){
        return $this->belongsTo('File','image_id','id');
    }


    public function getSendTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }


    public function getTypeTextAttr($val,$data)
    {
        $type = config('app.notice_type');
        return !empty($type[$data['type']])?$type[$data['type']]:'未定义';
    }
}