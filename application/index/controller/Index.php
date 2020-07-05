<?php

namespace app\index\controller;

use app\common\model\User;
use function Qiniu\base64_urlSafeDecode;
use function Qiniu\base64_urlSafeEncode;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->view->fetch();
    }

    public function taskInfo()
    {
        return "taskInfo";
    }


    public function login()
    {

        $uid = $this->request->get('code');
        if($uid){
            $user = (new User)->find(base64_urlSafeDecode($uid));
            if(!$user){
                return $this->view->fetch('error');
            }
            $user->status = 1;
            $user->save();
        }
        return "login";
    }


    public function profile()
    {
        return "profile";
    }


    public function createMyOffer()
    {
        return "createMyOffer";
    }

    public function myOfferList()
    {
        return "myOfferList";
    }

    public function myTaskList()
    {
        return "myTaskList";
    }

    public function myOfferInfo()
    {
        return "myOfferInfo";
    }

    public function taskOrder()
    {
        return "taskOrder";
    }


}
