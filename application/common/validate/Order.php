<?php
namespace app\common\validate;

use think\Validate;

class Order extends Validate
{
    protected $rule = [
        "status|订单状态" => "require",
    ];
}
