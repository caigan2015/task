<?php

namespace app\lib\exception;

class UserException extends BaseException
{
    public $code = 200;
    public $msg = 'ユーザーが存在しないか無効になっています';
    public $error_code = 10000;
}