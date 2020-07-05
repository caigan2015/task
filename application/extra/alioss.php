<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/24
 * Time: 11:40
 */
use think\Env;
/**
 * ali_oss 配置参数
 * @param string $endpoint 您选定的OSS数据中心访问域名，例如oss-cn-hangzhou.aliyuncs.com
 * @param boolean $isCName 是否对Bucket做了域名绑定，并且Endpoint参数填写的是自己的域名
 */
return [
    'ossServer' =>Env::get('ALIOSS_SERVER', 'jiandongsp.oss-cn-shenzhen.aliyuncs.com'),                   // 外网
    'EndPoint' =>Env::get('ALIOSS_SERVER', 'video.gzjiandongsp.com'),                   // 外网
    'ossServerInternal' =>Env::get('ALIOSS_SERVERINTERNAL', 'jiandongsp.oss-cn-shenzhen-internal.aliyuncs.com'),   // 内网
//    'AccessKeyId' =>Env::get('ALIOSS_KEYID', 'LTAIrrVZUtd7yegX'),  //www.gzjiandongsp.com                // key
    'AccessKeyId' =>Env::get('ALIOSS_KEYID', 'LTAISCVzfX41i8Is'),    //建东阿里云              // key
//    'AccessKeySecret' =>Env::get('ALIOSS_KEYSECRET', 'L6io93337ICwC9pxqJVs1H6CaiwFk5'),   //www.gzjiandongsp.com       // secret
    'AccessKeySecret' =>Env::get('ALIOSS_KEYSECRET', 'aDvmMzbriNCvE95D6EMdthHd1OMYej'),          // secret
//    'BucketName' =>Env::get('ALIOSS_BUCKETNAME', 'jiandong2018'),   //www.gzjiandongsp.com           // bucket 空间名字
    'BucketName' =>Env::get('ALIOSS_BUCKETNAME', 'jiandongsp'),        // bucket 空间名字
    'cityName' =>Env::get('ALIOSS_CITYNAEM', '深圳'),                  //城市名
    'networkType' => Env::get('ALIOSS_NETWORKTYPE', null),            //网络类型

    'allow_file_max_size'=>10000,
    'allow_file_upload_ext'=>['avi', 'flash', 'wma', 'rmvb', 'rm', 'mp4','mid','3GP','mkv'],

    //视频直播
    'appName' => 'jiandong',
    'domain' => 'jiandongsp.gzjiandongsp.com',
    'pushAuth' => 'Min6riYmER',
//    'authTime' => 43200
];