<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/17
 * Time: 10:32
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Notice as NoticeModel;
use app\api\model\User;
use app\api\service\Identify as IdentifyService;
use app\api\service\Notice as NoticeService;
use app\api\service\Token;
use app\api\service\UserToken;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NoticeGet;
use app\api\validate\PagingParameter;
use app\api\validate\PhoneGet;
use app\api\validate\UserUp;
use app\lib\exception\IdentifyException;
use app\lib\exception\NoticeException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Notice extends BaseController
{
    public function getNewSummary()
    {
        (new NoticeGet())->goCheck([],'new');
        $notices = NoticeService::getNew();
        return new SuccessReturn([
            'info'=>$notices
        ]);
//        return $notices;
    }
    public function getAllSummary($page = 1,$size = 30)
    {
        (new PagingParameter())->goCheck();
        (new NoticeGet())->goCheck([],'get');
        $data = NoticeService::getCondition();
        
        $notices = NoticeModel::getSummary($data,['id','title','type','summary','send_time','istop'],0,true, $page, $size);
        if($notices->isEmpty()){
            $notices = [
                'current_page' => $notices->currentPage(),
                'total' => $notices->total(),
                'data' => []
            ];
        }else{
            $notices->append(['type_text']);
        }
        
        return new SuccessReturn([
            'info'=>$notices
        ]);
//        return $notices;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $uid = Token::getCurrentUid();
        $id = Request::instance()->param('id');
        $notice = NoticeModel::getDetail(['id'=>$id]);
        if(!$notice){
            throw new NoticeException() ;
        }
        NoticeService::saveRead($notice->id,$uid);
        $notice->append(['type_text']);
        return new SuccessReturn([
            'info'=>$notice
        ]);
//        return $notice;
    }
}