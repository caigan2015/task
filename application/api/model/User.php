<?php

namespace app\api\model;


class User extends BaseModel
{
    protected $createTime = 'register_time';
    protected $hidden = ['status','update_time','register_time'];

    /**
     * 用户是否存在
     * 存在返回uid，不存在返回0
     */
    public static function getByOpenID($openid)
    {
        $user = self::where('open_id', '=', $openid)
            ->find();
        return $user;
    }

    public static function getUserValue($data,$field)
    {
        return self::where($data)->value($field);
    }

    public static function getNormalOneById($id,$field = [])
    {
        return self::where(['id'=>$id,'isdelete'=>0,'status'=>1])->field($field)->find();
    }

    public static function updatePass($newPass,$where)
    {
        return self::update(['password'=>\IAuth::setPassword($newPass)],$where);
    }

    public static function getHouseIds()
    {
        return self::distinct(true)->column('house_id');
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

    protected function getHeadImgAttr($val,$data)
    {
        return $this->prefixImgUrl($val,$data);
    }

    protected function getIDCardNoAttr($val,$data)
    {
        return plusStar($val,6,4);
    }
    protected function getICCardNoAttr($val,$data)
    {
        return plusStar($val,6,4);
    }


    protected function getRankTypeTextAttr($val,$data)
    {
        $type = config('app.rank_type');
        return !empty($type[$data['rank_type']])?$type[$data['rank_type']]:'其它';
    }


    protected function getAuditTextAttr($val,$data)
    {
        switch($data['isaudit']){
            case 1:
                $str = '审核通过';
                break;
            case 2:
                $str = '审核不通过';
                break;
            default:
                $str = '等待审核';

        }
        return $str;
    }

    protected function getQuarterNameAttr($val,$data)
    {
        if(!empty($data['house_id'])){
            $quarter = Quarter::getTopOne($data['house_id'],['id','pid','name']);;
            return $quarter['name'];
        }
        return '';
    }

//    protected function getRankExpireTimeAttr($val,$data)
//    {
//        return $val?date('Y-m-d H:i',$val):'-';
//    }
}
