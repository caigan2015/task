<?php
namespace app\socket\controller;
use app\api\service\Token;
use MeepoPS\Core\Timer;
use MeepoPS\Core\Trident\Transfer;
use think\Cache;
use think\Db;
use think\Exception;
use think\Log;
use think\Request;

/**
 * Category资源
 */
class Trident
{

    protected $count = 0;
    public function start() {
        //这里为什么要处理一下$argv, 请看后面的详细解释
        global $argv;
        $argv[0] = !empty($argv[0]) ? $argv[0].'/'.$argv[1] : '';
        $argv[1] = !empty($argv[2]) ? $argv[2] : '';
        $argv[2] = !empty($argv[3]) ? $argv[3] : '';

        //引入MeepoPS/index.php
        vendor("MeepoPS.index");

        //-----下面就是大家熟悉的MeepoPS启动代码了-------

        //使用WebSocket传输的Api类
        $trident = new \MeepoPS\Api\Trident('websocket','0.0.0.0', '19833');

        //配置Confluence层
        $trident->confluenceName = config('app.instanceName').'管理中心';
        $trident->confluenceIp = '0.0.0.0';
        $trident->confluencePort = '19831';
        $trident->confluenceInnerIp = '127.0.0.1';

//配置Transfer层
        $trident->transferInnerIp = '0.0.0.0';
        $trident->transferInnerPort = '19832';
        $trident->transferChildProcessCount = 3;

//配置Business层
        $trident->businessName = config('app.instanceName').'业务员';
        $trident->businessChildProcessCount = 3;

        $trident->callbackStartInstance = array($this, 'startInstance');
        $trident->callbackConnect = array($this, 'connect');
        $trident->callbackConnectClose = array($this, 'connectClose');
        $trident->callbackNewData = array($this, 'newData');
        //启动三层模型
        $trident->run();
        //启动MeepoPS
        \MeepoPS\runMeepoPS();
    }

    public function startInstance($instance)
    {
        Log::write('实例'.$instance->instanceName.'已经启动');
//        foreach($instance->clientList as $client){
//            $client->send('{"content":"实例'.$instance->instanceName.'已经启动"}');
//        }
    }
    public function connect($connect)
    {
        Log::write('新用户'.$connect->unique_id.'已经上线');
        $onlineNum = count($connect->instance->clientList);
        cache('jiandong_onlinenum',$onlineNum);
        foreach($connect->instance->clientList as $client){
            //上线提示就不用告诉自己了, 对吧!
            if($connect->id != $client->id){
                $client->send('{"type":"LOGIN","uuid":"'.$connect->unique_id.'","content":"新用户'.$connect->unique_id.'已经上线","ONLINE":'.$onlineNum.'}');
            }
        }

    }

    public function instanceStop($instance)
    {
        Log::write('实例'.$instance->instanceName.'服务即将停止');
        foreach($instance->clientList as $client){
            $client->send('{"content":"服务即将停止\n"}');
        }
    }

    public function error($connect, $errCode, $errMsg)
    {
        Log::write( 'error code is ' . $errCode . '. error message: ' . $errMsg . '. connect is ' . serialize($connect));
    }
    public function sendBufferFull($connect)
    {
        Log::write( 'Waiting to send the buffer is full, we should increase the processing efficiency of the. For example, add a server');
    }
    public function sendBufferEmpty($connect)
    {
        Log::write( '用户'.$connect->unique_id."的待发送队列已经为空\n");
    }
    public function connectClose($connect)
    {
        Log::write( '链接ID为'.$connect->unique_id."的用户断开了链接\n" );
        $onlineNum = count($connect->instance->clientList);
        cache('jiandong_onlinenum',$onlineNum);
        foreach($connect->instance->clientList as $client){
            //上线提示就不用告诉自己了, 对吧!
            if($connect->id != $client->id){
                $client->send('{"type":"LOGOUT","uuid":"'.$connect->unique_id.'","content":"新用户'.$connect->unique_id.'已经下线","ONLINE":'.$onlineNum.'}');
            }
        }
    }
//    public function disconnect($connect)
//    {
//        Log::write( '链接即将被关闭, ID: ' . $connect->id . "\n");
//        foreach($connect->instance->clientList as $client){
//            //上线提示就不用告诉自己了, 对吧!
//            if($connect->id != $client->id){
//                $client->send('{"content":"新用户'.$connect->unique_id.'被迫下线"}');
//            }
//        }
//    }


    //设置收到新消息后的回调函数。业务逻辑, 自行编写即可
    //例如客户端消息格式: {"type":"SEND_ALL", "content":"hello world":"room_id":1}
    public function newData($connect, $data){

        $data_arr = json_decode($data, true);
        if(!is_array($data_arr) || empty($data_arr['type']) ||empty($data_arr['content'])){
            return;
        }
        $data_arr['msg_time'] = time();
        $data_arr['myself'] = false;
        $data_arr['type'] = strtoupper($data_arr['type']);
        //过滤
        if(allergicWordFilter($data_arr['content'])){
//            $connect->pauseRead();
            //信号定时器
//            Timer ::add(function($connect){
//                $connect->resumeRead();
                $data_arr['myself'] = true;
                $data_arr['content'] = "<span style='color: #942a25'>【系统提示：请注意措辞!】</span>";
                \MeepoPS\Core\Trident\AppBusiness::sendToMe(json_encode($data_arr));
//            }, array($connect), 10, false);
            return;
        }
        switch($data_arr['type']){
            case 'SEND_ALL':
                \MeepoPS\Core\Trident\AppBusiness::sendToAll(json_encode($data_arr));
                break;
            case 'SEND_ONE':
                $clientId = $data_arr['send_to_one'];
                \MeepoPS\Core\Trident\AppBusiness::sendToOne(json_encode($data_arr), $clientId);
                break;
            default:
                return;
        }
        if(config('app.guest_switch')){
            $this->saveData($data_arr);
        }
        $onlineNum = cache('jiandong_onlinenum');
        $data_arr['ONLINE'] = $onlineNum;
        $data_arr['myself'] = true;

        \MeepoPS\Core\Trident\AppBusiness::sendToMe(json_encode($data_arr));
    }

    private function saveData($data = [])
    {
//        $data['token'] = '0e5d397f79e49fd84ce95178a9dfc0fa';
        if(empty($data) || empty($data['token']) || empty($data['type']) || empty($data['content']) || empty($data['room_id']) || empty($data['user'])){
            Log::write( '聊天记录参数缺少:'.json_encode($data),'ERROR' );
            return '';
        }
        try{
            $uid = $this->getUid($data['token']);
            if(!empty($uid)){
                $save['uid'] = $uid;
                $save['is_show'] = 1 ;
                $save['room_id'] = $data['room_id'];
                $save['type'] = $data['type'];
                $save['content'] = $data['content'];
                $save['user'] = !empty($data['user'])?json_encode($data['user']):$this->getUserInfo($data['token']);
                $save['msg_time'] = $data['msg_time'];
                $save['send_to'] = isset($data['send_to_one'])?$data['send_to_one']:0;
    
                $res = Db::name('guest')->insert($save);
                if(!$res){
                    Log::write( '聊天记录保存失败'.Db::name('guest')->getLastSql(),'ERROR' );
                }

            }
        }catch (Exception $e){
            Log::write( '保存聊天记录出错:'.$e->getMessage(),'ERROR' );
        }
    }

    private function getUid($token)
    {
        if($token){
            $vars = cache($token);
            if($vars){
                if(!is_array($vars))
                {
                    $vars = json_decode($vars, true);
                }
                if (array_key_exists('uid', $vars)) {
                    return $vars['uid'];
                }
            }
        }
        return 0;
    }

    private function getUserInfo($token){
        $uid = $this->getUid($token);
        if($uid){
            $user = Db::name('User')->where(['id'=>$uid])->field(['id','username','head_img'])->find();
            if($user) {
                $user['head_img'] = config('app.base_url').$user['head_img'];
                return json_encode($user);
            }
        }
        return '';
    }
}