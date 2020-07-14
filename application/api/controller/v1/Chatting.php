<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Chatting as ChattingModel;
use app\api\service\Chatting as ChattingService;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\ChattingNew;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\ChattingException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;

class Chatting extends BaseController
{
    protected $beforeActionList = [
    ];

    /***
     * @return SuccessMessage
     */
    public function sendMessage()
    {
        (new ChattingNew())->goCheck();
        $data = input('post.');
        ChattingService::create($data);
        return new SuccessMessage();
    }

    /**
     * @return SuccessReturn
     * @throws ChattingException
     */
    public function getChattingByOrderId()
    {
        (new IDMustBePositiveInt())->goCheck();
        $user_id = Token::getCurrentUid();
        $order_id = $this->request->param('id');
        OrderService::checkOrderForChattingReturnUserType($order_id,$user_id);
        $messages = ChattingModel::getSummary(['order_id' => $order_id],['user_id','user_type','content','file','create_time']);
        if($messages->isEmpty()){
            throw new ChattingException() ;
        }
        
        return new SuccessReturn([
            'info'=>$messages
        ]);
    }

}






















