<?php

namespace app\api\validate;

class ChattingNew extends BaseValidate
{
    protected $rule = [
        'order_id' => 'require|isPositiveInteger',
        'content' => 'require',
        'file' => 'is_base64',
    ];

    protected $scene = [
        'create'=>['order_id','content','file'],
        'get'=>['order_id']
    ];
}