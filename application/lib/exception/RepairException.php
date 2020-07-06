<?php

namespace app\lib\exception;


class OfferException extends BaseException
{
    public $code = 200;
    public $msg = '报修记录不存在';
    public $errorCode = 30000;
}