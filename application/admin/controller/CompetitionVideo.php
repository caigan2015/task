<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use aliyun\live\Client;
use app\admin\Controller;
use think\Db;

class CompetitionVideo extends Controller
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

  /*  public function addLive()
    {
        if($this->request->isPost()){
            $data = $this->request->post();
            if(empty($data['name'])){
                return ajax_return_error('资源路径不能为空');
            }

            $data['cate'] = 2;
            $data['from'] = 2;
            $data['type'] = 'video/live';
            $data['original'] = urldecode(basename($data['name']));
            $data['mtime'] = time();

            $res = Db::name('File')->insertGetId($data);
            
            if(!$res){
                return ajax_return_error('添加失败');
            }

            return ajax_return(['id'=>$res],'添加成功');
        }else{
            return ajax_return_error('非法请求');
        }

    }*/
    /**
     * @return mixed
     */
    public function addLive()
    {
        if($this->request->isAjax()){
            $competition_id = $this->request->get('competition_id');
            if(empty($competition_id)){
                return ajax_return_error('获取赛事ID失败');
            }
            $streamName = 'competition_'.$competition_id;
            
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
            $play = implode('||',$play);
            
            return ajax_return(['plug'=>$plug,'play'=>$play],'获取成功');
        }else{
            return ajax_return_error('非法请求');
        }
    }

    /**
     * @return string
     */
    public function downloadAlioss()
    {
        if ($this->request->isGet()) {
            $filepath = $this->request->root().config('app.ossbrowser_downpath');
            return \File::download($filepath);
        } else {
            return ajax_return_error('非法请求');
        }
    }
}
