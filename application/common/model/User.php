<?php
namespace app\common\model;

use think\Model;

class User extends Base
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'datetime';
    protected $createTime = 'register_time';

    public function getSexAttr($val)
    {
        $str = '';
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

    public function getHeadImgAttr($val,$data)
    {
        $baseUrl = config('app.base_url');
        if($data['from']==1){
            if(empty($val) || !file_exists('.'.$val)){
                return $baseUrl.'\static\admin\images\avatar-default.jpg';
            }
            return $baseUrl.$val;
        }

        return $val;
    }

    public function setPasswordAttr($val)
    {
        return md5(config('app.password_key').'123456');
    }


    public function getRankTypeTextAttr($val,$data)
    {
        $type = config('app.rank_type');
        return !empty($type[$data['rank_type']])?$type[$data['rank_type']]:'游客';
    }

    public function getRankExpireTimeAttr($val,$data)
    {
        return $val?date('Y-m-d',$val):'长期';
    }

    public function setRankExpireTimeAttr($val,$data)
    {
        $days =  (int)trim(strip_tags(html_entity_decode(config('setting.rank_limit_days'))));
        return ($data['rank_type']==2)?time()+($days*24*3600):0;
    }

    protected function front()
    {
        return $this->belongsTo('File', 'ID_front_view', 'id');
    }

    protected function reverse()
    {
        return $this->belongsTo('File', 'ID_reverse_view', 'id');
    }

    protected function quarter()
    {
        return $this->belongsTo('Quarter', 'house_id', 'id');
    }

}
