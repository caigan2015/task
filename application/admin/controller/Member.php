<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Member as MemberModel;
use app\common\model\Team as TeamModel;
use think\Db;
use think\Exception;
use think\exception\HttpException;

class Member extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("cn_name")) {
            $map['cn_name'] = ["like", "%" . $this->request->param("cn_name") . "%"];
        }
    }
    /**
     * 个人简历
     * @return mixed
     */
//    public function userinfo()
//    {
//        if ($this->request->isAjax()) {
//            // 更新
//            $data = $this->request->post();
//            if (!$data['user_id']) {
//                return ajax_return_adv_error("缺少参数ID或USER_ID");
//            }
//
//            // 验证
//            $validate = new UserInfo();
//            if (!$validate->check($data)) {
//                return ajax_return_adv_error($validate->getError());
//            }
//
//            // 更新数据
//            if(class_exists('app\common\model\UserInfo')){
//                // 使用模型更新，可以在模型中定义更高级的操作
//                $model = new UserInfoModel();
//                if(!empty($data['id'])){
//                    $ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
//                }else{
//                    $ret = $model->isUpdate(false)->save($data);
//                }
//            } else {
//                // 简单的直接使用db更新
//                Db::startTrans();
//                try {
//                    $model = Db::name('UserInfo');
//                    if(!empty($data['id']))
//                        $ret = $model->where('id', $data['id'])->update($data);
//                    else
//                        $ret = $model->insert($data);
//                    // 提交事务
//                    Db::commit();
//                } catch (\Exception $e) {
//                    // 回滚事务
//                    Db::rollback();
//
//                    return ajax_return_adv_error($e->getMessage());
//                }
//            }
//
//            return ajax_return_adv((!empty($data['id'])?"编辑成功":"添加成功"),"");
//        } else {
//            // 编辑
////            $id = $this->request->param('id');
//            $user_id = $this->request->param('user_id');
//            if (!$user_id) {
//                throw new HttpException(404, "缺少参数USER_ID");
//            }
//            $model = new UserInfoModel();
//            $where['user_id'] = $user_id;
//            $vo = $model->where($where)->find();
////            if (!$vo) {
////                throw new HttpException(404, '该记录不存在');
////            }
//
//            $this->view->assign("vo", $vo);
//
//            return $this->view->fetch();
//        }
//    }

    /**
     * 详情
     */
    public function detail()
    {
        $id = $this->request->param('id');
        if (!$id) {
            throw new Exception('缺少必要参数ID');
        }
            $vo = MemberModel::get($id);
//            if (!$vo) {
//                throw new HttpException(404, '该记录不存在');
//            }
            $this->view->assign("vo", $vo);
            return $this->view->fetch();
    }



    /**
     * 球队列表
     */
    public function team()
    {
        $member_id = $this->request->param('member_id/d');
        $db_team_member = Db::name("TeamMember");
        if ($this->request->isPost()) {
            // 提交
            if (!$member_id) {
                return ajax_return_adv_error("缺少必要参数");
            }

            //删除之前的角色绑定
            $db_team_member->where("member_id", $member_id)->delete();
            //写入新的角色绑定
            $data = $this->request->post();
            if (isset($data['team_id']) && !empty($data['team_id']) && is_array($data['team_id'])) {
                $insert_all = [];
                foreach ($data['team_id'] as $v) {
                    $insert_all[] = [
                        "member_id" => $member_id,
                        "team_id" => intval($v),
                    ];
                }
                $db_team_member->insertAll($insert_all);
            }
            return ajax_return_adv("加入球队成功", '');
        } else {
            // 编辑页
            if (!$member_id) {
                throw new Exception("缺少必要参数");
            }
            // 读取系统的球队列表
            $list_team = (new TeamModel())->field('id,name,logo,from')->where('status=1')->select();

            // 已授权权限
            $list_team_member = $db_team_member->where("member_id", $member_id)->select();
            $checks = filter_value($list_team_member, "team_id", true);

            $this->view->assign('list', $list_team);
            $this->view->assign('checks', $checks);

            return $this->view->fetch();
        }
    }


}
