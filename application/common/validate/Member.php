<?php
namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        "cn_name|姓名" => "require",
        "mobile|手机号码" => "require",
        "sex|性别" => "require",
        "birthday|生日" => "require",
        "expire_time|有效日期" => "require",
    ];
}
