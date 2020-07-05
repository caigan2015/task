<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 11:46
 */
use aliyun\live\Client;
use think\Exception;

class Alilive
{
    private static $accessKeyId ;
    private static $accessKeySecret ;
    private static $domain ;
    private static $appName ;
    private static $pushAuth ;
    private static $_instance;

    public function __construct()
    {
        self::$accessKeyId = config('alioss.AccessKeyId');
        self::$accessKeySecret = config('alioss.AccessKeySecret');
        self::$domain = config('alioss.domain');
        self::$appName = config('alioss.appName');
        self::$pushAuth = config('alioss.pushAuth');
    }


    /**
     * @return Client|string
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof Client)) {
            try {
                self::$_instance = new Client(['accessKeyId' => self::$accessKeyId, 'accessSecret' =>  self::$accessKeySecret, 'appName' => self::$appName,'domain' => self::$domain,'pushAuth' => self::$pushAuth,'recordDomain'=>self::$domain]);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        return self::$_instance;
    }

    /**
     * 获取appName
     * @return string
     */
    public static function getappName()
    {
        return self::$appName;
    }

}