<?php
namespace MeepoPS;

use MeepoPS\Core\MeepoPS;

//MeepoPS根目录
define('MEEPO_PS_ROOT_PATH', dirname(__FILE__) . '/');

//载入MeepoPS配置文件
require_once MEEPO_PS_ROOT_PATH . '/Core/Config.php';

//环境检测
require_once MEEPO_PS_ROOT_PATH . '/Core/CheckEnv.php';

//载入MeepoPS核心文件
require_once MEEPO_PS_ROOT_PATH . '/Core/Init.php';

//启动MeepoPS
function runMeepoPS()
{
    MeepoPS::runMeepoPS();
}