<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/26
 * Time: 14:15
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\service\AliNotify;
use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\SuccessReturn;
use think\Controller;
use think\Log;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    /**
     * 预处理(公众号)
     * @param string $id
     * @return array
     */
    public function getPreOrder($id='')
    {
        (new IDMustBePositiveInt()) -> goCheck();
        $result= (new PayService($id))->Pay();
        return new SuccessReturn([
            'info'=>$result
        ]);
//        return $pay->Pay();
    }

    /**
     * 预处理(wxAPP)
     * @param string $id
     * @return array
     */
    public function getPreOrderForWxAPP($id='')
    {
        (new IDMustBePositiveInt()) -> goCheck();
        $pay= new PayService($id);
        $result = $pay->wxAppPay();

        return new SuccessReturn([
            'info'=>$result
        ]);
    }
    /**
     * 预处理(aliAPP)
     * @param string $id
     * @return array
     */
    public function getPreOrderForAliAPP($id='')
    {
        (new IDMustBePositiveInt()) -> goCheck();
        $pay= new PayService($id);
        $result = $pay->aliAppPay();

        return new SuccessReturn([
            'info'=>$result
        ]);
    }

    public function redirectNotify()
    {
        $notify = new WxNotify();
        $notify->handle();
    }

    public function notifyConcurrency()
    {
        $notify = new WxNotify();
        $notify->handle();
    }
    
    public function receiveNotify()
    {
//        $xmlData = file_get_contents('php://input');
//        error_log($xmlData);
        $notify = new WxNotify();
        $notify->handle();
//        $xmlData = file_get_contents('php://input');
//        $result = curl_post_raw('http://www.lhuf3.cn/api/v1/pay/re_notify?XDEBUG_SESSION_START=18462',
//            $xmlData);
//        return $result;
//        Log::error($xmlData);
    }    
    public function aliNotify()
    {
        $pay = new AliNotify();
        $pay->NotifyProcess();
    }
}