<?php
namespace app\socket\controller;
use think\Log;

/**
 * Banner资源
 */ 
class MeepoPS
{

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
        $webSocket = new \MeepoPS\Api\Websocket('0.0.0.0', '19840');

//设置MeepoPS实例名称
        $webSocket->instanceName = config('app.instanceName');

        $webSocket->callbackStartInstance = array($this, 'startInstance');
        $webSocket->callbackConnect = array($this, 'connect');
        $webSocket->callbackConnectClose = array($this, 'connectClose');
        $webSocket->callbackNewData = array($this, 'newData');
        $webSocket->callbackInstanceStop = array($this, 'instanceStop');
        $webSocket->callbackSendBufferFull = array($this, 'sendBufferFull');
        $webSocket->callbackSendBufferEmpty = array($this, 'sendBufferEmpty');
        $webSocket->callbackError = array($this, 'error');
        $webSocket->callbackWSPing  = array($this, 'ping');
        $webSocket->callbackWSPong  = array($this, 'pong');
        $webSocket->callbackWSDisconnect = array($this, 'disconnect');
        //启动MeepoPS
        \MeepoPS\runMeepoPS();
    }

    public function startInstance($instance)
    {
        Log::write('实例'.$instance->instanceName.'已经启动');
    }
    public function connect($connect)
    {
        foreach($connect->instance->clientList as $client){
            //上线提示就不用告诉自己了, 对吧!
//            if($connect->id != $client->id){
                $client->send('{"type":"LOGIN","connect_id":"'.$connect->id.'","content":"新用户'.$connect->id.'已经上线"}');
//            }
        }

    }
    public function newData($connect, $data)
    {
        $data_arr = json_decode($data, true);
        if(empty($data_arr['content'])){
            return;
        }
        //过滤
        if(allergicWordFilter($data_arr['content'])){
            $connect->pauseRead();
            //信号定时器
            \MeepoPS\Core\Timer::add(function($connect){
                $connect->resumeRead();
                $data_arr['content'] = "恢复发言, 以后注意措辞!";
                $connect->send(json_encode($data_arr));
            }, array($connect), 10, false);
            return;
        }
        //离开
        if($data_arr['content'] === 'exit'){
            $data_arr['content'] ='啊朋友再见, 啊朋友再见';
            $connect->close(json_encode($data));
            return;
        }

        foreach($connect->instance->clientList as $client){

//            if($connect->id != $client->id){

                if($client->isPauseRead() === false){
                    $client->send($data);
                }
//            }
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
        Log::write( '用户'.$connect->id."的待发送队列已经为空\n");
    }
    public function connectClose($connect)
    {
        Log::write( '链接ID为'.$connect->id."的用户断开了链接\n" );
        foreach($connect->instance->clientList as $client){
            //上线提示就不用告诉自己了, 对吧!
//            if($connect->id != $client->id){
                $client->send('{"type":"LOGOUT","connect_id":"'.$connect->id.'","content":"新用户'.$connect->id.'已经下线"}');
//            }
        }
    }

/*    public function ping()
    {
        
    }

    public function pong()
    {
        
    }*/
 /*   public function disconnect($connect)
    {
        Log::write( '链接即将被关闭, ID: ' . $connect->id . "\n");
        foreach($connect->instance->clientList as $client){
            if($connect->id != $client->id){
                $client->send('{"content":"新用户'.$connect->id.'被迫下线"}');
            }
        }
    }*/
}