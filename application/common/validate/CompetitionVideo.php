<?php
namespace app\common\validate;

use think\Validate;

class CompetitionVideo extends Validate
{
    protected $rule = [
        "title|影音文件标题" => "require",
//        "type|影音文件类型" => "require",
//        "competition_id|赛事ID" => "require",
//        "video_id|影音文件ID" => "require",
    ];
}
