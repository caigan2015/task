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
use app\api\model\Pastport as PastportModel;
use app\api\service\Identify as IdentifyService;
use app\api\service\Pastport as PastportService;
use app\api\service\Token as TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\api\validate\PastportNew;
use app\lib\exception\PastportException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Pastport extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createPastport']
    ];

    /**
     * 更新或者创建用户收获地址
     */
    public function createPastport()
    {
        (new PastportNew())->goCheck([],'create');

        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkAuditUser($uid);
        $past = PastportService::create($user);

        $share_url = config('app.share_past_uri').$past->id;
        return new SuccessReturn([
            'info'=>[
                'share_original_url' =>config('app.base_url').$share_url,
                'share_short_url' => getShortUrl($share_url)
            ]
        ]);
//        return [
//            'share_original_url' =>config('app.base_url').$share_url,
//            'share_short_url' => getShortUrl($share_url)
//        ];
//        return new SuccessMessage();
    }

    public function getPastports($page = 1,$size = 30)
    {
        (new PastportNew())->goCheck([],'get');
        (new PagingParameter())->goCheck();
        
        $data = Request::instance()->post();
        $uid = TokenService::getCurrentUid();
        $data['userid'] = $uid;
        $records = PastportModel::getSummary($data,['id','visitor_name','sex','schedule_time','visited_time','enter_way','isvisited','expire_time','has_car','plate_number','ID_card','IC_card'],true, $page, $size);
        if($records->isEmpty()){
            $records = [
                'current_page' => $records->currentPage(),
                'total' => $records->total(),
                'data' => []
            ];
        }else{
            $records->append(['visit_status_now','enter_way_text']);
        }
        return new SuccessReturn([
            'info'=>$records
        ]);
//        return $records;
    }

    public function getDetail()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        $pastport = PastportService::checkPastport(['id'=>$id,'userid'=>$uid]);
        $pastport->append(['visit_status_now','enter_way_text']);
        return new SuccessReturn([
            'info'=>$pastport
        ]);
//        return $pastport;
//            ->visible(['id','visitor_name','sex','enter_way','schedule_time','has_car','plate_number','isvisited','visited_time']);
    }

    public function saveCard()
    {
        (new PastportNew())->goCheck([],'edit');
        $data = Request::instance()->post();
        $uid = TokenService::getCurrentUid();
        PastportService::checkPastport(['id'=>$data['id'],'userid'=>$uid]);
        $res = PastportModel::update($data);
        if($res===false){
            throw new PastportException([
                'msg'=>'提交失败',
                'error'=>30002
            ]);
        }

        //todo 发送给设备
        return new SuccessMessage();
    }

    public function delete()
    {
        (new IDMustBePositiveInt())->goCheck();
        $id = Request::instance()->param('id');
        $uid = TokenService::getCurrentUid();
        PastportService::checkPastport(['id'=>$id,'userid'=>$uid]);
        $result = PastportModel::update(['status'=>0],['id'=>$id]);
        if($result===false){
            throw new PastportException([
                'msg'=>'忽略通行证失败',
                'error'=>30003
            ]);
        }
        return new SuccessMessage();
    }
}