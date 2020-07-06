<?php

namespace app\lib\exception;


class ImageException extends BaseException
{
    public $code = 200;
    public $msg = '指定图片不存在';
    public $errorCode = 40000;
}