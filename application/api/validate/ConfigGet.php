<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/18
 * Time: 12:35
 */
namespace app\api\validate;

class ConfigGet extends BaseValidate
{
    protected $rule = [
        'code|配置编码' => 'require',
        'tags|选择是否去除HTML标签' => 'require|number',
    ];
}
