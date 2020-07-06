<?php

namespace app\api\validate;

class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require'
    ];
    
    protected $message=[
        'code' => '获取CODE失败，请检查网页是否授权'
    ];
}
