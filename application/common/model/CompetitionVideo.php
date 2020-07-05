<?php
namespace app\common\model;

use think\Model;

class CompetitionVideo extends Model
{
    // 指定表名,不含前缀
    protected $name = 'competition_video';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function file()
    {
        return $this->belongsTo('File','video_id','id');
    }

    protected function competition()
    {
        return $this->belongsTo('Competition','competition_id','id');
    }
    protected function getTypeTextAttr($val,$data)
    {
        $video_type = config('app.video_type');
        return !empty($video_type[$data['type']])?$video_type[$data['type']]:'未定义';
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

    protected function getPlayUrlAttr($val,$data)
    {
        if(strpos($val,'||')!==false){
            $str = '';
            $tmp = explode('||',$val);
            foreach ($tmp as &$item) {
                $str .= '<a href="javascript:void (0)" onclick="layer_open(\'直播\',\''.$item.'\')">'.$item.'</a><br/>';
            }
            return $str;
        }else{
            return '<a href="javascript:void (0)" onclick="layer_open(\'直播\',\''.$val.'\')">'.$val.'</a>';
        }
    }


    protected function getPublishTimeAttr($val){
        return date('Y-m-d H:i',$val);
    }
    protected function setPublishTimeAttr($val){
        return strtotime($val);
    }
}
