<?php

namespace app\lib\exception;

/**
 * 404时抛出此异常
 */
class DeviceException extends BaseException
{
    public $code = 200;
    public $msg = 'Device not register or disabled';
    public $errorCode = 301;
}