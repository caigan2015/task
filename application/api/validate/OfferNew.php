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


class OfferNew extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'category|报修内容' => 'number',
        'request_type' => 'require|number',
        'title' => 'require',
        'description' => 'require',
        'status'=>'in:0,1',
        'id'=>'require|number'
    ];


    protected $scene = [
        'create'=>['id','description','category','','request_type','title'],
        'save'=>['description','category','','request_type','title'],
        'get'=>['status']
    ];
}