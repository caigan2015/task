<?php

namespace app\lib\exception;


class ChattingException extends BaseException
{
    public $code = 200;
    public $msg = 'チャットの履歴は存在しません';
    public $error_code = 60009;
}