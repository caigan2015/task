<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/11
 * Time: 10:49
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Config as ConfigModel;
use app\api\validate\ConfigGet;
use app\lib\exception\ConfigException;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessReturn;
use think\Request;

class Config extends BaseController
{
    public function getValueByCode()
    {
        (new ConfigGet())->goCheck();
        $code = $_POST['code'];
        $tags = $_POST['tags'];
        if(is_array($code)){
            $value = ConfigModel::getColumns(['code'=>['IN',$code]],$tags);
        }else{
            $value = ConfigModel::getValue(['code'=>$code],$tags);
        }

        if(!$value){
            throw new ConfigException();
        }

        return new SuccessReturn([
            'info'=>$value
        ]);
//        return $value;
    }
}