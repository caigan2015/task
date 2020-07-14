<?php

namespace app\api\service;

use app\api\model\User as UserModel;
use app\api\service\Identify as IdentifyService;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use phpmailer\Email;
use think\Request;

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
                'msg' => 'サーバーキャッシュ例外',
                'error_code' => 50000
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

    /**
     * 创建新用户
     *
     */
    private function createUser($data)
    {
        $user = UserModel::create($data,true);
        if(!$user){
            throw new IdentifyException([
                'msg'=>'登録に失敗しました!',
                'error_code' => 10004
            ]);
        }
        return $user;
    }

    /**
     * @param $uid
     * @return UserModel
     */
    private function saveUser($user)
    {
        $now = date('Y-m-d H:i:s');
        $user -> login_time = $now;
        $user->update_time = $now;
        $user->save();
        return $user;
    }

    /**
     * @return SuccessMessage
     * @throws IdentifyException
     */
    public function appRegister()
    {
        $data = Request::instance()->post();
        IdentifyService::isRegistered($data['e_mail']);
        $password = $data['password'];
        $data['password'] = \IAuth::setPassword($password);
        $data['login_time'] = date('Y-m-d H:i:s');
        $user = $this->createUser($data);
        $url = config('app.base_url') . url('/user/verify?code=' . base64_urlSafeEncode($user->id));
        $content = <<<EOF
            <h3>お客様：</h3>
            <div style="text-indent: 30px">
            <p>恭喜您，您的账号的已经申请成功！</p><p>欢迎加入ASK！</p>
            <p>您的用户名为：<span style="color:red;font-weight:700">{$data['username']}</span></p>
            <p>您的密码为：<span style="color:red;font-weight:700">{$password}</span></p>
            <p>请点击链接 {$url} 进行验证,您可以通过改收件箱邮箱地址进行登录！</p>
            <p>该邮件是系统自动发送，请勿回复！</p>
            </div>
EOF;
        $result = Email::send($data['e_mail'],'ASK登録',$content);
        if(!$result){
            throw new IdentifyException([
                'msg' => '確認メールを送信できませんでした',
                'error_code' => 10005
            ]);
        }
        return new SuccessMessage();

    }

    /**
     * @return array
     * @throws UserException
     */
    public function appLogin()
    {
        $request = Request::instance();
        $data = $request->post();
        $user = UserModel::get(['e_mail|username'=>$data['e_mail']]);
        if(!$user){
            throw new UserException([
                'msg'=>'ユーザーは存在しません',
                'error_code'=>10006
            ]);
        }

        if($user->status == 2){
            throw new UserException([
                'msg'=>'ユーザーが登録しました。メールボックスに移動して確認してください',
                'error_code'=>10007
            ]);
        }

        if($user->status == 0){
            throw new UserException([
                'msg'=>'ユーザーは無効です',
                'error_code'=>10008
            ]);
        }
        if($user->password != \IAuth::setPassword($data['password'])){
            throw new UserException([
                'msg'=>'ユーザーパスワードが正しくありません',
                'error_code'=>10009
            ]);
        }
        $uid = $user->id;
        $cachedValue = $this->prepareCachedValue([], $uid);
        $token = $this->saveToCache($cachedValue);
        $user->token = $token;
        $user = $this->saveUser($user);
        return ['token' => $token,'user_info' => $user->visible(['id','username','head_img'])];
    }

}
