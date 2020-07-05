<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/3/5
 * Time: 17:59
 */

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