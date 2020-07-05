<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Message as MessageModel;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\MessageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Log;
use think\Request;

class Message
{
    public static function checkMessage($data)
    {
        $message = MessageModel::getOneByData($data);
        if(!$message){
            throw new MessageException() ;
        }
        return $message;
    }


    public static function saveMessage($type,$property_id,$house_id,$userid,$content,$msg_id){

        $data['type'] = $type;
        $data['property_id'] = $property_id;
        $data['quarter_id'] = Quarter::getTopOne($house_id)->id;
        $data['userid'] = $userid;
        $data['content'] = $content;
        switch ($type){
            case 1:
                $data['order_id'] = $msg_id;
                break;
            case 2:
                $data['push_id'] = $msg_id;
                break;
            case 3:
                $data['notice_id'] = $msg_id;
                break;
            case 4:
                $data['pastport_id'] = $msg_id;
                break;
            case 5:
                $data['pay_id'] = $msg_id;
                break;
            default:
        }
        $msgM = new Message();
        $msg = $msgM->where($data)->find();
        if(!$msg){
            $msgM->create($data);
        }else{
            $msg->save($data);
        }
    }


    public static function sendMsg($users,$content,$order_id,$type){

        if($users) {
            foreach ($users as $user) {
                //发短信
                if (!empty($user->mobile) && preg_match('/^(0|86|17951)?(13[0-9]|15[0-9]|17[0-9]|18[0-9]|14[57]|16[0-9])[0-9]{8}$/', $user->mobile)) {
                    $content .= "详情请登录APP" . config('app.app_name') . '查看。谢谢！';
                    $sms_url = sprintf(config('app.sms_url'), $user->mobile, $content);
                    $result = curl_post($sms_url);
                    if ($result !== '0') {
                        Log::write('给用户' . $user->mobile . '发送支付超时通知失败：' . json_encode($result));
                    }
                }
                //添加消息
                self::saveMessage($type, $user->property_id, $user->house_id, $user->id, $content, $order_id);
            }
        }
    }
}