<?php

namespace app\api\validate;


class OfferNew extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'category_id' => 'require|number',
        'request_type' => 'require|in:1,2',
        'title' => 'require|max:255',
        'description' => 'require|max:1000',
        'image'=>'is_base64',
        'id'=>'require|number'
    ];


    protected $scene = [
        'create'=>['description','category_id','request_type','title','image'],
        'save'=>['id','description','category_id','request_type','title','image'],
        'get'=>['category_id'=>'number','request_type'=>'in:1,2'],
    ];
}