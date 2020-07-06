<?php

namespace app\api\controller;

use app\api\model\User;
use app\api\service\UserToken;
use app\common\model\Quarter;
use think\Controller;

class Test extends Controller
{
    public function index()
    {
        echo authcode('7ccduAhV/VerTH04XihHvfV2Ny8OUywwQkdPokC6', 'DECODE');
    }

}