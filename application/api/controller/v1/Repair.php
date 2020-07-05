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
use app\api\model\Repair as RepairModel;
use app\api\service\Identify as IdentifyService;
use app\api\service\Repair as RepairService;
use app\api\service\Token as TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\RepairNew;
use app\lib\exception\RepairException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Repair extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createRepair']
    ];

    /**
     * 更新或者创建用户收获地址
     */
    public function createRepair()
    {
        (new RepairNew())->goCheck([],'create');

        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkAuditUser($uid);
        RepairService::create($user);

        return new SuccessMessage();
    }

    public function getRepairs($page = 1,$size = 30)
    {
        (new RepairNew())->goCheck([],'get');
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $data = Request::instance()->post();
        $data['userid'] = $uid;
        $repairs = RepairModel::getSummary($data,['id','repair_no','description','fix_status','fixed_time','create_time'],true, $page, $size);
        if($repairs->isEmpty()){
            $repairs = [
                'current_page' => $repairs->currentPage(),
                'total' => $repairs->total(),
                'data' => []
            ];
        }else{
            $repairs->append(['fix_status_text']);
        }
        
        return new SuccessReturn([
            'info'=>$repairs
        ]);
//        return $repairs;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $repair = RepairModel::getDetail(['id'=>$id,'userid'=>$uid]);
        if(!$repair){
            throw new RepairException() ;
        }
        $repair->append(['fix_status_text']);

        return new SuccessReturn([
            'info'=>$repair
        ]);
//        return $repair;
    }


    public function delete()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        RepairService::checkRepair(['id'=>$id,'userid'=>$uid]);
        $result = RepairModel::update(['status'=>0],['id'=>$id]);
        if($result===false){
            throw new RepairException([
                'msg'=>'取消报修记录失败',
                'error'=>30011
            ]);
        }
        return new SuccessMessage();
    }
}