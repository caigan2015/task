<?php
namespace app\common\model;

use think\Model;

class Member extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    public static function getNormalMembers($data=[],$field=[])
    {
        return self::where($data)->where(['user_id'=>0,'status'=>1,'isdelete'=>0])->order('id desc')->field($field)->select();
    }

    public static function getFieldByName($where=[],$field = '',$flag = false)
    {
        return self::where($where)->getField($field,$flag);
    }

    public static function getMemberUserIds()
    {
        return self::where(['user_id'=>['neq',0],'status'=>1,'isdelete'=>0])->column('user_id');
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

    public function getPhotoAttr($val,$data)
    {
        $baseUrl = config('app.base_url');
        if($data['from']==1){
            if( empty($val) || !file_exists('.'.$val)){
                return $baseUrl.'\static\admin\images\avatar-default.jpg';
            }
            return $baseUrl.$val;
        }
        return $val;
    }
    
    protected function getAgeAttr($val,$data)
    {
        return birthday($data['birthday'])?:'-';
    }
    protected function getBirthdayAttr($val,$data)
    {
        return strtotime($val)>0?$val:'-';
    }

    protected function setExpireTimeAttr($val,$data)
    {
        return strtotime($val?:$val.' 23:59:59');

    }

    protected function getExpireTimeAttr($val,$data)
    {
        return $val?date('Y-m-d',$val):'<span style="color: #FF2F2F">未设置</span>';
    }
}
