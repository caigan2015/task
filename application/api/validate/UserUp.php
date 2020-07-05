<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 3:01
 */

namespace app\api\validate;

class UserUp extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'e_mail|メール' => 'require|email',
        'username|ユーザネーム' => 'require|length:2,25',
        'realname|氏名' => 'require|length:2,25',
        'password|パスウード' => 'require|min:6|alphaDash',
        'repassword|确认密码' => 'require|min:6|alphaDash|confirm:password',
        'oldpassword|原密码' => 'require|min:6',
        'bank_name|原密码' => 'require',
        'bank_branch|原密码' => 'require',
        'bank_account|原密码' => 'require',
        'head_img|个人头像' => 'is_base64',
    ];
    protected $message  =   [
//        'username.length' => '姓名长度必须在2~25个字符之间',
//        'realname.length' => '昵称长度必须在2~25个字符之间',
//        'nickname.regex' => '昵称作为环信账号必须是字母与数字组合',
//        'nickname.unique' => '昵称已存在，作为环信账号必须唯一',
//        'mobile.isMobile'   => '手机号码格式错误',
//        'code.checkCode'   => '验证码不正确',
    ];


    protected $scene = [
        'profile' => ['username'=>'length:2,25', 'realname'=>'length:2,25', 'bank_name'=>'require', 'bank_branch'=>'require', 'bank_account'=>'require'],
        'password' => ['password', 'oldpassword', 'repassword'],
        'login'    => ['e_mail', 'password'],
        'register'    => ['username', 'e_mail', 'password'],
    ];


    protected function checkNewcode($value, $rule='', $data=[], $field='')
    {
        return $this->verifyCode($data['newmobile'],$value);
    }

}