<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Member as MemberModel;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\api\model\UserVers;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\QuarterException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Log;
use think\Request;

class Identify
{
    /**保存图片
     * @param $head_img
     * @return mixed
     * @throws ImageException
     */
    public static function saveHeadImg($head_img)
    {
        if(file_exists('.'.$head_img)){
            return $head_img;
        }
        
        $fileDir = "./tmp/uploads/".date('Ymd');
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
     * 保存验证码
     * @param $phone
     * @param $code
     * @throws IdentifyException
     */
    public static function saveCode($phone,$code)
    {
        self::isResend($phone);
        $res = (new UserVers())->save(['phone'=>$phone,'code'=>$code]);
        if(!$res){
            throw new IdentifyException([
                'msg'=>'生成验证码失败!',
                'error_code' => 10011
            ]);
        }
    }

    /**
     * 是否超时
     * @param $phone
     * @throws IdentifyException
     */
    public static function isResend($phone)
    {
        $time = UserVers::getByPhone($phone,'create_time');
        if(!empty($time) && ($time+60>time())){
            throw new IdentifyException([
                'msg'=>'手机验证码已经发到你手机，请不要重复发送!',
                'error_code' => 10010
            ]);
        }
    }

    public static function modifyPassword(){
        $data = Request::instance()->post();
        $uid = Token ::getCurrentUid();
        $user = UserModel::getOneByData(['id'=>$uid],['password','hx_account','mobile','hx_pass']);
        if(!$user){
            throw new UserException();
        }
        if(empty($user['password']) || ($user['password'] != \IAuth::setPassword($data['oldpassword']))){
            throw new IdentifyException([
                'msg'=>'原密码错误',
                'error_code'=>10014
            ]);
        }
        $pass = \IAuth::setPassword($data['password']);
        $hx_pass = self::hxSavePass($user->hx_account,$pass);

        $bool = $user->save(['password'=>$pass,'hx_pass'=>$hx_pass]);
        if($bool===false){
            throw new IdentifyException([
                'msg'=>'密码修改失败',
                'error_code'=>10013
            ]);
        }
    }

    public static function forgetPassword()
    {
        $data = Request::instance()->post();
        $user = User::getOneByData(['mobile'=>$data['mobile']],['id','password','hx_account','mobile']);
        if(!$user){
            throw new UserException();
        }

        $pass = \IAuth::setPassword($data['password']);
        $hx_pass = self::hxSavePass($user->hx_account,$pass);

        $bool = $user->save(['password'=>$pass,'hx_pass'=>$hx_pass]);
        if($bool===false){
            throw new IdentifyException([
                'msg'=>'重置密码失败',
                'error_code'=>10013
            ]);
        }

        self::hxSavePass($user->hx_account,$user->password);
    }
    

    public static function changeMobile()
    {
        $data = Request::instance()->post();
        $uid = Token ::getCurrentUid();
        $user = User::getOneByData(['id'=>$uid],['mobile','hx_account','rank_type','hx_nickname','hx_pass','house_id','password']);
        if(!$user){
            throw new UserException();
        }
        if($user->mobile != $data['mobile']){
            throw new IdentifyException([
                'msg'=>'原手机号码不正确',
                'error_code'=>10006
            ]);
        }

        $bool = UserModel::update(['mobile'=>$data['newmobile']],['id'=>$uid]);
        if($bool===false){
            throw new IdentifyException([
                'msg'=>'修改手机号码失败',
                'error_code'=>10000
            ]);
        }
        self::hxChangeUser($user,$data['newmobile']);
    }
    

    public static function uploadImage($img,$from=1)
    {
        $fileDir = "./tmp/uploads/".date('Ymd');
        if(!file_exists($fileDir)){
            mkdir($fileDir,0777,true);
        }
        $file = $fileDir . '/' . md5(microtime(true)).'.jpg';
        $img_decode = base64_decode($img);
        //保存图片
        if(!file_put_contents($file, $img_decode)){
            throw new ImageException([
                'msg' => '上传图片失败',
                'error_code'=> 40001 ,
                'code' =>  403
            ]);
        }
        //缩略图
//        $result = Image::open($file)->thumb(100, 100)->save($pic);
        return self::saveFile($file,$from);
    }
    public static function saveFile($file,$from)
    {
        $data = [
            'cate'     => 1,
            'name'     => ltrim($file,'.'),
            'type'     => 'image/jpeg',
            'size'     => filesize($file),
            'from'    => $from,
            'mtime'    => time(),
        ];
        $result = File::create($data);
        if(!$result){
            throw new ImageException([
                'msg' => '保存图片失败',
                'error_code'=> 40001 ,
                'code' =>  403
            ]);
        }
        return $result;
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
        $user = User::get(['e_mail'=>$email]);
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
        self::checkAuditUser($uid);
        $data = Request::instance()->post();
        $data = array_filter($data);
        if(!$data){
            throw new IdentifyException([
                'msg'=>'未发现用户更新信息',
                'error_code'=>10017
            ]);
        }
        if(!empty($data['house_id'])){
            $data['property_id'] = self::checkPropertyByQuarterId($data['house_id']);
        }
        if(!empty($data['head_img'])){
            $result = self::uploadImage($data['head_img']);
            $data['head_img'] = $result->name;
            $data['image_id'] = $result->id;
        }
        $result = UserModel::update($data,['id'=>$uid]);
        if($result===false){
            throw new IdentifyException([
                'msg'=>'更新用户信息失败',
                'error_code'=>10018
            ]);
        }
    }


public static function hxRegister($user)
    {
        $data['username'] = $user->mobile;
        $data['password'] = md5($user->password);
        $data['nickname'] = self::getHxNickname($user->house_id,$user->rank_type,$user->mobile);
        $option = config('hx');
        $hx = new \Huanxin($option);
        if($hx->userDetails($data['username'])){
            $hx->deleteUser($data['username']);
        }
        $res = $hx->accreditRegister($data);
        $res = json_decode($res,true);
        if(!empty($res['entities'])){
            $user->save(['hx_account'=>$data['username'],'hx_nickname'=>$data['nickname'],'hx_pass'=>$data['password']]);
            self::addFriends($user);
        }else{
            Log::write('添加账号'.$user->mobile.'失败:'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
        }

        return $user;
    }

    public static function hxSavePass($hx_account,$newpass)
    {
        $data['username'] = $hx_account;
        $data['newpassword'] = md5($newpass);
        $option = config('hx');
        $hx = new \Huanxin($option);
        $res = $hx->editPassword($data);
        $res = json_decode($res,true);
        if(isset($res['error'])){
            Log::write('修改密码'.$hx_account.'失败：'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
            $data['newpassword'] = '';
        }
        return $data['newpassword'];
    }
    
    public static function hxSaveNickName($hx_account,$house_id,$rank_type)
    {
        $data['nickname'] = self::getHxNickname($house_id,$rank_type,$hx_account);
        $data['username'] = $hx_account;
        $option = config('hx');
        $hx = new \Huanxin($option);
        $res = $hx->editPassword($data);
        $res = json_decode($res,true);
        if(empty($res['entities'])){
            Log::write('修改用户昵称'.$hx_account.'失败：'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
            $data['nickname'] = '';
        }
        return $data['nickname'];
    }

    public static function hxChangeUser($user,$newusername)
    {
        $option = config('hx');
        $hx = new \Huanxin($option);
        $res = $hx->deleteUser($user->hx_account);
        $res = json_decode($res,true);
        if(empty($res['entities'])){
            Log::write('删除账号'.$user->hx_account.'失败：'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
        }
        $data['username'] = $newusername;
        $data['password'] = md5($user->password);
        $data['nickname'] = $user->hx_nickname?$user->hx_nickname:(self::getHxNickname($user->house_id,$user->rank_type,$newusername));
        $rsl = $hx->accreditRegister($data);
        $rsl = json_decode($rsl,true);
        if(!empty($rsl['entities'])){
            $user->save(['hx_account'=>$data['username'],'hx_nickname'=>$data['nickname'],'hx_pass'=>$data['password']]);
        }else{
            Log::write('添加环信账号'.$newusername.'失败：'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
        }

    }

    public static function addFriends($curr_user)
    {
        $quarter_id = Quarter::getTopOne($curr_user->house_id)->id;
        $house_ids = Quarter::getChildrenById($quarter_id);
        $data['house_id'] = ['in',$house_ids];
        $data['id'] = ['neq',$curr_user->id];
        $users = User::getAllByData($data,['id','hx_account']);
        if(!empty($users)){
            $option = config('hx');
            $hx = new \Huanxin($option);
            foreach ($users as $user) {
                if(!empty($user->hx_account)){
                    $res = $hx->addFriend($curr_user->hx_account,$user->hx_account);
                    $res = json_decode($res,true);
                    if(!isset($res['entities'])){
                        Log::write('用户'.$curr_user->username.'添加好友'.$user->hx_account.'失败：'.(!empty($res['error'])?$res['error']:'环信服务器出错'));
                    }
                }
            }
        }
        
    }

    public static function checkPropertyByQuarterId($quarter_id)
    {
        $property_id =  Quarter::getDataValue(['id'=>$quarter_id],'property_id');
        if(empty($property_id)){
            throw new QuarterException([
                'msg'=> '住址所在的物业公司不存在',
                'error_code'=>'10019'
            ]);
        }
        return $property_id;
    }

    protected static function getHxNickname($house_id,$rank_type,$mobile)
    {
        $type = config('app.rank_type');
        return Quarter::getCodeBreads($house_id).(!empty($type[$rank_type])?'('.$type[$rank_type].')':'');
    }

    public static function checkAuditUser($uid)
    {
        $user = self::checkUser($uid);
        $audit = $user->isaudit;
        if($audit!=1){
            switch ($audit){
                case 0:
                $msg = '您好！您的审核正在进行中，请耐心等待。';
                    break;
                case 2:
                $msg = '对不起！您的审核没有通过，请与管理员联系。';
                    break;
                default:
                    $msg = '系统繁忙，请稍后再试。';
            }
            throw new IdentifyException([
                'msg'=> $msg,
                'error_code' => 10020
            ]);
        }
        return $user;
    }

    public static function getFriends($user)
    {
        $data['id'] = ['neq',$user->id];
        $quarter_id = Quarter::getTopOne($user->house_id)->id;
        $data['house_id'] = ['in',Quarter::getChildrenById($quarter_id)];
        $keywords= Request::instance()->post('keywords');
        if(!empty($keywords)){
            $data['hx_account|hx_nickname'] = ['like','%'.$keywords.'%'];
        }
        $users = UserModel::getAllByData($data,['hx_account','hx_nickname']);
        if($users->isEmpty()){
            throw new UserException([
                'msg'=>'好友不存在或被禁用。',
                'error'=>10021
            ]);
        }
        return $users;
    }
}