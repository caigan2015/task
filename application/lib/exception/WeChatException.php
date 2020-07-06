<?php

namespace app\lib\exception;
use think\Exception;

/**
 * 微信服务器异常
 */
class WeChatException extends BaseException
{
    public $code = 200;
    public $msg = 'wechat unknown error';
    public $errorCode = 50000;
}