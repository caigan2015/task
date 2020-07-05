<?php
namespace app\common\model;

use think\Model;

class User extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    protected $createTime = 'register_time';

    public function member()
    {
        return $this->hasOne('Member','user_id','id');
    }

    public static function getUserColumn($data,$field)
    {
        return self::where($data)->column($field);
    }
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

}
