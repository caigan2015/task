<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 10:32
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User;
use app\api\service\Identify as IdentifyService;
use app\api\service\UserToken;
use app\api\validate\PhoneGet;
use app\api\validate\UserUp;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Identify extends BaseController
{

    public function register()
    {
        (new UserUp())->goCheck([], 'register');
        
        (new UserToken())->appRegister();
        return new SuccessMessage();

    }

    public function login()
    {
        (new UserUp())->goCheck([], 'login');
        $userToken = (new UserToken())->appLogin();
        return new SuccessReturn([
            'info'=>$userToken
        ]);
//        return $userToken;
    }

    public function forgetPass()
    {
        (new UserUp())->goCheck([], 'forget');
        (new IdentifyService())->forgetPassword();

        return new SuccessMessage();

    }
}