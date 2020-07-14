<?php

namespace app\lib\exception;

/**
 * token验证失败时抛出此异常 
 */
class ForbiddenException extends BaseException
{
    public $code = 200;
    public $msg = '不十分な権限';
    public $errorCode = 10001;
}