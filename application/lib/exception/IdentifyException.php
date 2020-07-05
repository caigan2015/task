<?php
/**
 * Created by 七月
 * Author: 七月
 * Date: 2017/2/18
 * Time: 13:47
 */

namespace app\lib\exception;


class IdentifyException extends BaseException
{
    public $code = 200;
    public $msg = '身份验证失败，请稍后重试！';
    public $errorCode = 10002;
}