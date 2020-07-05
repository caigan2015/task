<?php
namespace app\common\validate;

use think\Validate;

class CompetitionLive extends Validate
{
    protected $rule = [
        "title|标题" => "require",
        "main_img_url|封面" => "require",
        "play_rtmp|RTMP格式播放地址" => "require",
        "plug_flow|推流地址" => "require",
    ];
}
