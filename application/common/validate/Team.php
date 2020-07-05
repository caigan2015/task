<?php
namespace app\common\validate;

use think\Validate;

class Team extends Validate
{
    protected $rule = [
        "name|中文队名" => "require",
        "establishment_time|成立时间" => "require",
        "captain|队长" => "require",
        "address|所在地" => "require",
        "coach|主教练" => "require",
    ];
}
