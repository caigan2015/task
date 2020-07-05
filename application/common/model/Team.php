<?php
namespace app\common\model;

use think\Model;

class Team extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    public function getLogoAttr($val,$data)
    {
        $baseUrl = config('app.base_url');
//        if(strpos($val,'http://')===false && strpos($val,'https://')===false ) {
//            return $baseUrl . $val;
//        }
        if($data['from']==1){
            if(empty($val) || !file_exists('./'.trim($val,'/'))){
                return $baseUrl.'\static\admin\images\default_img.jpg';
            }
            return $baseUrl.$val;
        }
        return $val;
    }

    protected function getEstablishmentTimeAttr($val){
        return $val?date('Y-m-d',$val):'-';
    }
    protected function setEstablishmentTimeAttr($val){
        return strtotime($val);
    }
}
