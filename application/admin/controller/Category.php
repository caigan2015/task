<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Category as CategoryModel;

class Category extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }
        if ($this->request->param("pid")) {
            $map['pid'] = ["eq", $this->request->param("pid")];
        }
        
        $parents = CategoryModel::getNormalData(['pid'=>0],['id','name']);
        $this->view->assign('parents',$parents);
        
    }

    public function tree()
    {
        $where['pid'] = 0;
        $list = CategoryModel::getNormalData($where);
        $str = '';
        $str.='{ id:0, pId:-1, name:"添加分类", open:true},';
        foreach ($list as $k1=>$v1){
            $str.='{ id:'.$v1['id'].', pId:0, name:"'.$v1['name'].'(一级)"},';
            $where[$k1]['pid'] = $v1['id'];
            $second = CategoryModel::getNormalData($where[$k1]);
            if($second){
                foreach ($second as $k2=>$v2){
                    $str.='{ id:'.$v2['id'].', pId:'.$v1['id'].', name:"'.$v2['name'].'(二级)"},';
                    $where[$k2]['pid'] = $v2['id'];
                    $three = CategoryModel::getNormalData($where[$k2]);
                    if($three) {
                        foreach ($three as $k3 => $v3) {
                            $str .= '{ id:' . $v3['id'] . ', pId:' . $v2['id'] . ', name:"' . $v3['name'] . '(三级)"},';
                        }
                    }
                }
            }
        }
        $this->view->assign('trees',$str);
        return $this->view->fetch();
    }

    //异步获取
    public function ajaxGetParents()
    {
        if($this->request->isAjax()){
            $cates = CategoryModel::getNormalData([],['id','name']);
            return ajax_return($cates,'success');
        }
    }
}
