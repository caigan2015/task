<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 10:32
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Message as MessageModel;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\service\Identify;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token;
use app\api\service\UserToken;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\MessageGet;
use app\api\validate\PagingParameter;
use app\api\validate\PhoneGet;
use app\api\validate\UserUp;
use app\lib\exception\IdentifyException;
use app\lib\exception\MessageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Message extends BaseController
{
    
    public function getSummary($page = 1,$size = 30)
    {
        (new PagingParameter())->goCheck();
        (new MessageGet())->goCheck([],'get');
        $data = Request::instance()->post();
        $uid = Token::getCurrentUid();
        $user = Identify::checkUser($uid);
        $data['quarter_id'] = Quarter::getTopOne($user->house_id)->id;
        $data['property_id'] = $user->property_id;
        $data['userid'] = $uid;
        $messages = MessageModel::getSummary($data,[],true, $page, $size);
        if($messages->isEmpty()){
            $messages = [
                'current_page' => $messages->currentPage(),
                'total' => $messages->total(),
                'data' => []
            ];
        }else{
            $messages->append(['type_text']);
        }
        
        return new SuccessReturn([
            'info'=>$messages
        ]);
//        return $messages;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $uid = Token::getCurrentUid();
        $id = Request::instance()->param('id');
        $message = MessageModel::getDetail(['id'=>$id,'userid'=>$uid]);
        if(!$message){
            throw new MessageException() ;
        }
        $message->save(['isread'=>1]);
        $message->append(['type_text']);
        return new SuccessReturn([
            'info'=>$message
        ]);
//        return $message;
    }
}