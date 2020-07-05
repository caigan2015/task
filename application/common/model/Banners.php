<?php
namespace app\common\model;

use think\Model;

class Banners extends Model
{
    // 指定表名,不含前缀
    protected $name = 'banners';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function getTypeTextAttr($val,$data)
    {
        $str = '';
        switch ($data['type']){
            case 1:
                $str = '移动端';
                break;
            case 2:
                $str = '移动端';
                break;
            default:
                $str = '其它';
        }
        return $str;
    }

    protected function getPositionTextAttr($val,$data)
    {
        $positions = config('app.banners_position');
        return  !empty($positions[$data['position']])?$positions[$data['position']]:'未定义';
    }
}
