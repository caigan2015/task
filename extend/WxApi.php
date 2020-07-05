<?php
class WxApi {
	private $appid;
	private $appsecret;
	private $access_token;
	private $jsapi_ticket;
	private $cardapi_ticket;
	private $expires_time;
	private $jsapi_expire;
	private $cardapi_expire;

	//初始化
	public function __construct($appId, $appSecret) {
		$this->appid = $appId;
		$this->appsecret = $appSecret;
	}

	//获取微信授权链接
	public function get_authorize_url($redirect_uri = '',$scope = 'snsapi_base',$state = '')
	{
		$redirect_uri = urlencode($redirect_uri);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
		
	}
	
	//获取微信用户openid
	public function getOpenId($code)
	{
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->appsecret."&code={$code}&grant_type=authorization_code";
		$output = $this->http_request($url);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	
	}
	
	//获取微信用户基本信息
	public function getWechatInfo($access_token,$openid){
		$info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
		$output = $this->http_request($info_url);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	//获取微信用户基本信息(跟上面的token 不一样)
	public function getFocusUserInfo($openid){
		$access_token = $this->getAccessToken();
		//https://api.weixin.qq.com/cgi-bin/user/info?access_token=LmRvmQCaUZAWs64_yGVlvToPlqoITZySTUxGPh_9PX0tir5O2kqR8wi711UXyZzZOv0xG282MNYZcGQ8OFrd4Ti-9NQgWmJqGSzngWYODlt5A2rKiiUjhP-zCtQEvychUQUhADADZD&openid=ob_JOwa7wJJ-CNylZGS9W11G2FwE 
		$info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}";
		$output = $this->http_request($info_url);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	private function getAccessToken() {
		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		$data = json_decode(file_get_contents("./mp_cache/access_token.json"),true);
		if (!$data || $data['expires_time'] < time()) {
			// 如果是企业号用以下URL获取access_token
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
			$res_json = $this->http_request($url);
			$res = json_decode($res_json,true);//必须设置白名单
			if(empty($res_json)){
				throw new Exception('通过code换取网页授权access_token时异常，微信内部错误');
			}
			if(array_key_exists('errcode', $res) && $res['errcode'] !=0){
				throw new Exception($res_json);
			}
			$this->access_token = $res['access_token'];
			if ($this->access_token) {
				$this->expires_time = time() + 7200;
				file_put_contents('./mp_cache/access_token.json', '{"access_token": "'.$this->access_token.'", "expires_time": '.$this->expires_time.'}');//添加目录，不能自动创建目录
			}
		} else {
			//未过期
			$this->access_token = $data['access_token'];
		}
		return $this->access_token;
	}


	//获得JS API的ticket
	public function getJsApiTicket()
	{
		$data = json_decode(file_get_contents("./mp_cache/jsapi_ticket.json"),true);
		if (!$data || $data['jsapi_expire'] < time()) {
			$access_token = $this->getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$access_token;
			$res_json = $this->http_request($url);
			$res = json_decode($res_json, true);
			if(empty($res_json)){
				throw new Exception('通过code换取网页授权access_token时异常，微信内部错误');
			}
			if(array_key_exists('errcode', $res) && $res['errcode'] !=0){
				throw new Exception($res_json);
			}
			$this->jsapi_ticket = $res["ticket"];
			if($this->jsapi_ticket){
				$this->jsapi_expire = time() + 7200;
				file_put_contents('./mp_cache/jsapi_ticket.json', '{"jsapi_ticket": "'.$this->jsapi_ticket.'", "jsapi_expire": '.$this->jsapi_expire.'}');
			}
		}else{
			$this->jsapi_ticket = $data['jsapi_ticket'];
		}
			return $this->jsapi_ticket;
		
	}

	//获得JS API的ticket
	public function getCardApiTicket()
	{
		$data = json_decode(file_get_contents("./mp_cache/cardapi_ticket.json"),true);
		if (!$data || $data['cardapi_expire'] < time()) {
			$access_token = $this->getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_cardapi_ticket?access_token=$accessToken";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=wx_card";
			$res = $this->http_request($url);
			$result = json_decode($res, true);
			$this->cardapi_ticket = $result["ticket"];
			if($this->cardapi_ticket){
				$this->cardapi_expire = time() + 7200;
				file_put_contents('./mp_cache/cardapi_ticket.json', '{"cardapi_ticket": "'.$this->cardapi_ticket.'", "cardapi_expire": '.$this->cardapi_expire.'}');
			}
		}else{
			$this->cardapi_ticket = $data['cardapi_ticket'];
		}
		return $this->cardapi_ticket;

	}
	
	//HTTP请求（支持HTTP/HTTPS，支持GET/POST）
	protected function http_request($url, $data = null)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		if (!empty($data)){
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		return $output;
	}

	/**
	 * @biref 发送数据post
	 * @param $url 
	 * @param $post_date 
	 */
	public function httpPost($url, $post_data){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/html;charset=utf-8'));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true); // enable posting
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); // post
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
		curl_setopt($curl, CURLOPT_URL, $url);

		$res = curl_exec($curl);
		curl_close($curl);

		return $res;
	}

	public function getSignPackage($url='') {
		$jsapiTicket = $this->getJsApiTicket();
		if(!$url){
			// 注意 URL 一定要动态获取，不能 hardcode.
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
		
		$timestamp = time();
		$nonceStr = $this->createNonceStr();

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

		$signature = sha1($string);

		$signPackage = array(
			"appId"     => $this->appid,
			"nonceStr"  => $nonceStr,
			"timestamp" => $timestamp,
			"url"       => $url,
			"signature" => $signature,
			"rawString" => $string,
			"access_token" => $this->access_token,
		);
		return $signPackage;
	}

	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}
	/**
	 * 支付签名
	 */
	public function wxPayData($appid,$mch_id,$key,$body, $out_trade_no,$total_fee, $openid) {
		
		$nonce_str = $this->createNonceStr();
		$spbill_create_ip = $_SERVER["REMOTE_ADDR"];
//    	$notify_url = 'http://' . $_SERVER['HTTP_HOST'] . '/bk/service/pay/wx_notify';
		$notify_url = 'http://' . $_SERVER['HTTP_HOST'] .'/index.php/Api/Index/wxNotify';
		$time_start = date("YmdHis");
		$time_expire = date("YmdHis", time() + 5*60*1000);;
		$trade_type = "JSAPI";

		// 生成预处理签名(第二次签名)
		$stringA = "appid={$appid}&body={$body}&mch_id={$mch_id}&nonce_str={$nonce_str}&notify_url={$notify_url}&openid={$openid}&out_trade_no={$out_trade_no}&spbill_create_ip={$spbill_create_ip}&time_expire={$time_expire}&time_start={$time_start}&total_fee={$total_fee}&trade_type={$trade_type}";
		$stringSignTemp = $stringA . '&key=' . $key;
		$sign = strtoupper(md5($stringSignTemp));
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$xmlTpl = "<xml>
              	<appid><![CDATA[%s]]></appid>
              	<body><![CDATA[%s]]></body>
              	<mch_id><![CDATA[%s]]></mch_id>
              	<nonce_str><![CDATA[%s]]></nonce_str>
              	<notify_url><![CDATA[%s]]></notify_url>
              	<out_trade_no><![CDATA[%s]]></out_trade_no>
              	<spbill_create_ip><![CDATA[%s]]></spbill_create_ip>
                <time_start><![CDATA[%s]]></time_start>
                <time_expire><![CDATA[%s]]></time_expire>
              	<total_fee><![CDATA[%s]]></total_fee>
              	<trade_type><![CDATA[%s]]></trade_type>
              	<sign><![CDATA[%s]]></sign>
                <openid><![CDATA[%s]]></openid>
              </xml>";

		$post_data = sprintf($xmlTpl, $appid, $body, $mch_id, $nonce_str, $notify_url, $out_trade_no,$spbill_create_ip, $time_start, $time_expire, $total_fee, $trade_type, $sign, $openid);
//return $post_data;
		$return_data = $this->httpPost($url,$post_data);
		libxml_disable_entity_loader(true);
		$data = simplexml_load_string($return_data, 'SimpleXMLElement', LIBXML_NOCDATA);

//		\Think\Log::info('查看错误信息: ' . $data->return_msg);
		// 重新签名
		$timeStamp = time();
		$nonceStr = $this->createNonceStr();
		$package = 'prepay_id=' . $data->prepay_id;
		$signType = 'MD5';

		$stringB = "appId={$appid}&nonceStr={$nonceStr}&package={$package}&signType={$signType}&timeStamp={$timeStamp}";
		$stringSignTemp = $stringB . '&key=' . $key;
		$sign = strtoupper(md5($stringSignTemp));

		$payConfigPackage = array(
			"timestamp" => (string)$timeStamp,
			"nonceStr"  => $nonceStr,
			"package"   => $package,
			"signType"  => $signType,
			"paySign"   => $sign,
		);
//		\Think\Log::info(json_encode($payConfigPackage));

		return $payConfigPackage;
	}
	
	/**
	 * 添加卡券
	 */
	public function wxCardPackage($cardId , $openid = '') {

		$timestamp = time();
		$api_ticket = $this->getCardApiTicket();
        $nonce_str = $this->createNonceStr();
		$arrays = array($api_ticket,$timestamp,$nonce_str,$cardId,$openid);
		sort($arrays,SORT_STRING);
		$string = sha1(implode("",$arrays));

		$resultArray['card_id'] = $cardId;
		$resultArray['card_ext'] = array();
		$resultArray['card_ext']['openid'] = $openid;
        $resultArray['card_ext']['nonce_str'] = $nonce_str;
		$resultArray['card_ext']['timestamp'] = $timestamp;
		$resultArray['card_ext']['signature'] = $string;

		return $resultArray;
	}

	/**
	 * 选择卡券
	 */
	public function wxChooseCardPackage($cardId='',$shopId='',$cardType='') {

		$timestamp = time();
		$api_ticket = $this->getCardApiTicket();
		$nonce_str = $this->createNonceStr();
		$arrays = array($api_ticket,$timestamp,$nonce_str,$cardId);
		sort($arrays,SORT_STRING);
		$string = sha1(implode("",$arrays));

		$resultArray['card_id'] = $cardId;
		$resultArray['cardSign'] = $string;
		$resultArray['timestamp']= $timestamp;
		$resultArray['signType']= 'SHA1';
		$resultArray['shopId']= $shopId;
		$resultArray['cardType']= $cardType;

		return $resultArray;
	}

	
	/**
	 * 关注用户
	 */
	public function getFocusUserList($next_openid='')
	{
		$access_token = $this->getAccessToken();
		//https://api.weixin.qq.com/cgi-bin/user/get?access_token=ySxY9_7deWlitLdxRZuRR5A7Wwv088VCmb3dP-Q_G1ijL2XyTUe1sKH5TRZBikPG8zZQWpic9ZhLm0oAQypBWAzheNQPXGF49qwKgl9kdF0HojjnQl6s0JN7DQWyRSziYWGeAEAPNX&next_openid=
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid={$next_openid}";
		$output = $this->http_request($url);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;		
	}

	/**
	 * 图文信息素材
	 */
	public function getMaterial($type='news',$offset=0,$count=20)
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token={$access_token}";
		$data = [
			"type"=>$type,
			"offset"=>$offset,
			"count"=>$count
			];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function getCardList($status='',$offset=0,$count=50)
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/card/batchget?access_token={$access_token}";
		$data = [
			"status_list"=>$status,
			"offset"=>$offset,
			"count"=>$count
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function getCardInfo($cardId)
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/card/get?access_token={$access_token}";
		$data = [
			"card_id"=>$cardId,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function getUserCardList($open_id,$card_id='')
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/card/user/getcardlist?access_token={$access_token}";
		$data = [
			"openid"=>$open_id,
			"card_id"=>$card_id,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function getUserCardStatus($card_id,$code,$check=false)
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/card/code/get?access_token={$access_token}";
		$data = [
			"card_id"=>$card_id,
			"code"=>$code,
			"check_consume"=>$check,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function consumeCardCard($code,$card_id)
	{
		$access_token = $this->getAccessToken();
		$url = "https://api.weixin.qq.com/card/code/consume?access_token={$access_token}";
		$data = [
			"code"=>$code,
			"card_id"=>$card_id,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function reFund($appid,$mch_id,$key,$out_refund_no,$out_trade_no,$refund_fee,$total_fee,$transaction_id)
	{
		$nonce_str = $this->createNonceStr();
		$stringA = "appid={$appid}&mch_id={$mch_id}&nonce_str={$nonce_str}&out_refund_no={$out_refund_no}&out_trade_no={$out_trade_no}&refund_fee={$refund_fee}&total_fee={$total_fee}&transaction_id={$transaction_id}";//sign加密MD5
		
		$stringSignTemp = $stringA . '&key=' . $key;
		$sign= strtoupper(md5($stringSignTemp));
		$url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
		$xmlTpl = "<xml>
              	<appid><![CDATA[%s]]></appid>
              	<mch_id><![CDATA[%s]]></mch_id>
              	<nonce_str><![CDATA[%s]]></nonce_str>
              	<out_refund_no><![CDATA[%s]]></out_refund_no>
              	<out_trade_no><![CDATA[%s]]></out_trade_no>
                <refund_fee><![CDATA[%s]]></refund_fee>
                <total_fee><![CDATA[%s]]></total_fee>
              	<transaction_id><![CDATA[%s]]></transaction_id>
              	<sign><![CDATA[%s]]></sign>
              </xml>";

		$post_data = sprintf($xmlTpl, $appid, $mch_id, $nonce_str, $out_refund_no,$out_trade_no, $refund_fee, $total_fee, $transaction_id, $sign);

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/html;charset=utf-8'));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);//证书检查
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'pem');
		curl_setopt($ch,CURLOPT_SSLCERT,'./cert/apiclient_cert.pem');
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'pem');
		curl_setopt($ch,CURLOPT_SSLKEY,'./cert/apiclient_key.pem');
		curl_setopt($ch,CURLOPT_SSLCERTTYPE,'pem');
		curl_setopt($ch,CURLOPT_CAINFO,'./cert/rootca.pem');
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
		curl_setopt($ch,CURLOPT_URL,$url);
		
		$return_data=curl_exec($ch);
		curl_close($ch);
//		libxml_disable_entity_loader(true);
//		$data = simplexml_load_string($return_data, 'SimpleXMLElement', LIBXML_NOCDATA);
		$data = xmlToArray($return_data);
		return $data;
	}


	/**
	 * 用户数据分析
	 */
	public function getUserSummary($begin_date,$end_date)
	{
		$access_token = $this->getAccessToken();
		//https://api.weixin.qq.com/cgi-bin/user/get?access_token=ySxY9_7deWlitLdxRZuRR5A7Wwv088VCmb3dP-Q_G1ijL2XyTUe1sKH5TRZBikPG8zZQWpic9ZhLm0oAQypBWAzheNQPXGF49qwKgl9kdF0HojjnQl6s0JN7DQWyRSziYWGeAEAPNX&next_openid=
		$url = "https://api.weixin.qq.com/datacube/getusersummary?access_token={$access_token}";
		$data = [
			"begin_date"=>$begin_date,
			"end_date"=>$end_date,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	/**
	 * 用户总量
	 */
	public function getUserCumulate($begin_date,$end_date)
	{
		$access_token = $this->getAccessToken();
		//https://api.weixin.qq.com/cgi-bin/user/get?access_token=ySxY9_7deWlitLdxRZuRR5A7Wwv088VCmb3dP-Q_G1ijL2XyTUe1sKH5TRZBikPG8zZQWpic9ZhLm0oAQypBWAzheNQPXGF49qwKgl9kdF0HojjnQl6s0JN7DQWyRSziYWGeAEAPNX&next_openid=
		$url = "https://api.weixin.qq.com/datacube/getusercumulate?access_token={$access_token}";
		$data = [
			"begin_date"=>$begin_date,
			"end_date"=>$end_date,
		];
		$json = json_encode($data);
		$output = $this->http_request($url,$json);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo;
	}

	public function getMedia($filename='',$wx_serverId)
	{
		$access_token = $this->getAccessToken();
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$wx_serverId}";
		if($filename){
			$ch = curl_init($url); // 初始化
			$fp = fopen($filename, 'wb'); // 打开写入
			curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$result=curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		}else{
			$result = $this->http_request($url);
		}
		return $result;
	}
}