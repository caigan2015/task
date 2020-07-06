<?php

namespace app\lib\exception;


class ConfigException extends BaseException
{
    public $code = 200;
    public $msg = '指定配置项不存在';
    public $errorCode = 40004;
}