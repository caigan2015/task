<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class CompetitionLive extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("search")) {
            $map['title|summary'] = ["like", "%" . $this->request->param("search") . "%"];
        }
        if ($this->request->param("competition_id")) {
            $map['competition_id'] = $this->request->param("competition_id");
        }
        $stime = $this->request->param("stime","","trim");
        $etime = $this->request->param("etime","","trim");
        if ($stime ||$etime) {
            $time = time();
            $stime = !empty($stime)?strtotime($stime):$time;
            $etime = !empty($etime)?strtotime($etime):$time;
            $map['publish_time'] = ["between", [$stime,$etime]];
        }
        
    }

    public function addLive()
    {
        if($this->request->isAjax()){
            $competition_id = $this->request->get('competition_id');
            $now = time();
            if($competition_id){
                $streamName = 'competition_'.$competition_id.'_'.$now;
            }else{
                $streamName = 'notcompetition_'.$now;
            }

            $alilive = new \Alilive();
            $Client = $alilive::getInstance();
            //推流地址
            $plug = $Client->getPushUrl($streamName);
            if(!$plug){
                return ajax_return_error('获取推流地址失败');
            }
            //播放地址
            $play = $Client->getPlayUrls($streamName);
            if(!$play){
                return ajax_return_error('获取播放地址失败');
            }
            //失效时间
            $expireTime = $Client->authTime + $now;
            return ajax_return(['plug'=>$plug,'play'=>$play,'expire_time'=>$expireTime],'获取成功');
        }else{
            return ajax_return_error('非法请求');
        }
    }

    public function play()
    {
        $url = $this->request->param('url');
        $this->view->assign('url',$url);
        return $this->view->fetch();
    }
}
