<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Member as MemberModel;
use think\Db;
use think\exception\HttpException;

class User extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("keywords")) {
            $map['username|mobile'] = ["like", "%" . $this->request->param("keywords") . "%"];
        }
        if ($this->request->param("stime") ||$this->request->param("etime")) {
            $time = time();
            $stime = $this->request->param("stime").' 00:00:00';
            $etime = $this->request->param("etime").' 23:59:59';
            $stime = !empty($stime)?strtotime($stime):$time;
            $etime = !empty($etime)?strtotime($etime):$time;
            $map['create_time'] = ["between", [$stime,$etime]];
        }
        if ($this->request->param("status")) {
            $map['status'] = ["eq", $this->request->param("status")];
        }

        $member_user_ids = MemberModel::getMemberUserIds();
        
        if($this->request->action()=='memberlist'){
            $map['id'] = ['IN',$member_user_ids];
        }

        if($this->request->action()=='commonlist'){
            $map['id'] = ['NOT IN',$member_user_ids];
        }
    }

    public function commonlist()
    {
        return $this->index();
    }
    public function memberlist()
    {
        return $this->index();
    }

    public function member()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            if(empty($data['user_id'])){
                return ajax_return_adv_error('获取用户ID失败');
            }
            if(empty($data['member_id'])){
                return ajax_return_adv_error('获取会员ID失败');
            }

            $res = MemberModel::update(['user_id'=>$data['user_id']],['id'=>$data['member_id']]);
            if($res===false){
                return ajax_return_adv_error('关联失败');
            }

            return ajax_return_adv('关联成功');
        }
        
        $data = [];
        if ($this->request->param("cn_name")) {
            $data['cn_name'] = ["like", "%" . $this->request->param("cn_name") . "%"];
        }
        $field = ['id','cn_name','photo','mobile','user_id','from','status'];
        $list = MemberModel::getNormalMembers($data,$field);
        $this->view->assign("list", $list);
        return $this->view->fetch();
    }

    public function unbind()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            if(empty($data['user_id'])){
                return ajax_return_adv_error('获取用户ID失败');
            }

            if(empty($data['member_id'])){
                return ajax_return_adv_error('获取会员ID失败');
            }

            $res = MemberModel::update(['user_id'=>0],['id'=>$data['member_id'],'user_id'=>$data['user_id']]);
            if($res===false){
                return ajax_return_adv_error('解绑失败');
            }

            return ajax_return_adv('解绑成功','current');
        }
    }
}
