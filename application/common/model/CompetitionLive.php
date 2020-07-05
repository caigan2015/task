<?php
namespace app\common\model;

use think\Model;

class CompetitionLive extends Model
{
    // 指定表名,不含前缀
    protected $name = 'competition_live';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function competition()
    {
        return $this->belongsTo('Competition','competition_id','id');
    }

    protected function getMainImgUrlAttr($val,$data)
    {
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

    protected function getExpireTimeAttr($val){
        return $val?date('Y-m-d H:i',$val):'-';
    }
    protected function getPublishTimeAttr($val){
        return date('Y-m-d H:i',$val);
    }
    protected function setPublishTimeAttr($val){
        return strtotime($val);
    }
}
