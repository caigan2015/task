<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Team as TeamModel;
use think\Db;
use think\Exception;

class Competition extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("search")) {
            $map['title'] = ["like", "%" . $this->request->param("search") . "%"];
        }
        if ($this->request->param("stime") ||$this->request->param("etime")) {
            $time = time();
            $stime = $this->request->param("stime").' 00:00:00';
            $etime = $this->request->param("etime").' 23:59:59';
            $stime = !empty($stime)?strtotime($stime):$time;
            $etime = !empty($etime)?strtotime($etime):$time;
            $map['play_time'] = ["between", [$stime,$etime]];
        }
    }


    /**
     * 球队列表
     */
    public function team()
    {
        $competition_id = $this->request->param('competition_id/d');
        if ($this->request->isPost()) {
            // 提交
            if (!$competition_id) {
                return ajax_return_adv_error("缺少必要参数");
            }

            $db_team_competition = Db::name("TeamCompetition");
            //删除之前的角色绑定
            $db_team_competition->where("competition_id", $competition_id)->delete();
            //写入新的角色绑定
            $data = $this->request->post();
            if (isset($data['team_id']) && !empty($data['team_id']) && is_array($data['team_id'])) {
				$teamCount = count($data['team_id']);
                if($teamCount>2 || $teamCount<1){
                    return ajax_return_adv_error("必须选择1支或2支球队");
                }
                $insert_all = [];
                foreach ($data['team_id'] as $v) {
                    $insert_all[] = [
                        "competition_id" => $competition_id,
                        "team_id" => intval($v),
                    ];
                }
                $db_team_competition->insertAll($insert_all);
            }
            return ajax_return_adv("分配球队成功", '');
        } else {
            // 编辑页
            if (!$competition_id) {
                throw new Exception("缺少必要参数");
            }
            // 读取系统的球队列表
            $list_team = (new TeamModel())->field('id,name,logo,from')->where('status=1')->select();

            // 已授权权限
            $list_team_competition = Db::name("TeamCompetition")->where("competition_id", $competition_id)->select();
            $checks = filter_value($list_team_competition, "team_id", true);

            $this->view->assign('list', $list_team);
            $this->view->assign('checks', $checks);

            return $this->view->fetch();
        }
    }

}
