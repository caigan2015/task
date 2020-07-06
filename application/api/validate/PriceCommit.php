<?php

namespace app\api\validate;


class PriceCommit extends BaseValidate
{
    protected $rule = [
        'id' => 'require|number',
        'price' => 'require|number',
    ];
}