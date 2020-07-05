<?php
namespace app\test\controller;
use app\api\model\Order;
use app\api\model\User;
use app\api\service\Token;
use app\common\model\Member as MemberModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\test\model\Category as CategoryModel;
use Firebase\JWT\JWT;
use think\Controller;
use think\Db;
use think\Log;
use think\Request;

class Index extends Controller
{
    public function index($id=1)
    {
        $category = new CategoryModel();
        $cats = CategoryModel::all();
        if($cats){
            $cats = collection($cats)->toArray();
        }
        return json($cats);
    }
    
    public function db()
    {
        $test = new CategoryModel();
        $test1 = new \CategoryModel();
    }

    public function test()
    {
       $key = 'example';
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
//            "exp" => "1356999524",
            "uid" => 7,
//            "iat" => 1356999524,
//            "nbf" => 1357000000
        );
        $jwt = JWT::encode($token, $key);
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        print_r($decoded);
    }

    public function wxconnect()
    {
        $app_id = config('wx.app_id');
        $app_secret = config('wx.app_secret');
        $redirect_uri = urlencode('http://www.task.jp/api/v1/token/user');
        $wx_connect_url = sprintf(config('wx.wx_connect_url'),$app_id,$redirect_uri);
        $this->assign('url',$wx_connect_url);
        return $this->fetch();
    }

    public function getToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        $key = md5($randChar . $timestamp . $tokenSalt);

        $wxResult['openid'] = 'ou1Pcv4FOP2i_ALzQHfyebb7fC0w';
        $wxResult['session_key'] = '123';
        $wxResult['scope'] = ScopeEnum::User;
        $wxResult['uid'] = 1;
        $value = json_encode($wxResult);
        $expire_in = config('app.token_expire_in');
        $result = cache($key, $value, $expire_in);

        if (!$result){
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'error_code' => 10005
            ]);
        }
        return $key;
    }

    public function addUser()
    {
        $now = time();
        $login_ip = Request::instance()->ip();
        $userinfo = [
            'open_id' => 'o_eMV0UI7OI-l5HuHOZgsrKfK4Rg',
            'unionid' => !empty($wxResult['unionid']) ? $wxResult['unionid'] : 'o_eMV0UI7OI-l5HuHOZgsrKfK4Rg',
            'sex' => !empty($wxResult['sex']) ? $wxResult['sex'] : 0,
            'username' => !empty($wxResult['nickname']) ? $wxResult['nickname'] : 'caicaizi',
            'country' => !empty($wxResult['country']) ? $wxResult['country'] : '美国',
            'province' => !empty($wxResult['province']) ? $wxResult['province'] : '广东',
            'city' => !empty($wxResult['city']) ? $wxResult['city'] : '中山',
            'head_img' => !empty($wxResult['headimgurl']) ? $wxResult['headimgurl'] : 'abc',
            'type' => 1,
            'first_login_time' => $now,
            'last_login_time' => $now,
            'login_count' => 1,
            'login_ip' => $login_ip?:'',
        ];

        return $user = User::create($userinfo);
    }

    public function etest()
    {
//        $order = Order::where('order_no', '=', 'B208771496048171')->lock(true)->find();
//        halt(allergicWordFilter('刘斌'));
//        halt(json_encode(['a','b','c']));
//        halt(cache('aea17d22abebf63dcf012e127204d350'));
        $user = Db::name('User')->where(['id'=>1])->field(['id','username','head_img'])->find();
        if($user) {
            return json_encode($user);
        }
    }
}
