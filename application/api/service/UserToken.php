<?php

namespace app\api\service;

use app\api\model\Quarter;
use app\api\model\User;
use app\api\service\Identify as IdentifyService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use app\lib\exception\WeChatException;
use phpmailer\Email;
use think\Exception;
use think\Model;
use think\Request;

/**
 * 微信登录
 * 如果担心频繁被恶意调用，请限制ip
 * 以及访问频率
 */
class UserToken extends Token
{
    protected $code;
    protected $wxLoginUrl;
    protected $wxAppID;
    protected $wxAppSecret;

    function __construct($code='')
    {
        if($code){
            $this->code = $code;
            $this->wxAppID = config('wx.app_id');
            $this->wxAppSecret = config('wx.app_secret');
            $this->wxLoginUrl = sprintf(
                config('wx.gzh_login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
        }
    }

    
    /**
     * 登陆
     * 思路1：每次调用登录接口都去微信刷新一次session_key，生成新的Token，不删除久的Token
     * 思路2：检查Token有没有过期，没有过期则直接返回当前Token
     * 思路3：重新去微信刷新session_key并删除当前Token，返回新的Token
     */
    public function get()
    {
        $result = curl_get($this->wxLoginUrl);

        // 注意json_decode的第一个参数true
        // 这将使字符串被转化为数组而非对象

        $wxResult = json_decode($result, true);
        if (empty($wxResult) ||empty($wxResult['openid'])||empty($wxResult['access_token'])) {
            // 为什么以empty判断是否错误，这是根据微信返回
            // 规则摸索出来的
            // 这种情况通常是由于传入不合法的code
            throw new Exception('通过code换取网页授权access_token时异常，微信内部错误');
        }
        else {
            // 建议用明确的变量来表示是否成功
            // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
            // 这样非常不好判断，只能使用errcode是否存在来判断
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            }
            else {
                return $this->grantToken($wxResult);
            }
        }
    }

    // 判断是否重复获取
    private function duplicateFetch(){
       //TODO:目前无法简单的判断是否重复获取，还是需要去微信服务器去openid
        //TODO: 这有可能导致失效行为 
    }

    // 处理微信登陆异常
    // 那些异常应该返回客户端，那些异常不应该返回客户端
    // 需要认真思考
    private function processLoginError($wxResult)
    {
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'error_code' => $wxResult['errcode']
            ]);
    }

    // 写入缓存
    private function saveToCache($wxResult)
    {
        $key = self::generateToken();
        $value = json_encode($wxResult);
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

    // 颁发令牌
    // 只要调用登陆就颁发新令牌
    // 但旧的令牌依然可以使用
    // 所以通常令牌的有效时间比较短
    // 目前微信的express_in时间是7200秒
    // 在不设置刷新令牌（refresh_token）的情况下
    // 只能延迟自有token的过期时间超过7200秒（目前还无法确定，在express_in时间到期后
    // 还能否进行微信支付
    // 没有刷新令牌会有一个问题，就是用户的操作有可能会被突然中断
    private function grantToken($wxResult)
    {
        // 此处生成令牌使用的是TP5自带的令牌
        // 如果想要更加安全可以考虑自己生成更复杂的令牌
        // 比如使用JWT并加入盐，如果不加入盐有一定的几率伪造令牌
        //        $token = Request::instance()->token('token', 'md5');
        $openid = $wxResult['openid'];
        $access_token = $wxResult['access_token'];
        $user = User::getByOpenID($openid);
        if (!$user)
            // 借助微信的openid作为用户标识
            // 但在系统中的相关查询还是使用自己的uid
        {
            $wechat_userinfo = $this->getWechatUserInfo($access_token,$openid);
            $user = $this->newUser($wechat_userinfo);
        }
        else {
            //用户被禁用
            if($user->status!=1){
                throw new UserException();
            }
            //更新登录信息
            $this->saveUser($user->id);
        }
        $uid = $user->id;
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cachedValue);
        return $token;
    }


    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }

    // 创建新用户
    private function newUser($data)
    {
        $user = User::create($data,true);
        if(!$user){
            throw new IdentifyException([
                'msg'=>'提交注册信息失败!',
                'error_code' => 10008
            ]);
        }
        return $user;
    }

    // 更新用户
    private function updateUser($user,$data)
    {
        // 有可能会有异常，如果没有特别处理
        // 这里不需要try——catch
        // 全局异常处理会记录日志
        // 并且这样的异常属于服务器异常
        // 也不应该定义BaseException返回到客户端
        $res = $user->allowField(true)->save($data);
        if($res===false){
            throw new IdentifyException([
                'msg'=>'提交注册信息失败!',
                'error_code' => 10008
            ]);
        }
        return $user;
    }

    private function getWechatUserInfo($access_token,$openid)
    {
        $userinfo_url = sprintf(config('wx.userinfo_url'),$access_token,$openid);

        $result = curl_get($userinfo_url);

        // 注意json_decode的第一个参数true
        // 这将使字符串被转化为数组而非对象
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            // 为什么以empty判断是否错误，这是根据微信返回
            // 规则摸索出来的
            // 这种情况通常是由于传入不合法的code
            throw new Exception('通过access_token与openid获取微信用户信息时异常，微信内部错误');
        }
        else {
            // 建议用明确的变量来表示是否成功
            // 微信服务器并不会将错误标记为400，无论成功还是失败都标记成200
            // 这样非常不好判断，只能使用errcode是否存在来判断
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {
                $this->processLoginError($wxResult);
            }
            else {
                $now = time();
                $login_ip = Request::instance()->ip();
                $userinfo = [
                    'open_id' => $openid,
                    'unionid' => !empty($wxResult['unionid']) ? $wxResult['unionid'] : '',
                    'sex' => !empty($wxResult['sex']) ? $wxResult['sex'] : 0,
                    'username' => !empty($wxResult['nickname']) ? $wxResult['nickname'] : '',
                    'country' => !empty($wxResult['country']) ? $wxResult['country'] : '',
                    'province' => !empty($wxResult['province']) ? $wxResult['province'] : '',
                    'city' => !empty($wxResult['city']) ? $wxResult['city'] : '',
                    'head_img' => !empty($wxResult['headimgurl']) ? $wxResult['headimgurl'] : '',
                    'type' => 1,
                    'from' => 2,
                    'first_login_time' => $now,
                    'last_login_time' => $now,
                    'login_count' => 1,
                    'login_ip' => $login_ip?:'',
                ];

                return $userinfo;
            }
        }

    }

    private function saveUser($uid)
    {
        $now = time();
        $where['id'] = $uid;
        $login_ip = Request::instance()->ip();
        $update['last_login_time'] = $now;
        $update['login_count'] = ['exp', 'login_count+1'];
        $update['login_ip'] = $login_ip?:'';
        $update['update_time'] = $now;
        $user = new User();
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
        $this->newUser($data);
        //TODO 邮件
        Email::send('366585748@qq.com','我是小蔡','最近好吗？');
        return new SuccessMessage();

    }

    public function appLogin()
    {
        $request = Request::instance();
        $data = $request->post();
        $user = User::getOneByData(['e_mail'=>$data['e_mail']]);
        if(!$user){
            throw new UserException([
                'msg'=>'用户不存在或被禁用',
                'error_code'=>10004
            ]);
        }

        $uid = $user->id;
        $this->saveUser($uid);
        $cachedValue = $this->prepareCachedValue([], $uid);
        $token = $this->saveToCache($cachedValue);
        return [
            'token'=>$token,
            'user'=>$user
        ];
    }

}
