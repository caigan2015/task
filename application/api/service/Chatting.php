<?php
namespace app\api\service;

use app\api\service\Order as OrderService;
use app\api\model\Chatting as ChattingModel;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;

class Chatting
{

    public static function create($data)
    {
        $user_id = Token::getCurrentUid();
        $user_type = OrderService::checkOrderForChattingReturnUserType($data['order_id'], $user_id);
        $data['user_id'] = $user_id;
        $data['user_type'] = $user_type;
        $data['content'] = htmlentities($data['content']);
//        !empty($data['file'])?($data['file'] = self::saveFile($data['file'])):'';
        ChattingModel::create($data);
        return new SuccessMessage();
    }

    /**
     * @param $head_img
     * @return string
     */
    public static function saveFile($head_img)
    {
        if(file_exists('.'.$head_img)){
            return $head_img;
        }
        //TODO
        $fileDir = "./tmp/uploads/chatting/".date('YmdHis');
        if(!file_exists($fileDir)){
            mkdir($fileDir,0777,true);
        }
        $fileImg = $fileDir . '/' . md5(microtime(true)).'.';
        //保存图片
        if(!file_put_contents($fileImg, base64_decode($head_img))){
            throw new ImageException([
                'msg' => '画像を保存できませんでした',
                'error_code'=> 40001 ,
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg,'.');
    }

}