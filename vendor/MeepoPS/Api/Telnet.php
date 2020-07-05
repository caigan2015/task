<?php
namespace MeepoPS\Api;

use MeepoPS\Core\MeepoPS;

class Telnet extends MeepoPS
{

    /**
     * Telnet constructor.
     * @param string $host string 需要监听的地址
     * @param string $port string 需要监听的端口
     * @param array $contextOptionList
     */
    public function __construct($host, $port, $contextOptionList = array())
    {
        if (!$host || !$port) {
            return;
        }
        parent::__construct('telnet', $host, $port, $contextOptionList);
    }

    /**
     * 运行一个Telnet实例
     */
    public function run()
    {
        parent::run();
    }
}
