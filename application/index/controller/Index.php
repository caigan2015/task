<?php

namespace app\index\controller;

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
