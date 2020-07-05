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


class AdviceNew extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'content|内容' => 'require|length:2,1000',
        'image_1|图片一' => 'is_base64',
        'image_2|图片二' => 'is_base64',
        'image_3|图片三' => 'is_base64',
        'image_4|图片四' => 'is_base64',
        'type'=>'require|number',
        'disaster_type'=>'requireif:type,5|number',
        'id'=>'require|isPositiveInteger'
    ];

    protected $scene = [
        'create'=>['content','image_1','image_2','image_3','image_4','type','disaster_type'],
        'edit'=>['id','content'=>'length:2,1000','image_1','image_2','image_3','image_4'],
        'read'=>['type'=>'number','disaster_type'=>'requireif:type,5|number']
    ];
}