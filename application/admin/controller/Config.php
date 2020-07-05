<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Request;
use app\common\model\Config as ConfigModel;

class Config extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }
    }

    public function write()
    {
        $data = Request::instance()->post();
        if(empty($data['id'])){
           return ajax_return_adv_error('获取ID失败');
        }
        if($data['is_write']===''){
           return ajax_return_adv_error('获取写入状态失败');
        }

        $res = ConfigModel::update(['is_write'=>($data['is_write']=="0")?"1":"0"],['id'=>$data['id']]);
        if($res===false){
            return ajax_return_adv_error('更新失败');
        }
        $this->writeConfigFile();
        return ajax_return_adv('更新成功','current');

    }

    /**
     * 改写配置文档
     */
    private function writeConfigFile()
    {
        $configs = ConfigModel::getWriteColumns();
        foreach ( $configs as $key=>&$config) {
            if(!$config)
                unset($configs[$key]);
        }
        if(!empty($configs)){
            $path = EXTRA_PATH.'setting.php';
            $str = '<?php '."\r\n".'return '.var_export($configs,true).';';
            file_put_contents($path,$str);
            return true;
        }else{
            return ajax_return_adv_error('没有数据写入配置文档');
        }
    }

    /**
     * 敏感词设置
     */
    public function sensitive()
    {
        $request = Request::instance();
        if($request->isPost()){
            $allergicWord = $request->post('allergicWord','','trim');
            if(empty($allergicWord)){
                return ajax_return_adv_error('请输入敏感词');
            }
            $bool = file_put_contents('./Docs/allergic_words.txt',$allergicWord);
            if(!$bool){
                return ajax_return_adv_error('更新失败','');
            }
            return ajax_return_adv('更新成功','');
        }else{
            $allergicWord = file_get_contents('./Docs/allergic_words.txt');
            $this->view->assign('allergicWord',$allergicWord);
            return $this->view->fetch();
        }
    }
}


