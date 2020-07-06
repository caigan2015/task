<?php

namespace app\api\validate;

class ConfigGet extends BaseValidate
{
    protected $rule = [
        'code|配置编码' => 'require',
        'tags|选择是否去除HTML标签' => 'require|number',
    ];
}
