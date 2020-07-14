<?php

namespace app\lib\exception;

/**
 * token验证失败时抛出此异常 
 */
class TokenException extends BaseException
{
    public $code = 200;
    public $msg = 'トークンが期限切れまたは無効なトークンです';
    public $error_code = 10015;
}