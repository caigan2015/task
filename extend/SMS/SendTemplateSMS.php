<?php

namespace SMS;

use app\lib\exception\SmsException;

class SendTemplateSMS
{
  //主帐号
  private $accountSid='8a216da86178687d0161794ab7220065';

  //主帐号Token
  private $accountToken='e31b6529a7834972928a8fb4ea79e92a';

  //应用Id
  private $appId='8a216da86178687d016179c7936600fa';

  //请求地址，格式如下，不需要写https://
  private $serverIP='app.cloopen.com';

  //请求端口
  private $serverPort='8883';

  //REST版本号
  private $softVersion='2013-12-26';

  /**
    * 发送模板短信
    * @param to 手机号码集合,用英文逗号分开
    * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
    * @param $tempId 模板Id
    */
  public function sendTemplateSMS($to,$datas,$tempId)
  {
       // 初始化REST SDK
       $rest = new CCPRestSDK($this->serverIP,$this->serverPort,$this->softVersion);
       $rest->setAccount($this->accountSid,$this->accountToken);
       $rest->setAppId($this->appId);

       // 发送模板短信
      //  echo "Sending TemplateSMS to $to <br/>";
       $result = $rest->sendTemplateSMS($to,$datas,$tempId);
       if($result == NULL ) {
           throw new SmsException([
               'msg'=>'result error!',
               'errorCode'=>00000,
           ]);
       }
       if($result->statusCode != 0) {
           throw new SmsException([
               'msg' => $result->statusMsg,
               'errorCode' => $result->statusCode
           ]);
       }
           
       return true;
       

  }
}

//sendTemplateSMS("18576437523", array(1234, 5), 1);
