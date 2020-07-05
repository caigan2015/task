<?php
namespace app\api\validate;

class PhoneGet extends BaseValidate
{
    protected $rule = [
        'mobile' => 'require|isMobile',
    ];
}
