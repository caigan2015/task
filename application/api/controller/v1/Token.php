<?php
namespace app\api\controller\v1;


use app\api\service\AppToken;
use app\api\service\Token as TokenService;
use app\api\service\UserToken;
use app\api\validate\AppTokenGet;
use app\api\validate\TokenGet;
use app\api\validate\WxConfigGet;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessReturn;
use app\lib\exception\TokenException;
use think\Exception;
use think\Request;

/**
 * 获取令牌，相当于登录
 */
class Token
{
    /**
     * 用户获取令牌（登陆）
     * @url /token
     * @POST code
     * @note 虽然查询应该使用get，但为了稍微增强安全性，所以使用POST
     */
    public function getToken($code='')
    {
        (new TokenGet())->goCheck();
        $wx = new UserToken($code);
        $token = $wx->get();

        return new SuccessReturn([
            'info'=>[
                'token' => $token
            ]
        ]);
    }

    /**
     * 第三方应用获取令牌
     * @url /app_token?
     * @POST ac=:ac se=:secret
     */
    public function getAppToken($ac='', $se='')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET');
        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return new SuccessReturn([
            'info'=>[
                'token' => $token
            ]
        ]);
    }

    public function verifyToken($token='')
    {
        if(!$token){
            throw new ParameterException([
                'token不允许为空'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return new SuccessReturn([
            'info'=>[
                'isValid' => $valid
            ]
        ]);
//        return [
//            'isValid' => $valid
//        ];
    }
}