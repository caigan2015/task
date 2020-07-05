<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/19
 * Time: 2:42
 */

namespace app\api\model;


use think\Model;
use traits\model\SoftDelete;

class BaseModel extends Model
{
    // 软删除，设置后在查询时要特别注意whereOr
    // 使用whereOr会将设置了软删除的记录也查询出来
    // 可以对比下SQL语句，看看whereOr的SQL
//    use SoftDelete;
//
//    protected $field = true;
    protected $autoWriteTimestamp = 'datetime';//配置开启了


    public static function getDataColumn($data,$field)
    {
        return self::where($data)->where(['status'=>1])->column($field);
    }

    public static function getDataValue($data,$field)
    {
        return self::where($data)->where(['status'=>1])->value($field);
    }


    public static function getAllByData($data,$field = [],$order = [])
    {
        return self::where($data)->where(['status'=>1])->field($field)->order($order)->select();
    }
    public static function getOneByData($data,$field=[])
    {
        return self::where($data)->where(['status'=>1])->field($field)->find();
    }


    protected function  prefixImgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('app.base_url').$value;
        }
        return $finalUrl;
    }

}