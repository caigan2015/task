<?php

namespace app\lib\exception;


class OfferException extends BaseException
{
    public $code = 200;
    public $msg = 'オファーは存在しません';
    public $error_code = 30000;
}