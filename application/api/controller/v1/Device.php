<?php
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\DeviceUser;
use app\api\service\Device as DeviceService;
use app\lib\exception\DeviceException;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Log;

class Device extends BaseController{

    protected $data = [];
    protected $type = 'json';

    //代码：300数据   400操作
    public function _initialize()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');

        $data = file_get_contents('php://input');
//        Log::write('收到数据：内容太多就不打印了。');
        if(!$data){
            throw new ParameterException([
                'error_code'=>300,
                'msg'=>'no data'
            ]);
        }

        if($data_arr = xml_parser($data)){
            $this->type = 'xml';
        }else if($data_arr = json_decode($data,true)){
            $this->type = 'json';
        }else if($data_arr = convertUrlQuery($data)) {
            $this->type = 'string';
        }else{
            throw new ParameterException([
                'msg'=>'invalid data-format'
            ]);
        }
        $this->data = $data_arr;
    }

    /**
     * 上传用户
     */
    public function syncUser()
    {
        $data = $this->data;
        if(config('app_debug')){
            $tmp = $data;
            if(!empty($tmp['user']['photo'])){
                unset($tmp['user']['photo']);
            }
            Log::write("收到用户同步数据：".json_encode($tmp));
        }
        $result = DeviceService::syncUser($data);
        return new SuccessReturn([
            'info'=>$result
        ]);
    }

    /**
     * 注销用户
     */
    public function delOrRecUser()
    {

        $data = $this->data;
        DeviceService::delOrRecUser($data);
        return new SuccessMessage();
    }
    /**
     * 清除用户
     */
    public function cleanUser()
    {

        $data = $this->data;
        DeviceService::cleanUser($data);
        return new SuccessMessage();
    }

    /**
     * 上传打卡记录
     */
    public function syncRecord()
    {
        $data = $this->data;
        DeviceService::syncRecord($data);
        return new SuccessMessage();
    }

    /**
     * 设备注册
     */
    public function devRegister()
    {
        $data = $this->data;
        $device = DeviceService::devRegister($data);
        $device->users = DeviceUser::all(['deviceid'=>$device->id]);
        return new SuccessReturn([
            'info'=>[
                'devCode'=>$device->serial,
                'token'=>$device->token,
                'port'=> config('device.main_port'),
            ]
        ]);
    }

    /**
     * 同步设备
     */
    public function syncDevice()
    {
        $data = $this->data;
        DeviceService::syncDevice($data);
        return new SuccessMessage();
    }

    /**
     * 注销设备
     */
    public function delDev()
    {
        $data = $this->data;
        DeviceService::delDev($data);
        return new SuccessMessage();
    }

    /**
     *刷新设备状态
     */
    public function checkOnLine()
    {
        $data = $this->data;
        DeviceService::refreshOnLine($data);
        return new SuccessMessage();
    }

    /**
     * 获取服务器信息
     */
    public function getInfo()
    {
        $data = $this->data;
        $result = DeviceService::getUriInfo($data);
        return new SuccessReturn([
            'info'=>$result
        ]);

    }

    public function login()
    {
        $data = $this->data;
        $result = DeviceService::checkLogin($data);
        return new SuccessReturn([
            'info'=>$result
        ]);
    }

    public function devLog()
    {
        $data = $this->data;
        DeviceService::writeDevLog($data);
        return new SuccessMessage();
    }

    public function searchUser()
    {
        $data = $this->data;
        $result = DeviceService::searchUser($data);
        return new SuccessReturn([
            'info'=>$result
        ]);
    }
}