<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 2:56
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\FeeCount as FeeCountModel;
use app\api\model\Fee as FeeModel;
use app\api\model\Quarter;
use app\api\service\Fee as FeeService;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token as TokenService;
use app\api\validate\FeeNew;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\lib\exception\FeeException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Fee extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createFeeCount']
    ];

    public function getFees()
    {
        (new FeeNew())->goCheck([],'fee');
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $data = Request::instance()->post();
        $data['property_id'] = $user->property_id;
        $data['quarter_id'] = Quarter::getTopOne($user->house_id)->id;
        $fees = FeeModel::getAllByData($data);
        if($fees->isEmpty()){
            throw new FeeException([
                'msg'=>'费用名目不存在',
                'error_code'=>30010,
            ]);
        }
        $fees->append(['type_text']);

        return new SuccessReturn([
            'info'=>$fees
        ]);
//        return $fees;
    }
    
    
    /**
     * 更新或者创建用户收获地址
     */
    public function createFeeCount()
    {
        (new FeeNew())->goCheck([],'create');

        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkAuditUser($uid);
        FeeService::createCount($user);
        return new SuccessMessage();
    }

    public function getFeeCounts($page = 1,$size = 30)
    {
        (new FeeNew())->goCheck([],'read');
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $data = Request::instance()->post();
//        $data['userid'] = $uid;
        $data['property_id'] = $user->property_id;
        $data['house_id'] = $user->house_id;
        $feeCounts = FeeCountModel::getSummary($data,['id','count','fee_id','unit','create_time','datetime'],true, $page, $size);
        if($feeCounts->isEmpty()){
            $feeCounts = [
                'current_page' => $feeCounts->currentPage(),
                'total' => $feeCounts->total(),
                'data' => []
            ];
        }

        return new SuccessReturn([
            'info'=>$feeCounts
        ]);
//        return $feeCounts;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $data['id'] = $id;
        $data['property_id'] = $user->property_id;
        $data['house_id'] = $user->house_id;
        $feeCount = FeeCountModel::getDetail($data);
        if(!$feeCount){
            throw new FeeException() ;
        }

        return new SuccessReturn([
            'info'=>$feeCount
        ]);
//        return $feeCount;
    }


    public function delete()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkAuditUser($uid);
        $data['id'] = $id;
        $data['userid'] = $uid;
        $data['property_id'] = $user->property_id;
        $data['house_id'] = $user->house_id;
        FeeService::checkFeeCount($data);
        $result = FeeCountModel::destroy($id);
        if($result===false){
            throw new FeeException([
                'msg'=>'删除报修记录失败',
                'error'=>30009
            ]);
        }
        return new SuccessMessage();
    }
}