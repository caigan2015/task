<?php
namespace app\common\model;

use think\Model;

class Feeds extends Model
{
    // 指定表名,不含前缀
    protected $name = 'feeds';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';


    protected function getTypeTextAttr($val,$data)
    {
        $str = '';
        switch ($data['type']){
            case 1:
                $str = '投诉';
                break;
            case 2:
                $str = '建议';
                break;
            default:
                $str = '其它';
        }
        return $str;
    }


    protected function getSourceTextAttr($val,$data)
    {
        $str = '';
        switch ($data['source']){
            case 1:
                $str = '公众号';
                break;
            case 2:
                $str = 'APP';
                break;
            default:
                $str = '其它';
        }
        return $str;
    }


    protected function user()
    {
        return  $this->belongsTo('User','user_id','id');
    }

}
