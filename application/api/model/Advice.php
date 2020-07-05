<?php
namespace app\api\model;

use think\Model;

class Advice extends BaseModel
{
    protected $hidden = ['property_id','userid','image_id_1','image_id_2','image_id_3','image_id_4','update_time','from','status','isdelete','remark'];

    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['isdelete'=>0])->order(['create_time'=>'desc'])->field($field);
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
//        return self::where($data)->where(['isdelete'=>0])->with([
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
        return self::where($data)->where(['isdelete'=>0])->with(['imgOne','imgTwo','imgThree','imgFour'])->order(['create_time'=>'desc'])->field($field)->find();
    }

    public function getDisasterTypeTextAttr($val,$data)
    {
        $type = config('app.disaster_type');
        return !empty($type[$data['disaster_type']])?$type[$data['disaster_type']]:'未定义';
    }
    
    public function getTypeTextAttr($val,$data)
    {
        $type = config('app.advice_type');
        return !empty($type[$data['type']])?$type[$data['type']]:'未定义';
    }
}
