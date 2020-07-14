<?php

namespace app\lib\exception;


class IdentifyException extends BaseException
{
    public $code = 200;
    public $msg = '認証に失敗しました。しばらくしてからもう一度お試しください！';
    public $error_code = 10002;
}