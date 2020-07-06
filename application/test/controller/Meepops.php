<?php
namespace app\test\controller;

use think\Controller;

/**
 * Category资源
 */ 
class Meepops extends Controller
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
        $webSocket = new \MeepoPS\Api\Websocket('0.0.0.0', '19910');
        $webSocket->callbackStartInstance = array('\RobotChat\Service\CallbackService', 'startInstance');
        $webSocket->callbackConnect = array('\RobotChat\Service\CallbackService', 'startInstance');
        $webSocket->callbackNewData = array('\RobotChat\Service\CallbackService', 'newData');
        //启动MeepoPS
        \MeepoPS\runMeepoPS();
    }
}