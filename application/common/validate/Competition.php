<?php
namespace app\common\validate;

use think\Validate;

class Competition extends Validate
{
    protected $rule = [
        "title|赛事标题" => "require",
        "type|类型" => "require",
        "main_img_url|封面图片" => "require",
        "play_time|比赛时间" => "require",
    ];
}
