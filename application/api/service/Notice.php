<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\Message;
use app\api\model\Notice as NoticeModel;
use app\api\model\Quarter;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\NoticeException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Notice
{
    public static function getNew()
    {
        $data = Request::instance()->post();
        $uid = Token::getCurrentUid();
        $user = Identify::checkUser($uid);
        $data['quarter_id'] = Quarter::getTopOne($user->house_id)->id;
        $data['property_id'] = $user->property_id;
        $data['issend'] = 1;
        $read_ids = self::getMessages($uid,0);
        $data['id'] = ['in',$read_ids];
        $limit = !empty($data['count'])?$data['count']:config('app.notice_new');
        $notices = NoticeModel::getSummary($data,['id','title','type','summary','content','keywords','send_time','istop'],$limit,false);
        if(!$notices->isEmpty()){
//            throw new NoticeException();
            $notices->append(['type_text']);
        }
        return $notices;
    }

    private static function getMessages($uid,$isread)
    {
        $where['type'] = 3;//公告
        $where['isread'] = $isread;
        $where['userid'] = $uid;
        $notice_ids = Message::getDataColumn($where,'notice_id');
        return $notice_ids;
    }

    public static function checkNotice($data)
    {
        $notice = NoticeModel::getOneByData($data);
        if(!$notice){
            throw new NoticeException() ;
        }
        return $notice;
    }

    public static function saveRead($notice_id,$uid)
    {
        $where = ['type'=>3,'notice_id'=>$notice_id,'userid'=>$uid];
        $message = Message::getOneByData($where);
        if($message){
            $message->save(['isread'=>1]);
        }
    }

    public static function getCondition()
    {
        $data = Request::instance()->post();
        $uid = Token::getCurrentUid();
        $user = Identify::checkUser($uid);
        $data['quarter_id'] = Quarter::getTopOne($user->house_id)->id;
        $data['property_id'] = $user->property_id;
        $data['issend'] = 1;
        if(isset($data['isread']) && ($data['isread']!=='') && in_array($data['isread'],[0,1])) {
            $read_ids = self::getMessages($uid, $data['isread']);
            $data['id'] = ['in',$read_ids];
            unset($data['isread']);
        }
        return $data;
    }
}