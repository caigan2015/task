<?php

namespace app\api\service;

use app\api\model\User as UserModel;
use app\api\service\Identify as IdentifyService;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use phpmailer\Email;
use function Qiniu\base64_urlSafeEncode;
use think\Request;

/**
 * 微信登录
 * 如果担心频繁被恶意调用，请限制ip
 * 以及访问频率
 */
class UserToken
{

    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }


    // 写入缓存
    private function saveToCache($Result)
    {
        $key = self::generateToken();
        $value = json_encode($Result);
        $expire_in = config('app.token_expire_in');
        $result = cache($key, $value, $expire_in);

        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 50000
            ]);
        }
        return $key;
    }

    private function prepareCachedValue($value = [], $uid)
    {
        $cachedValue = $value;
        $cachedValue['uid'] = $uid;
        return $cachedValue;
    }

    // 创建新用户
    private function createUser($data)
    {
        $user = UserModel::create($data,true);
        if(!$user){
            throw new IdentifyException([
                'msg'=>'提交注册信息失败!',
                'error_code' => 10008
            ]);
        }
        return $user;
    }

    private function saveUser($uid)
    {
        $now = date('Y-m-d H:i:s');
        $where['id'] = $uid;
        $update['login_time'] = $now;
        $update['update_time'] = $now;
        $user = new UserModel();
        $user->save($update,$where);
        return $user;
    }

    public function appRegister()
    {
        $request = Request::instance();
        $data = $request->post();
        IdentifyService::isRegistered($data['e_mail']);
        $data['password'] = \IAuth::setPassword($data['password']);
        $data['login_time'] = date('Y-m-d H:i:s');
        $user = $this->createUser($data);
        //TODO 邮件
        $url = url('/user/verify?code=' . base64_urlSafeEncode($user->id));
//        Email::send($data['e_mail'],$url);
        return new SuccessMessage();

    }

    public function appLogin()
    {
        $request = Request::instance();
        $data = $request->post();
        $user = UserModel::get(['e_mail'=>$data['e_mail']]);
        if(!$user){
            throw new UserException([
                'msg'=>'用户不存在',
                'error_code'=>10004
            ]);
        }

        if($user->status == 2){
            throw new UserException([
                'msg'=>'请前往邮箱确认',
                'error_code'=>10004
            ]);
        }

        if($user->status == 0){
            throw new UserException([
                'msg'=>'用户禁用',
                'error_code'=>10004
            ]);
        }
        if($user->password != \IAuth::setPassword($data['password'])){
            throw new UserException([
                'msg'=>'用户密码不正确',
                'error_code'=>10004
            ]);
        }
        $uid = $user->id;
        $this->saveUser($uid);
        $cachedValue = $this->prepareCachedValue([], $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }

}
