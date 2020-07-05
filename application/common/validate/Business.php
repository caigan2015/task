<?php
namespace app\common\validate;

use think\Validate;

class Business extends Validate
{
    protected $rule = [
        "s_id|所属分类" => "require",
        "title|业务名称" => "require",
        "cost|原价" => "require",
        "price|现价" => "require",
        "amount|成交上限" => "require",
        "content|内容详情" => "require",
    ];
}
