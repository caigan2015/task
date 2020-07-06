<?php

namespace app\lib\exception;


class SmsException extends BaseException
{
    public $code = 500;
    public $msg = '发送短信失败';
    public $errorCode = 70000;
}