<?php

namespace app\api\validate;

class ConfigGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require',
        'tags' => 'require|number',
    ];
}
