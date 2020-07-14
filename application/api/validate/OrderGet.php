<?php

namespace app\api\validate;


class OrderGet extends BaseValidate
{
    protected $rule = [
        'date'=>'dateFormat:Y-m',
        'request_type'=>'in:1,2',
    ];
}