<?php

namespace app\lib\exception;


class IdentifyException extends BaseException
{
    public $code = 200;
    public $msg = '身份验证失败，请稍后重试！';
    public $errorCode = 10002;
}