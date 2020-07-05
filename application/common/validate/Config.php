<?php
namespace app\common\validate;

use think\Validate;

class Config extends Validate
{
    protected $rule = [
        "name|配置名称" => "require",
        "code|配置编码" => "require",
        "value|配置值" => "require",
    ];
}
