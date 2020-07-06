<?php

namespace app\api\validate;


class OrderCommit extends BaseValidate
{
    protected $rule = [
        'offer_id'=>'require|isPositiveInteger',
    ];
}