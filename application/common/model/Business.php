<?php
namespace app\common\model;

use app\api\model\Category;
use think\Model;

class Business extends Model
{
    // 指定表名,不含前缀
    protected $name = 'business';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected $hidden = ['isdelete','update_time'];
    protected function getCateNameAttr($val,$data){
        return (new Category())->where(['id'=>$data['s_id']])->value('name');
    }
    
    protected function getHotNameAttr($val,$data){
        return $data['istui']==1?'是':'否';
    }


    protected function getContentAttr($val,$data)
    {
        return html_entity_decode($val);
    }
}
