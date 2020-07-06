<?php

namespace app\lib\exception;


class AdviceException extends BaseException
{
    public $code = 200;
    public $msg = '用户反馈记录不存在';
    public $errorCode = 30005;
}