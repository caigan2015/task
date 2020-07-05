<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\User as UserModel;
use app\common\model\Order as OrderModel;
use think\Exception;

class Order extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("username")) {
            $where['username'] = ["like", "%" . $this->request->param("username") . "%"];
            $user_ids = UserModel::getUserColumn($where,'id');
            $map['user_id'] = ['IN',$user_ids];
        }
        if ($this->request->param("keywords")) {
            $map['order_no|name|phone'] = ["like", "%" . $this->request->param("keywords") . "%"];
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
        if ($this->request->param("pay_way")) {
            $map['pay_way'] = ["eq", $this->request->param("pay_way")];
        }
    }


    /**
     * 详情
     */
    public function detail()
    {
        $id = $this->request->param('id');
        if (!$id) {
            throw new Exception('缺少必要参数ID');
        }
        $vo = OrderModel::get($id);
//            if (!$vo) {
//                throw new HttpException(404, '该记录不存在');
//            }
        $this->view->assign("vo", $vo);
        return $this->view->fetch();
    }
}
