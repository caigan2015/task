<?php

namespace app\socket\controller;

use think\Log;
use think\worker\Server;

class Worker extends Server
{
//    public function index()
//    {
//        // 创建一个Worker监听2346端口，使用websocket协议通讯
//        $ws_worker = new \Workerman\Worker("websocket://0.0.0.0:20120");
//
//        // 启动4个进程对外提供服务
//        $ws_worker->count = 4;
//
//        // 当收到客户端发来的数据后返回hello $data给客户端
//        $ws_worker->onMessage = function($connection, $data)
//        {
//            // 向客户端发送hello $data
//            $connection->send($data);
//        };
//
//        // 运行worker
//        \Workerman\Worker::runAll();
//    }
    protected $socket = 'websocket://0.0.0.0:20120';
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection,$buffer)
    {
        Log::write('收到'.$connection->id.'发来的消息：'.$buffer);
        $connection->send($buffer);
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        $connection->send('{"type":"LOGIN","connect_id":"'.$connection->id.'","content":"新用户'.$connection->id.'已经上线"}');
    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        $connection->send('{"type":"LOGOUT","connect_id":"'.$connection->id.'","content":"用户'.$connection->id.'已经下线"}');
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {
        Log::write('实例'.$worker->name.'已经启动');
    }
}