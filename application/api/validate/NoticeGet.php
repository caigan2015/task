<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/18
 * Time: 12:35
 */
namespace app\api\validate;

class NoticeGet extends BaseValidate
{
    protected $rules = [
        'type' => 'isPositiveInteger|number',
        'istop'=>'in:0,1',
        'isread'=>'in:0,1',
        'id'=>'require|isPositiveInteger'
    ];
    
    protected $scene = [
        'get'=>['type','istop','isread'],
        'new'=>['type','istop'],
        'read'=>['id']
    ];
}
