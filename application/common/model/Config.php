<?php
namespace app\common\model;

use think\Model;

class Config extends Model
{
    // 指定表名,不含前缀
    protected $name = 'config';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    public static function getWriteColumns()
    {
        return self::where(['is_write'=>1,'status'=>1])->column('value','code');
    }
    protected function getValueAttr($val,$data)
    {
        return html_entity_decode($val);
    }
}
