<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 11:46
 */
use OSS\OssClient;
use OSS\Core\OssException;

class Alioss
{
    private static $accessKeyId ;
    private static $accessKeySecret ;
    private static $endpoint ;
    private static $bucket ;
    private static $_instance;

    public function __construct()
    {
        self::$accessKeyId = config('alioss.AccessKeyId');
        self::$accessKeySecret = config('alioss.AccessKeySecret');
        self::$endpoint = config('alioss.EndPoint');
        self::$bucket = config('alioss.BucketName');
    }


    /**
     * 获取一个OssClient实例
     * @return null|OssClient
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof OssClient)) {
            try {
                self::$_instance = new OssClient(self::$accessKeyId, self::$accessKeySecret, self::$endpoint, true);
            } catch (OssException $e) {
//                printf(__FUNCTION__ . "creating OssClient instance: FAILED\n");
//                printf($e->getMessage() . "\n");
                return $e->getMessage();
            }
        }
        return self::$_instance;
    }

    /**
     * 获取bucket
     * @return string
     */
    public static function getBucketName()
    {
        return self::$bucket;
    }

}