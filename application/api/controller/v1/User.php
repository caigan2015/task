<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token as TokenService;
use app\api\service\UserToken;
use app\api\validate\AssociateGet;
use app\api\validate\UserUp;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class User extends BaseController
{
    protected $beforeActionList = [
    ];
    
    /**
     * 获取个人信息
     * @return $this
     */
    public function getUser()
    {
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $user->append(['rank_type_text','audit_text']);
//        return $user->visible(['username','nickname','mobile','hx_account','hx_pass','hx_nickname','head_img','rank_type','address','ID_card_no','IC_card_no','isaudit']);
        return new SuccessReturn([
            'info'=>$user->visible(['username','nickname','mobile','hx_account','hx_pass','hx_nickname','head_img','rank_type','address','ID_card_no','IC_card_no','isaudit'])
        ]);
    }    
    /**
     * 获取好友信息
     * @return $this
     */
    public function getFriendsByQuarterId()
    {
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $friends = IdentifyService::getFriends($user);
        return new SuccessReturn([
            'info'=>$friends
        ]);
    }

    /**更新个人信息
     * @throws SuccessMessage
     * @throws UserException
     * @throws \app\lib\exception\ParameterException
     */
    public function updateUser()
    {
        $validate = new UserUp();
        $validate->goCheck([],'update');
        $uid = TokenService::getCurrentUid();
        IdentifyService::updateUserInfo($uid);
        return new SuccessMessage();
    }

    
    public function modifyPass()
    {
        (new UserUp())->goCheck([],'password');
        IdentifyService::modifyPassword();
        return new SuccessMessage();
    }

    public function logout()
    {
        UserToken::removeToken();
        return new SuccessMessage();
    }

    public function changeMobile()
    {
        (new UserUp())->goCheck([],'change');
        IdentifyService::changeMobile();
        $this->logout();
    }

}