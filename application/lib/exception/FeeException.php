<?php

namespace app\lib\exception;


class FeeException extends BaseException
{
    public $code = 200;
    public $msg = '水电煤报数记录不存在';
    public $errorCode = 30007;
}