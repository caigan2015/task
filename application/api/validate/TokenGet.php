<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/18
 * Time: 12:35
 */
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
