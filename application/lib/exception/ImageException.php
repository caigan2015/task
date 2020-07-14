<?php

namespace app\lib\exception;


class ImageException extends BaseException
{
    public $code = 200;
    public $msg = '指定された画像は存在しません';
    public $error_code = 40000;
}