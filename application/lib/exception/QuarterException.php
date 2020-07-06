<?php

namespace app\lib\exception;


class QuarterException extends BaseException
{
    public $code = 200;
    public $msg = '住宅数据不存在';
    public $errorCode = 30001;
}