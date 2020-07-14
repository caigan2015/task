<?php

namespace app\api\validate;

class ChattingNew extends BaseValidate
{
    protected $rule = [
        'order_id' => 'require|isPositiveInteger',
        'content' => 'require',
        'file' => 'is_base64',
    ];

}