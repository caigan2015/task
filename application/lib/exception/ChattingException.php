<?php

namespace app\lib\exception;


class ChattingException extends BaseException
{
    public $code = 200;
    public $msg = '聊天记录不存在';
    public $errorCode = 30004;
}