<?php
namespace app\api\service;

use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Request;

class Identify
{
    /**
     * @param $head_img
     * @return string
     * @throws ImageException
     */
    public static function saveHeadImg($head_img)
    {
        if(file_exists('.'.$head_img)){
            return $head_img;
        }
        
        $fileDir = "./tmp/uploads/head_image";
        if(!file_exists($fileDir)){
            mkdir($fileDir,0777,true);
        }
        $fileImg = $fileDir . '/' . md5(microtime(true)).'.jpg';
        //保存图片
        if(!file_put_contents($fileImg, base64_decode($head_img))){
            throw new ImageException([
                'msg' => '保存图片失败',
                'error_code'=> 40001 ,
                'code' =>  403
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg,'.');
    }

    /**
     * @return bool
     * @throws IdentifyException
     * @throws UserException
     */
    public static function resetPassword(){
        $data = Request::instance()->post();
        $uid = Token ::getCurrentUid();
        $user = UserModel::getOneByData(['id'=>$uid],['password']);
        if(!$user){
            throw new UserException();
        }
        if($user['password'] != \IAuth::setPassword($data['oldpassword'])){
            throw new IdentifyException([
                'msg'=>'原密码错误',
                'error_code'=>10014
            ]);
        }
        $pass = \IAuth::setPassword($data['password']);

        $bool = $user->save(['password'=>$pass]);
        if($bool===false){
            throw new IdentifyException([
                'msg'=>'密码修改失败',
                'error_code'=>10013
            ]);
        }
        return true;
    }

    /**
     * 涉及用户信息修改要验证用户是否存在
     * @param $uid
     * @return null|static
     * @throws UserException
     */
    public static function checkUser($uid)
    {
        $user = UserModel::getOneByData(['id'=>$uid]);
        if(!$user){
            throw new UserException();
        }
        return $user;
    }

    public static function isRegistered($email)
    {
        $user = UserModel::get(['e_mail'=>$email]);
        if(!empty($user)){
            if($user->status==0){
                throw new IdentifyException([
                    'msg'=>'账号被禁用或删除，请与管理员联系。',
                    'error_code'=>10007
                ]);
            }

            throw new IdentifyException([
                'msg'=>'已注册用户',
                'error_code'=>10007
            ]);
        }
        
        return $user;
    }
    
    public static function updateUserInfo($uid)
    {
        $data = Request::instance()->post();
        $data = array_filter($data);
        if(!$data){
            throw new IdentifyException([
                'msg'=>'未发现用户更新信息',
                'error_code'=>10017
            ]);
        }

        if(!empty($data['head_img'])){
            $head_img = self::saveHeadImg($data['head_img']);
            $data['head_img'] = $head_img;
        }
        $result = UserModel::update($data,['id'=>$uid]);
        if($result===false){
            throw new IdentifyException([
                'msg'=>'更新用户信息失败',
                'error_code'=>10018
            ]);
        }
        return true;
    }

}