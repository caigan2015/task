<?php

namespace app\lib\exception;


class ConfigException extends BaseException
{
    public $code = 200;
    public $msg = '指定された構成アイテムは存在しません';
    public $error_code = 40004;
}