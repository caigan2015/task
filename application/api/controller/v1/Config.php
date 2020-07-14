<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Config as ConfigModel;
use app\api\validate\ConfigGet;
use app\lib\exception\ConfigException;
use app\lib\exception\SuccessReturn;

class Config extends BaseController
{
    public function getValueByCode()
    {
        (new ConfigGet())->goCheck();
        $data = $this->request->post();
        $code = $data['code'];
        $tags = $data['tags'];

        $value = ConfigModel::getColumns(['code'=>is_array($code) ? ['IN',$code] : $code],$tags);

        if(!$value){
            throw new ConfigException();
        }

        return new SuccessReturn([
            'info'=>$value
        ]);
    }
}