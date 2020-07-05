<?php
namespace app\api\model;

use think\Model;

class Repair extends BaseModel
{
    protected $hidden = ['property_id','quarter_id','userid','image_id_1','image_id_2','image_id_3','image_id_4','update_time','from','status','isdelete'];

    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['status'=>1,'isdelete'=>0])->order(['create_time'=>'desc'])->field($field);
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
//        return self::where($data)->where(['status'=>1,'isdelete'=>0])->with([
//            'imgOne'=>function($query){
//                $query->withField("id,from,name");
//            },
//            'imgTwo'=>function($query){
//                $query->withField("id,from,name");
//            },
//            'imgThree'=>function($query){
//                $query->withField("id,from,name");
//            },'imgFour'=>function($query){
//                $query->withField("id,from,name");}
//        ])->order(['create_time'=>'desc'])->select();
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->with(['imgOne','imgTwo','imgThree','imgFour'])->order(['create_time'=>'desc'])->field($field)->find();
    }

    public function getFixStatusTextAttr($val,$data)
    {
        return $data['fix_status']==1?'已处理':'待处理';
    }
    public function getFixedTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }
    public function getScheduleTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }
}
