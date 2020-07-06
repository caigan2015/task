<?php

namespace app\lib\exception;


class MessageException extends BaseException
{
    public $code = 200;
    public $msg = '消息不存在或已被禁用';
    public $errorCode = 30002;
}