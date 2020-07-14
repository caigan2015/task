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

    public function verify()
    {
        $code = $this->request->get('code');
        if($code){
            $pos = strrpos($code,config('url_html_suffix'));
            $uid = base64_urlSafeDecode(($pos===false) ? $code : substr($code,0,($pos-1)));
            $user = (new User)->find($uid);
            if(!$user){
                return $this->view->fetch('error');
            }
            $user->status = 1;
            $user->save();
            return $this->login();
        }
        return $this->view->fetch('error');
    }

    public function login()
    {
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
