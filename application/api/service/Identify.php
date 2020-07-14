<?php

namespace app\api\service;

use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
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
        if (file_exists('.' . $head_img)) {
            return $head_img;
        }

        $fileDir = "./tmp/uploads/head_image";
        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }
        $fileImg = $fileDir . '/' . md5(microtime(true)) . '.jpg';
        //保存图片
        if (!file_put_contents($fileImg, base64_decode($head_img))) {
            throw new ImageException([
                'msg' => '画像を保存できませんでした',
                'error_code' => 40001,
            ]);
        }
        //缩略图
//        $result = Image::open($fileImg)->thumb(100, 100)->save($pic);
        return ltrim($fileImg, '.');
    }

    /**
     * @return bool
     * @throws IdentifyException
     * @throws UserException
     */
    public static function resetPassword()
    {
        $data = Request::instance()->post();
        $uid = Token::getCurrentUid();
        $user = UserModel::getOneByData(['id' => $uid], ['password']);
        if (!$user) {
            throw new UserException();
        }
        if ($user->password != \IAuth::setPassword($data['oldpassword'])) {
            throw new IdentifyException([
                'msg' => '元のパスワードが間違っている',
                'error_code' => 10010
            ]);
        }
        $pass = \IAuth::setPassword($data['password']);
        $bool = $user->save(['password' => $pass]);
        if ($bool === false) {
            throw new IdentifyException([
                'msg' => 'パスワードの変更に失敗しました',
                'error_code' => 10011
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
        $user = UserModel::getOneByData(['id' => $uid]);
        if (!$user) {
            throw new UserException();
        }
        return $user;
    }

    /**
     * @param $email
     * @return null|static
     * @throws IdentifyException
     */
    public static function isRegistered($email)
    {
        $user = UserModel::get(['e_mail' => $email]);
        if (!empty($user)) {
            if ($user->status == 0) {
                throw new IdentifyException([
                    'msg' => 'アカウントが無効になっているか削除されています。管理者に連絡してください。',
                    'error_code' => 10001
                ]);
            }

            if ($user->status == 2) {
                throw new IdentifyException([
                    'msg' => 'ユーザーが登録しました。メールボックスに移動して確認してください',
                    'error_code' => 10002
                ]);
            }
            throw new IdentifyException([
                'msg' => 'ユーザーはすでに登録されています',
                'error_code' => 10003
            ]);
        }

        return $user;
    }

    /**
     * @param $uid
     * @return bool
     * @throws IdentifyException
     */
    public static function updateUserInfo($uid)
    {
        $data = Request::instance()->post();
        $data = array_filter($data);
        if (!$data) {
            throw new IdentifyException([
                'msg' => 'ユーザー更新情報が見つかりません',
                'error_code' => 10012
            ]);
        }

        if (!empty($data['head_img'])) {
            $head_img = self::saveHeadImg($data['head_img']);
            $data['head_img'] = $head_img;
        }
        $result = UserModel::update($data, ['id' => $uid]);
        if ($result === false) {
            throw new IdentifyException([
                'msg' => 'ユーザー情報を更新できませんでした',
                'error_code' => 10013
            ]);
        }
        return true;
    }

}