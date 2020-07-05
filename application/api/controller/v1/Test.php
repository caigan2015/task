<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/3/5
 * Time: 17:59
 */

namespace app\api\controller\v1;

use app\api\model\OrderFee;
use app\api\model\User;
use app\api\service\UserToken;
use think\Controller;

class Test extends Controller
{
    public function index()
    {
//        $arr = [
//            ['a'=>1,'b'=>2,'c'=>3],
//            ['a'=>4,'b'=>5,'c'=>6],
//            ['a'=>7,'b'=>8,'c'=>9],
//            ['a'=>10,'b'=>11,'c'=>12],
//        ];
//
//        halt(max(array_column($arr,'b')));
//        $user = User::get(19);
//        halt($user);
        halt(getShortUrl(config('app.share_past_uri')));
    }

}