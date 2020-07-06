<?php

namespace app\lib\exception;


class PastportException extends BaseException
{
    public $code = 200;
    public $msg = '访客通行证不存在';
    public $errorCode = 30001;
}