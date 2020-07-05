<?php

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 200;
    public $msg = '用户不存在或被禁用';
    public $errorCode = 10004;
}