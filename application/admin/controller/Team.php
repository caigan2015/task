<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Team extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }

        if ($this->request->param("stime") ||$this->request->param("etime")) {
            $time = time();
            $stime = $this->request->param("stime").' 00:00:00';
            $etime = $this->request->param("etime").' 23:59:59';
            $stime = !empty($stime)?strtotime($stime):$time;
            $etime = !empty($etime)?strtotime($etime):$time;
            $map['establishment_time'] = ["between", [$stime,$etime]];
        }
    }
}
