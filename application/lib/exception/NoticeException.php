<?php
/**
 * Created by 七月
 * Author: 七月
 * Date: 2017/2/18
 * Time: 13:47
 */

namespace app\lib\exception;


class NoticeException extends BaseException
{
    public $code = 200;
    public $msg = '物业公告不存在或已被禁用';
    public $errorCode = 30004;
}