<?php
namespace app\api\service;

use app\api\model\Device as DeviceModel;
use app\api\model\DeviceUser;
use app\api\model\DoorAuth;
use app\api\model\FaceRecord;
use app\api\model\Structure;
use app\api\validate\DeviceGet;
use app\lib\exception\DeviceException;
use app\lib\exception\ImageException;
use app\lib\exception\ParameterException;
use app\lib\exception\SuccessMessage;
use think\Db;
use think\Log;
use think\Request;

class Device
{
    public static function syncUser($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'syncuser');

        $device = self::checkDevice($data['devCode']);
        $save['server_time'] = strtotime($data['serverTime']);
        $save['deviceid'] = $device->id;
        $save['property_id'] = !empty($device->structureid) ? ((new Structure())->where(['id' => $device->structureid])->value('property_id')) : 0;

        Db::startTrans();
        $tmp = [];
        if (count($data['user']) == count($data['user'], 1)) {
            self::validate($validate, $data['user'], [], 'user');
            $user = array_merge($save, $data['user']);
            $bool = self::saveUsers($device->id, $user);
            if($bool){
                $tmp[] = ['devCode'=>$data['devCode'],'localCode'=>$bool->id,'userCode'=>$bool->userCode];
            }
        } else {
            foreach ($data['user'] as $item) {
                self::validate($validate, $item, [], 'user');
            }
            $bool = true;
            foreach ($data['user'] as $user) {
                $user = array_merge($save, $user);
                $res = self::saveUsers($device->id, $user);
                if ($res === false) {
                    $bool = false;
                    break;
                }
               $tmp[]  = ['devCode'=>$data['devCode'],'localCode'=>$res->id,'userCode'=>$res->userCode];
            }

        }

        if ($bool === false) {
            Db::rollback();
            throw new DeviceException([
                'msg' => 'enter user failed',
                'error_code' => 401
            ]);
        }
        Db::commit();
        return $tmp;
    }

    public static function delOrRecUser($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'deluser');

        if ((empty($data['delUser']['id']) && empty($data['delUser']['isAll'])) || !isset($data['delUser']['isDelete'])) {
            throw new ParameterException([
                'error_code' => 300
            ]);
        }
        $device = self::checkDevice($data['devCode']);

        $where['deviceid'] = $device->id;
        if (!empty($data['delUser']['id']))
            $where['id'] = is_array($data['delUser']['id']) ? ['IN', $data['delUser']['id']] : $data['delUser']['id'];

        $deviceUserM = new DeviceUser();
        $device_users = $deviceUserM->all($where);
        if (!$device_users->isEmpty())//删除
        {
            $bool = $deviceUserM->where($where)->update(['isdelete'=>$data['delUser']['isDelete']]);
            if ($bool===false) {
                throw new DeviceException([
                    'msg' => 'delete user failed',
                    'error_code' => 401
                ]);
            }
        }
    }

    public static function cleanUser($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'deluser');

        if (empty($data['delUser']['id'])) {
            throw new ParameterException([
                'error_code' => 300
            ]);
        }
        $device = self::checkDevice($data['devCode']);

        $where['deviceid'] = $device->id;
        $where['id'] = $data['delUser']['id'];

        $deviceUserM = new DeviceUser();
        $userCode = $deviceUserM->where($where)->value('userCode');
        $where_code['userCode'] = $userCode;
        $device_users = $deviceUserM->all($where_code);
        if (!$device_users->isEmpty())//删除
        {
            $bool = $deviceUserM->where($where_code)->delete();;
            if (!$bool) {
                throw new DeviceException([
                    'msg' => 'delete user failed',
                    'error_code' => 401
                ]);
            }
            foreach ($device_users as $device_user) {
                //删除图像
                if (!empty($device_user['photo']) && file_exists('.' . $device_user['photo'])) {
                    unlink('.' . $device_user['photo']);
                }
                //撤消同步
                $where_a['deviceuserid'] = $device_user->id;
                (new DoorAuth())->where($where_a)->delete();
            }
        }
    }

    public static function syncRecord($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'syncrecord');

        $device = self::checkDevice($data['devCode']);
        $save['devCode'] = $data['devCode'];
        $save['serverTime'] = strtotime($data['serverTime']);
        $save['property_id'] = !empty($device->structureid) ? ((new Structure())->where(['id' => $device->structureid])->value('property_id')) : 0;
        Db::startTrans();
        if (count($data['ar']) == count($data['ar'], COUNT_RECURSIVE)) {
            //一维数组
            self::validate($validate, $data['ar'], [], 'ar');
            $ar = array_merge($save, $data['ar']);
            $bool = self::saveRecords($device->id, $ar);
        } else {
            foreach ($data['ar'] as $item) {
                self::validate($validate, $item, [], 'ar');
            }
            $bool = true;
            foreach ($data['ar'] as $ar) {
                $ar = array_merge($save, $ar);
                $res = self::saveRecords($device->id, $ar);
                if ($res === false) {
                    $bool = false;
                    break;
                }
            }
        }

        if ($bool === false) {
            Db::rollback();
            throw new DeviceException([
                'msg' => 'enter record failed',
                'error_code' => 401
            ]);
        }

        Db::commit();
    }

    public static function devRegister($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'devregister');
        self::validate($validate, $data['devInfo'], [], 'device');

        $device = self::checkDevice($data['devCode'], false);
        if (!empty($device)) {
//            $wsPort = $device->structureid?(DeviceModel::getControlPortBySid($device->structureid)):config('device.main_port');
//            throw new SuccessReturn([
//                'msg'=>'device already register',
//                'info'=>[
//                    'devCode'=>$device->serial,
//                    'token'=>$device->token,
//                ]
//            ]);
            return $device;
        }

        $save = $data['devInfo'];
        $save['serial'] = $data['devCode'];
        $save['ip'] = Request::instance()->ip();
        $save['server_time'] = (!empty($data['serverTime'])) ? strtotime($data['serverTime']) : time();
        if (empty($save['token'])) {
            $save['token'] = Token::generateToken();
        }
        $save = array_filter($save);
        $newDevice = DeviceModel::create($save);
        if (!$newDevice) {
            throw new DeviceException([
                'msg' => 'device register failed',
                'error_code' => 401
            ]);
        }
        return $newDevice;
    }

    /**
     * @param $data
     * @throws DeviceException
     * @throws ParameterException
     */
    public static function syncDevice($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'devregister');

        $device = self::checkDevice($data['devCode']);
        $save = $data['devInfo'];
        $save['server_time'] = strtotime($data['serverTime']);
        $save = array_filter($save);
        $bool = $device->save($save);
        if ($bool === false) {
            throw new DeviceException([
                'msg' => 'sync device failed',
                'error_code' => 401
            ]);
        }
    }

    public static function delDev($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'base');
        Db::startTrans();
        $device = self::checkDevice($data['devCode']);
        $device->delete();
        //删除同步\
        $deviceUsersM = new DeviceUser();
        $DoorAuthM = new DoorAuth();
        $where['deviceid'] = $device->id;
        $deviceUsers = $deviceUsersM->all($where);
        if (!empty($deviceUsers)) {
            foreach ($deviceUsers as $deviceUser) {
                if ($deviceUser->delete()) {
                    $authWhere['deviceuserid'] = $deviceUser->id;
                    if ($DoorAuthM->where($authWhere)->count() > 0) {
                        $DoorAuthM->where($authWhere)->delete();
                    }
                }
            }
        }

        //删除设备用户
        Db::commit();

    }

    public static function refreshOnLine($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'online');
        $device = DeviceModel::get(['serial' => $data['devCode']]);
        if (!$device) {
            throw new DeviceException();
        }
        $time = strtotime($data['serverTime']);
        //修改IP
        if ($device->ip != $data['ip']) {
            $save['ip'] = $data['ip'];
            $save['is_online'] = $data['status'];
            $save['on_time'] = time();
            $save['update_time'] = $time;
            $device->save($save);
        }
    }

    public static function searchUser($data)
    {
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'searchuser');
        $device = self::checkDevice($data['devCode']);
        $where['deviceid'] = $device->id;
        if (is_array($data['userCode'])) {
            $where['userCode'] = ['IN', $data['userCode']];
        } else {
            $where['userCode'] = $data['userCode'];
        }
        $device_users = DeviceUser::getAllByData($where);
        return $device_users;
    }

    public static function getUriInfo($data)
    {
        //验证
//        $validate = new DeviceGet();
//        self::validate($validate, $data, [], 'base');
//        $device = self::checkDevice($data['devCode']);
        $baseApiUri = config('app.device_uri');
//        $return['devCode'] = $data['devCode'];
        $return['serverTime'] = date('Y-m-d H:i:s');
//        $wsPort = $device->structureid?(DeviceModel::getControlPortBySid($device->structureid)):config('device.main_port');
        $return['interface'] = [
            "version" => config('app.device_version'),
            "host" => config('app.base_url'),
            "port" => $_SERVER['SERVER_PORT'],
            "syncuserUri" => $baseApiUri . "syncuser",
            "delorrecuserUri" => $baseApiUri . "delorrecuser",
            "cleanuserUri" => $baseApiUri . "cleanuser",
            "syncrecordUri" => $baseApiUri . "syncrecord",
            "devregisterUri" => $baseApiUri . "devregister",
            "syncdevUri" => $baseApiUri . "syncdev",
            "deldevUri" => $baseApiUri . "deldev",
            "checkonlineUri" => $baseApiUri . "checkonline",
            "wsUrl" => config('device.ws_url'),
            "wsPort" => config('device.main_port'),
            "wsTag" => config('device.tag'),
            "wsType" => config('device.type'),
            "devAuthExpire" => config('device.auth_expire_in'),
        ];
        return $return;
    }


    public static function writeDevLog($data)
    {
        if (!empty($data['devCode']) && !empty($data['timestamp'])) {
            define('DEV_LOG_PATH', './device_log' . DS . $data['devCode'] . DS);
            if (!file_exists(DEV_LOG_PATH)) {
                mkdir(DEV_LOG_PATH, 0777, true);
            }

            $log_file = DEV_LOG_PATH . date('Ymd') . '.log';
            file_put_contents($log_file, '[' . date('Y-m-d H:i:s', $data['timestamp']) . '] [' . $data['DebugType'] . '] [' . $data['where'] . ']' . $data['devCode'] . '：' . $data['message'] . "\r\n", FILE_APPEND);
        }
    }


    protected static function checkDevice($devCode, $check_exists = true)
    {
//        $ip = Request::instance()->ip();
        $device = DeviceModel::getOneByData(['serial' => $devCode]);
        if (!$device && $check_exists) {
            throw new DeviceException();
        }
        return $device;
    }

    private static function validate($validate = '', $data = [], $rules = [], $scene = '')
    {
        if (empty($validate) || !is_object($validate)) {
            $validate = new DeviceGet();
        }
        $result = $validate->check($data, $rules, $scene);
        if (!$result) {
            throw new ParameterException([
                'msg' => $validate->getError(),
                'error_code' => 300
            ]);
        }
    }

    private static function saveImage($photo)
    {
        $fileDir = "./tmp/uploads/face/";
        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }
        $filePath = $fileDir . uniqid() . '.jpg';
        $imgDecode = base64_decode($photo);
        //保存图片
        if (!file_put_contents($filePath, $imgDecode)) {
            throw new ImageException([
                'msg' => '保存图片失败',
                'error_code' => 404,
            ]);
        }
        return trim($filePath, '.');
    }

    public static function checkLogin($data)
    {
        //验证
        $validate = new DeviceGet();
        self::validate($validate, $data, [], 'login');
        $device = self::checkDevice($data['devCode']);
        if ($device['token'] != $data['token']) {
            throw new DeviceException([
                'msg' => 'invalid token',
                'error_code' => 401
            ]);
        }
        $auth = self::saveToCache($device);
        $users = DeviceUser::all(['deviceid' => $device->id]);

        return ["auth" => $auth, 'users' => $users->visible(['userCode','id'])];

    }

    private static function saveUsers($device_id, $save)
    {
        //保存图片
        $save['photo'] = self::saveImage($save['photo']);

        $where['deviceid'] = $device_id;
        $where['userCode'] = $save['userCode'];

        $device_user = DeviceUser::get($where);

        if ($device_user)//更新
        {
            $bool = $device_user->save($save);
            if($bool!==false){
                return $device_user;
            }
        } else//添加
        {
            $bool = DeviceUser::create($save);
        }
        return $bool;
    }

    private static function saveRecords($device_id, $save)
    {
        $save['checkTime'] = strtotime($save['checkTime']);
        //保存图片
        $save['photo'] = self::saveImage($save['photo']);

        $where_d_u['deviceid'] = $device_id;
        $where_d_u['userCode'] = $save['userCode'];
        $devUserId = (new DeviceUser())->where($where_d_u)->value('id');
        $save['deviceuserid'] = !empty($save['localCode'])?$save['localCode']:($devUserId?:0);

        $where['checkTime'] = $save['checkTime'];
        $where['deviceuserid'] = $save['deviceuserid'];
        $record = FaceRecord::get($where);

        if (!empty($record))//更新
        {
            $bool = $record->save($save);
        } else//添加
        {
            $bool = FaceRecord::create($save);
        }
        return $bool;
    }

    // 写入缓存
    private static function saveToCache($array)
    {
        $key = self::generateToken();
        $value = json_encode($array);
        $expire_in = config('device.auth_expire_in');
        $result = cache($key, $value, $expire_in);
        if (!$result) {
            return false;
        }
        return $key;
    }

    // 生成令牌
    public static function generateToken()
    {
        $randChar = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $tokenSalt = config('secure.token_salt');
        return md5($randChar . $timestamp . $tokenSalt);
    }


}