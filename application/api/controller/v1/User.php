<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token as TokenService;
use app\api\service\UserToken;
use app\api\validate\UserUp;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;

class User extends BaseController
{
    protected $beforeActionList = [
    ];

    /**
     * @return SuccessMessage
     */
    public function register()
    {
        (new UserUp())->goCheck([], 'register');

        (new UserToken())->appRegister();
        return new SuccessMessage();

    }

    /**
     * @return SuccessReturn
     */
    public function login()
    {
        (new UserUp())->goCheck([], 'login');
        $userToken = (new UserToken())->appLogin();
        return new SuccessReturn([
            'info' => [
                'token' => $userToken
            ]
        ]);
    }

    /**
     * @return SuccessMessage
     */
    public function resetPassword()
    {
        (new UserUp())->goCheck([], 'password');
        (new IdentifyService())->resetPassword();

        return new SuccessMessage();

    }

    /**
     * @return SuccessReturn
     */
    public function getUser()
    {
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        return new SuccessReturn([
            'info' => $user
        ]);
    }


    /**
     * @return SuccessMessage
     */
    public function updateProfile()
    {
        (new UserUp())->goCheck([], 'profile');
        $uid = TokenService::getCurrentUid();
        IdentifyService::updateUserInfo($uid);
        return new SuccessMessage();
    }

    /**
     * @return SuccessMessage
     */
    public function logout()
    {
        UserToken::removeToken();
        return new SuccessMessage();
    }


}