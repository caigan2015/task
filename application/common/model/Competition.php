<?php
namespace app\common\model;

use think\Model;

class Competition extends Model
{
    // 指定表名,不含前缀
    protected $name = 'competition';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function video()
    {
        return $this->hasMany('CompetitionVideo','competition_id','id');
    }
    protected function getTypeAttr($val)
    {
        $race_type = config('app.race_type');
        return !empty($race_type[$val])?$race_type[$val]:'未知';
    }
    protected function getIsHotAttr($val)
    {
        return $val==1?'是':'否';
    }

    protected function getPlayTimeAttr($val){
        return date('Y-m-d H:i',$val);
    }
    protected function setPlayTimeAttr($val){
        return strtotime($val);
    }


    protected function getMainImgUrlAttr($val,$data){
        $baseUrl = config('app.base_url');
//        if(strpos($val,'http://')===false && strpos($val,'https://')===false ) {
//            return $baseUrl . $val;
//        }

        if($data['from']==1){
            if(empty($val) || !file_exists('.'.$val) ){
                return $baseUrl.'\static\admin\images\default_img.jpg';
            }
            return $baseUrl.$val;
        }
        return $val;
    }
}
