<?php

namespace app\lib\exception;

/**
 * 404时抛出此异常
 */
class MissException extends BaseException
{
    public $code = 200;
    public $msg = 'global:your required resource are not found';
    public $error_code = 10001;
}