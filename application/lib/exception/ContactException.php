<?php

namespace app\lib\exception;


class ContactException extends BaseException
{
    public $code = 200;
    public $msg = '常用电话不存在';
    public $errorCode = 30009;
}