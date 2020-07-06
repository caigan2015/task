<?php

namespace app\api\validate;

class MessageGet extends BaseValidate
{
    protected $rules = [
        'type' => 'isPositiveInteger|number',
        'isread'=>'in:0,1',
        'id'=>'require|isPositiveInteger'
    ];
    
    protected $scene = [
        'get'=>['type','isread'],
        'new'=>['type'],
        'read'=>['id']
    ];
}
