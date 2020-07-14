<?php

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 200;
    public $msg = '注文は存在しません。注文IDを確認してください';
    public $error_code = 60000;
}