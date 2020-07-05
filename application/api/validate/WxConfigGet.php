<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/18
 * Time: 12:35
 */
namespace app\api\validate;

class WxConfigGet extends BaseValidate
{
    protected $rule = [
        'cur_url' => 'require'
    ];
    
    protected $message=[
        'cur_url' => '获取当前调用微信接口页面URL失败'
    ];
}
