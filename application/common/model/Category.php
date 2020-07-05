<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    // 指定表名,不含前缀
    protected $name = 'category';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    public static function getNormalData($where,$field=[])
    {
        return self::where($where)->order('sort asc')->field($field)->select();
    }

    protected function getParentNameAttr($val,$data)
    {
        if($data['pid']==0) return '顶级';
        return self::where(['id'=>$data['pid']])->value('name');
    }

}
