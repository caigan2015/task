<?php
namespace app\common\validate;

use think\Validate;

class UserInfo extends Validate
{
    protected $rule = [
        "cn_name|中文名" => "require",
        "birthday|出生日期" => "require",
        "birth_addr|出生地点" => "require",
        "stature|身高" => "require",
        "weight|体重" => "require",
        "native_place|籍贯" => "require",
        "nation|民族" => "require",
        "individual|个人简介" => "require",
    ];
}
