<?php
namespace app\common\validate;

use think\Validate;

class Banners extends Validate
{
    protected $rule = [
        "title|名称" => "require",
        "type|客户端" => "require",
        "img_url|图片路径" => "require",
    ];
}
