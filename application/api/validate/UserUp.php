<?php

namespace app\api\validate;

class UserUp extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'e_mail|メール' => 'require|email',
        'username|ユーザネーム' => 'require|length:2,25|unique:user',
        'realname|氏名' => 'require|length:2,25',
        'password|パスウード' => 'require|min:6|alphaDash',
        'repassword|確認パスウード' => 'require|min:6|alphaDash|confirm:password',
        'oldpassword|元パスウード' => 'require|min:6',
        'bank_name|銀行名' => 'require',
        'bank_branch|銀行支店' => 'require',
        'bank_account|銀行口座' => 'require',
        'head_img|ヘッドイメージ' => 'is_base64',
    ];

    protected $message  =   [
    ];

    protected $scene = [
        'profile' => ['username'=>'length:2,25', 'realname'=>'length:2,25', 'bank_name'=>'require', 'bank_branch'=>'require', 'bank_account'=>'require'],
        'password' => ['password', 'oldpassword', 'repassword'],
        'login'    => ['e_mail'=>'require', 'password'],
        'register'    => ['username', 'e_mail', 'password'],
    ];
}