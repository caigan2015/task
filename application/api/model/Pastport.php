<?php
namespace app\api\model;

use think\Model;

class Pastport extends BaseModel
{
    protected $hidden = ['property_id','userid','update_time','status','isdelete'];

    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['status'=>1,'isdelete'=>0])->order(['schedule_time'=>'desc'])->field($field);
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
        return self::where($data)->where(['status'=>1,'isdelete'=>0])->field($field)->find();
    }

    public function getVisitStatusNowAttr($val,$data)
    {

        $array = [];
        if($data['isvisited']==1){
            $array['visit_status'] = 1 ;
            $array['visit_status_text']  = '已到访';
        }else{
            $now = time();
            if ($data['expire_time'] < $now) {
                $array['visit_status'] = 2 ;
                $array['visit_status_text']  = '已过期';
            } else {
                if(($data['enter_way']==2 && empty($data['ID_card'])) || ($data['enter_way']==3 && empty($data['IC_card']))){
                    $array['visit_status'] = -1 ;
                    $array['visit_status_text']  = '信息待完善';
                }else {
                    $array['visit_status'] = 0 ;
                    $array['visit_status_text']  = '未到访';
                }
            }
        }

        return $array;
    }

    protected function getSexAttr($val)
    {
        switch($val){
            case 1:
                $str = '男';
                break;
            case 2:
                $str = '女';
                break;
            default:
                $str = '保密';

        }
        return $str;
    }
    public function getEnterWayTextAttr($val,$data)
    {
        $type = config('app.check_type');
        return !empty($type[$data['enter_way']])?$type[$data['enter_way']]:'未定义';
    }
    public function getVisitedTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i',$val):'-';
    }
    public function getScheduleTimeAttr($val,$data)
    {
        return $val?date('Y-m-d',$val):'-';
    }

    public function setScheduleTimeAttr($val,$data)
    {
        return $val?strtotime($val):'';
    }
    public function getExpireTimeAttr($val,$data)
    {
        return $val?date('Y-m-d H:i:s',$val):'-';
    }

//    public function setExpireTimeAttr($val,$data)
//    {
//        if(!empty($data['schedule_time'])){
//            $s_time = strtotime($data['schedule_time']);
//            return mktime(23,59,59,date("m",$s_time),date("d",$s_time),date("Y",$s_time));
//        }
//        return '';
//    }


    protected function getIDCardAttr($val,$data)
    {
        return plusStar($val,6,4);
    }
    protected function getICCardAttr($val,$data)
    {
        return plusStar($val,6,4);
    }

}
