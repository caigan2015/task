<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 10:32
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Advice as AdviceModel;
use app\api\model\User;
use app\api\service\Advice as AdviceService;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token;
use app\api\service\UserToken;
use app\api\validate\AdviceNew;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\PhoneGet;
use app\api\validate\UserUp;
use app\lib\exception\AdviceException;
use app\lib\exception\IdentifyException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Advice extends BaseController
{

    /**
     * 更新或者创建用户收获地址
     */
    public function createAdvice()
    {
        (new AdviceNew())->goCheck([],'create');

        $uid = Token::getCurrentUid();
        $user = IdentifyService::checkAuditUser($uid);
        AdviceService::create($user);

        return new SuccessMessage();
    }

    public function getAdvices($page = 1,$size = 30)
    {
        (new AdviceNew())->goCheck([],'read');
        (new PagingParameter())->goCheck();
        $uid = Token::getCurrentUid();
        $data = Request::instance()->post();
        $data['userid'] = $uid;
        $advices = AdviceModel::getSummary($data,['id','content','type','disaster_type','create_time'],true, $page, $size);
        if($advices->isEmpty()){
            $advices = [
                'current_page' => $advices->currentPage(),
                'total' => $advices->total(),
                'data' => []
            ];
        }else{
            $advices->append(['type_text','disaster_type_text']);
        }

        return new SuccessReturn([
            'info'=>$advices
        ]);
//        return $advices;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = Token::getCurrentUid();
        $advice = AdviceModel::getDetail(['id'=>$id,'userid'=>$uid]);
        if(!$advice){
            throw new AdviceException() ;
        }
        $advice->append(['type_text','disaster_type_text']);

        return new SuccessReturn([
            'info'=>$advice
        ]);
//        return $advice;
    }
}