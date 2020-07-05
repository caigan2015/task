<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/18
 * Time: 12:35
 */
namespace app\api\validate;

class DeviceGet extends BaseValidate
{
    protected $rule = [
        'id|设备ID' => 'require',
        'devCode|设备唯一标识' => 'require',
        'token|密码' => 'require',
        'serverTime|发送时间' => 'require|date',
        'user|用户信息' => 'require|array',
        'userCode|用户编码' => 'require',
        'userName|用户名' => 'require',
        'photo|用户人脸照片' => 'require|is_base64',
        'delUser|用户信息' => 'require|array',
        'ar|打卡记录' => 'require|array',
        'checkType|开门方式' => 'require|number',
        'successInfo|验证结果' => 'require|number',
        'checkTime|刷卡时间' => 'require|date',
        'devInfo|设备信息' => 'require|array',
        'model|设备型号' => 'require',
        'usedFaceSize|已注册人脸数量' => 'require|number',
        'faceSize|人脸最大注册容量' => 'require|number',
        'arSize|打卡记录数量' => 'require|number',
        'ip|设备IP' => 'require|ip',
        'status|设备状态' => 'require|number',
    ];
    
    protected $scene = [
        'base' => ['devCode','serverTime'],
        'syncuser' => ['devCode','serverTime','user'],
        'searchuser' => ['devCode','serverTime','userCode'],
        'user'=>['userCode','userName','photo'],
        'deluser' => ['devCode','serverTime','delUser'],
//        'del'=>['id'],
        'syncrecord' => ['devCode','serverTime','ar'],
        'ar'=>['userCode','checkType','photo','successInfo','checkTime'],
        'devregister' => ['devCode','serverTime','devInfo'],
        'device'=>['model','usedFaceSize','faceSize','arSize'],
        'online'=>['devCode','serverTime','ip','status'],
        'login'=>['devCode','token'],
    ];
}
