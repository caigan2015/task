<?php
namespace app\api\model;

use think\Model;

class FeeCount extends BaseModel
{
    protected $hidden = ['property_id','house_id','userid','admin_id','image_id_1','image_id_2','image_id_3','image_id_4','update_time','from','fee_id','supplement','isdelete','update_time'];

    public static function getOneByData($data,$field = [])
    {
        return self::where($data)->field($field)->find();
    }
    public static function getSummary($data,$field=[],$paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->with(['fee'=>function($query){$query->withField('id,name');}])->order(['datetime'=>'desc'])->field($field);
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
//        return self::where($data)->with([
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
//        ])->order(['datetime'=>'desc'])->select();
        return self::where($data)->with(['imgOne','imgTwo','imgThree','imgFour','fee'])->order(['datetime'=>'desc'])->field($field)->find();
    }

    public function fee()
    {
        return $this->belongsTo('Fee','fee_id','id');
    }
    public function getDatetimeAttr($val,$data)
    {
        return $val?date('Y年m月',$val):'-';
    }
}
