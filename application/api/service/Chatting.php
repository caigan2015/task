<?php
namespace app\api\service;

use app\api\service\Order as OrderService;
use app\api\model\Chatting as ChattingModel;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use think\Exception;

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
        $result = ChattingModel::create($data);
        if(!$result){
            throw new Exception('创建聊天记录失败');
        }

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
                'msg' => '保存文件失败',
                'error_code'=> 40001 ,
                'code' =>  403
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg,'.');
    }

}