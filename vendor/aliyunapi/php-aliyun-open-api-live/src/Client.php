<?php

/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace aliyun\live;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as HttpClient;
use aliyun\guzzle\subscriber\Rpc;

/**
 * Class Client
 * @package aliyun\live
 */
class Client
{
    /**
     * @var string
     */
    public $accessKeyId;

    /**
     * @var string
     */
    public $accessSecret;

    /**
     * @var string API版本
     */
    public $version = '2016-11-01';

    /**
     * @var string 网关地址
     */
    public $baseUri = 'https://live.aliyuncs.com/';

    /**
     * @var string 应用名称
     */
    public $appName;

    /**
     * @var string 应用域名
     */
    public $domain;

    /**
     * @var string 推流鉴权
     */
    public $pushAuth;

    /**
     * @var string 媒体中心地址
     */
    public $pushDomain = 'video-center.alivecdn.com';

    /**
     * @var bool 是否使用安全连接
     */
    public $secureConnection = false;

    /**
     * @var int 签名有效期,默认有效期是一周
     */
    public $authTime = 604800;

    /**
     * @var string
     */
    public $recordDomain;

    /**
     * @var int 秘钥过期时间
     */
    private $expirationTime;

    /**
     * @var string 播放协议
     */
    private $playScheme;

    /**
     * @var string 播放地址
     */
    private $httpPlayUrl;

    /**
     * @var HttpClient
     */
    private $_httpClient;

    /**
     * @var string 签名方式
     */
    private $signatureMethod='HMAC-SHA1';

    /**
     * @var string 签名算法版本
     */
    private $signatureVersion='1.0';

    /**
     * @var string 本次 API 请求访问到的资源拥有者账户
     */
    private $resourceOwnerAccount='';
    /**
     * @var string 本次 API 请求访问到的资源拥有者账户
     */
    private $format='json';

    private $message = '';

    private $domainParameters = [];
    /**
     * Client constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct($config = [])
    {
        foreach ($config as $name => $value) {
            $this->{$name} = $value;
        }
        $authTime = (int)trim(strip_tags(html_entity_decode(config('setting.auth_time'))));
        if($authTime){
            $this->authTime = $authTime;
        }
        $this->expirationTime = time() + $this->authTime;
        $this->playScheme = $this->secureConnection ? 'https://' : 'http://';
        $this->httpPlayUrl = $this->playScheme . $this->domain;

        if (empty ($this->accessKeyId)) {
            throw new \Exception ('The "accessKeyId" property must be set.');
        }
        if (empty ($this->accessSecret)) {
            throw new \Exception ('The "accessSecret" property must be set.');
        }
        if (empty ($this->appName)) {
            throw new \Exception ('The "appName" property must be set.');
        }

        if (empty ($this->domain)) {
            throw new \Exception ('The "domain" property must be set.');
        }

        if (empty ($this->recordDomain)) {
            throw new \Exception ('The "recordDomain" property must be set.');
        }
    }

    /**
     * 获取Http Client
     * @return HttpClient
     */
    public function getHttpClient()
    {
        if (!is_object($this->_httpClient)) {
            $stack = HandlerStack::create();
            $middleware = new Rpc([
                'accessKeyId' => $this->accessKeyId,
                'accessSecret' => $this->accessSecret,
                'Version' => $this->version
            ]);
            $stack->push($middleware);

            $this->_httpClient = new HttpClient([
                'base_uri' => $this->baseUri,
                'handler' => $stack,
                'verify' => false,
                'http_errors' => false,
                'connect_timeout' => 3,
                'read_timeout' => 10,
                'debug' => false,
            ]);
        }
        return $this->_httpClient;
    }

    /**
     * 发起Api请求
     * @param array $params
     */
    public function createRequest(array $params)
    {
        return $this->getHttpClient()->get('/', ['query' => $params]);
    }

    /**
     * 禁止推流
     * @param string $streamName
     * @return string
     */
    public function forbidLiveStream($streamName)
    {
        return $this->createRequest([
            'Action' => 'ForbidLiveStream',
            'DomainName' => $this->domain,
            'AppName' => $this->appName,
            'StreamName' => $streamName,
            'LiveStreamType' => 'publisher',
            'ResumeTime' => gmdate('Y-m-d\TH:i:s\Z', mktime(0, 0, 0, 1, 1, 2099))
        ]);
    }

    /**
     * 允许推流
     * @param string $streamName
     * @return string
     */
    public function startLiveStream($streamName)
    {
        return $this->createRequest([
            'Action' => 'ResumeLiveStream',
            'DomainName' => $this->domain,
            'AppName' => $this->appName,
            'StreamName' => $streamName,
            'LiveStreamType' => 'publisher'
        ]);
    }

    /**
     * 实时查询在线人数的请求参数
     * @param null|string $streamName
     * @param null|int $startTime
     * @param null|int $endTime
     * @return string
     */
    public function describeLiveStreamOnlineUserNum($streamName = null, $startTime = null, $endTime = null)
    {
        $params = [
            'Action' => 'DescribeLiveStreamOnlineUserNum',
            'DomainName' => $this->domain,
            'AppName' => $this->appName
        ];
        if (!empty($streamName)) {
            $params['StreamName'] = $streamName;
        }
        if (!empty($startTime) && !empty($endTime)) {
            $params['StartTime'] = gmdate('Y-m-d\TH:i:s\Z', $startTime);
            $params['EndTime'] = gmdate('Y-m-d\TH:i:s\Z', $endTime);
        }

        return $this->aliApi($params,$credential="GET", $domain="live.aliyuncs.com");
//        return $this->createRequest($params);
    }

    /**
     * 查询在线的直播推流列表
     * @return string
     */
    public function describeLiveStreamsOnlineList()
    {
        return $this->createRequest([
            'Action' => 'DescribeLiveStreamsOnlineList',
            'DomainName' => $this->domain,
            'AppName' => $this->appName
        ]);
    }

    /**
     * 直播签名
     * @param string $streamName
     * @return string
     */
    public function getSign($streamName)
    {
        $uri = "/{$this->appName}/{$streamName}";
        if ($this->pushAuth) {
            $authKey = "?vhost={$this->domain}&auth_key={$this->expirationTime}-0-0-" . md5("{$uri}-{$this->expirationTime}-0-0-{$this->pushAuth}");
        } else {
            $authKey = "?vhost={$this->domain}";
        }
        return $authKey;
    }

    /**
     * 获取推流地址
     * @return string
     */
    public function getPushPath()
    {
        return "rtmp://{$this->pushDomain}/{$this->appName}/";
    }

    /**
     * 获取串码流
     * @param string $streamName 流名称
     * @return string
     */
    public function getPushArg($streamName)
    {
        return $streamName . $this->getSign($streamName);
    }

    /**
     * 获取直播推流地址
     * @param string $streamName
     * @return string
     */
    public function getPushUrl($streamName)
    {
        $uri = "/{$this->appName}/{$streamName}";
        return "rtmp://{$this->pushDomain}" . $uri . $this->getSign($streamName);
    }

    /**
     * 验证签名
     * @param string $streamName
     * @param string $usrargs
     * @return bool
     */
    public function checkSign($streamName, $usrargs)
    {
        parse_str($usrargs, $args);
        if (isset($args['vhost']) && isset($args['auth_key'])) {
            if ($args['vhost'] != $this->domain) {
                return false;
            }
            $params = explode('-', $args['auth_key'], 4);
            if (isset($params[0]) && $params[3]) {
                $uri = "/{$this->appName}/{$streamName}";
                if ($params[3] == md5("{$uri}-{$params[0]}-0-0-{$this->pushAuth}")) {
                    return true;
                }

            }
        }
        return false;
    }

    /**
     * 获取签名
     * @param string $uri
     * @return string
     */
    protected function getAuthKey($uri)
    {
        $authKey = '';
        if ($this->pushAuth) {
            $authKey = "?auth_key={$this->expirationTime}-0-0-" . md5("{$uri}-{$this->expirationTime}-0-0-{$this->pushAuth}");
        }
        return $authKey;
    }

    /**
     * 获取RTMP拉流地址
     * @param string $streamName
     * @return string
     */
    public function getPlayUrlForRTMP($streamName)
    {
        $uri = "/{$this->appName}/{$streamName}";
        return 'rtmp://' . $this->domain . $uri . $this->getAuthKey($uri);
    }

    /**
     * 获取FLV播放地址
     * @param string $streamName
     * @return string
     */
    public function getPlayUrlForFLV($streamName)
    {
        $uri = "/{$this->appName}/{$streamName}.flv";
        return $this->httpPlayUrl . $uri . $this->getAuthKey($uri);
    }

    /**
     * 获取M3U8播放地址
     * @param string $streamName
     * @return string
     */
    public function getPlayUrlForM3U8($streamName)
    {
        $uri = "/{$this->appName}/{$streamName}.m3u8";
        return $this->httpPlayUrl . $uri . $this->getAuthKey($uri);
    }

    /**
     * 获取阿里云播放地址
     * @param string $streamName
     * @return array
     */
    public function getPlayUrls($streamName)
    {
        return [
            'rtmp' => $this->getPlayUrlForRTMP($streamName),
            'flv' => $this->getPlayUrlForFLV($streamName),
            'm3u8' => $this->getPlayUrlForM3U8($streamName)
        ];
    }

    /**
     * 设置签名过期时间
     * @param int $expirationTime
     * @return $this
     */
    public function setExpirationTime($expirationTime)
    {
        $this->expirationTime = $expirationTime;
        return $this;
    }

    /**
     * 获取签名过期时间
     * @return int
     */
    public function getExpirationTime()
    {
        return $this->expirationTime;
    }

    /**
     * 获取录像播放地址
     * @param string $uri
     * @return string
     */
    public function getRecordUrl($uri)
    {
        return '//' . $this->recordDomain . '/' . $uri;
    }

    /**
     * @return string
     */
    public function getPlayScheme()
    {
        return $this->playScheme;
    }

    /**
     * @return string
     */
    public function getHttpPlayUrl()
    {
        return $this->httpPlayUrl;
    }

    public function signatureNonce($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public function signature($credential,array $params)
    {
        //参数排序
        ksort($params);
        $query = http_build_query($params, null, '&', PHP_QUERY_RFC3986);
        $source = $credential . '&%2F&' . $this->percentEncode($query);
        return base64_encode(hash_hmac('sha1', $source, $this->accessSecret . '&', true));
    }
    protected function percentEncode($str)
    {
        $res = urlencode($str);
        $res = preg_replace('/\+/', '%20', $res);
        $res = preg_replace('/\*/', '%2A', $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }

    public function aliApi($apiParams,$credential="GET", $domain="live.aliyuncs.com")
    {
        $apiParams['Format'] = $this->format;
        $apiParams['SignatureMethod'] = $this->signatureMethod;//签名算法
        $apiParams['SignatureNonce'] = $this->signatureNonce();//随机数
        $apiParams['SignatureVersion'] = $this->signatureVersion;//签名算法版本
        $apiParams['Timestamp'] =gmdate('Y-m-d\TH:i:s\Z');//请求时间
        $apiParams['Version'] = $this->version;
        $apiParams["AccessKeyId"]=$this->accessKeyId;
        $apiParams["Signature"] = $this->signature($credential,$apiParams);
        if($credential == "POST") {
            $requestUrl = "https://". $domain . "/";
            foreach ($apiParams as $apiParamKey => $apiParamValue)
            {
                $this->domainParameters[$apiParamKey] = $apiParamValue;
            }
            $url= $requestUrl;
        }
        else {
            $requestUrl = "http://". $domain . "/?";
            $url = $requestUrl.\GuzzleHttp\Psr7\build_query($apiParams);;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); //处理http证书问题
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $ret = curl_exec($ch);
        if (false === $ret) {
            $ret =  curl_errno($ch);
            $this->message = 'curl方法出错，错误号：'.$ret;
            return false;
        }
        curl_close($ch);
        if( $this->format == "json")
            return json_decode($ret,true);
        elseif($this->format =="xml"){
            return $this->xmlToArray($ret);
        }else
            return $ret;
    }
    /**
     * xml转成数组
     * @param $xml
     * @return mixed
     */
    function xmlToArray($xml){

        //禁止引用外部xml实体

        libxml_disable_entity_loader(true);

        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $val = json_decode(json_encode($xmlstring),true);

        return $val;

    }
}