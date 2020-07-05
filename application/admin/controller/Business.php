<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Category as CategoryModel;

class Business extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("search")) {
            $map['title'] = ["like", "%" . $this->request->param("search") . "%"];
        }

        if ($this->request->param("status")) {
            $map['status'] = ["eq", $this->request->param("status")];
        }

        if ($this->request->param("istui")) {
            $map['istui'] = ["eq", $this->request->param("istui")];
        }

        $parents = CategoryModel::getNormalData(['pid'=>0],['id','name']);
        $this->view->assign('parents',$parents);
    }
}
