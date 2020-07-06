<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\lib\exception\MissException;
use app\lib\exception\SuccessReturn;

/**
 * Category资源
 */ 
class Category extends BaseController
{
    public function getAllCategory()
    {
        $categories = CategoryModel::getAllByData([]);
        if ($categories->isEmpty() ) {
            throw new MissException([
                'msg' => '分類不存在',
                'error_code' => 40003
            ]);
        }
        return new SuccessReturn([
            'info'=>$categories
        ]);
    }
}