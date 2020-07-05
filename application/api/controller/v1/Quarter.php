<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Quarter as QuarterModel;
use app\api\model\User;
use app\api\service\Quarter as QuarterService;
use app\lib\exception\QuarterException;
use app\lib\exception\SuccessReturn;

class Quarter extends BaseController
{
    /**
     * 获取小区列表
     * @return $this
     */
    public function getNormals()
    {
//        $house_ids = User::getHouseIds();
        $quarters = QuarterModel::getAllByData([],['id','name','pid']);
        if($quarters->isEmpty()){
            throw new QuarterException();
        }
        $quarters = QuarterService::process($quarters->toArray());
        return new SuccessReturn([
            'info'=>$quarters
        ]);
//        return $quarters;
    }

}