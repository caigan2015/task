<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 3:01
 */

namespace app\api\validate;


class RepairNew extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'description|报修内容' => 'require|length:2,1000',
        'image_1|图片一' => 'is_base64',
        'image_2|图片二' => 'is_base64',
        'image_3|图片三' => 'is_base64',
        'image_4|图片四' => 'is_base64',
        'fix_status'=>'in:0,1',
        'id'=>'require|number'
    ];


    protected $scene = [
        'create'=>['description','image_1','image_2','image_3','image_4'],
        'edit'=>['id','description','image_1','image_2','image_3','image_4'],
        'get'=>['fix_status']
    ];
}