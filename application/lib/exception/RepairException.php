<?php
/**
 * Created by 七月
 * Author: 七月
 * Date: 2017/2/18
 * Time: 13:47
 */

namespace app\lib\exception;


class OfferException extends BaseException
{
    public $code = 200;
    public $msg = '报修记录不存在';
    public $errorCode = 30000;
}