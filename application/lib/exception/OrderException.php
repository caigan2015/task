<?php

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 200;
    public $msg = '订单不存在，请检查订单ID';
    public $errorCode = 60000;
}