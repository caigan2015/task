<?php
/**
 * Created by PhpStorm.
 * User: caigan
 * Date: 2017-12-17
 * Time: 18:36
 */
namespace app\admin\behavior;


use app\lib\enum\OrderStatusEnum;
use SMS\SendTemplateSMS;
use think\Db;
use Think\Exception;
use think\Log;

class checkMember
{
    public function run()
    {
        /*$orderM = Db::name('Order');
        $memberM = Db::name('Member');
        $userM = Db::name('User');
        $SendTemplateSMS = new SendTemplateSMS();
        $now = time();
        //会员有效期
        $members = $memberM->where(['status'=>1,'isdelete'=>0,'expire_time'=>['lt',$now],'user_id'=>['neq',0]])->field(['id','cn_name','user_id','mobile','expire_time'])->select();
        if(!empty($members)){
            foreach ($members as $member) {
                $memberM->where(['id'=>$member['id']])->update(['isdelete'=>1,'update_time'=>$now]);
                $user = $userM->where(['id'=>$member['user_id'],'status'=>1,'isdelete'=>0])->field(['id','username','mobile'])->find();
                if(!$user) continue;
                //发短信
                if(!empty($user['mobile']) && preg_match('/^(0|86|17951)?(13[0-9]|15[0-9]|17[0-9]|18[0-9]|14[57]|16[0-9])[0-9]{8}$/',$user['mobile'])){
//                    $content = "您好！尊敬的用户".$user['mobile'].",您的会员资格已过有效期，请您重新进行续费，以免影响我们为您带来的服务。";
                    $expire_time = '('.date('Y-m-d',$member['expire_time']).')';
                    //发送短信
                    try{
                        $SendTemplateSMS->sendTemplateSMS($user['mobile'],array($user['mobile'],$expire_time),235461);//注：测试模板1，只能使用未上线状态的应用进行测试；测试没问题后，你就可以申请自己的短信模板并正式使用了。
                    }catch (Exception $e){
                        Log::write('发送会员效期通知失败：'.$e->getMessage());
                    }
                }
            }
        }

        //订单超时关闭

        $order_timeout = config('order.order_timeout');
        $orders = $orderM->where(['status'=>0,'isdelete'=>0,'create_time'=>['lt',$now-$order_timeout]])->field(['id','order_no','total_price','user_id','business_id','name','status'])->select();
        if(!empty($orders)){
            foreach ($orders as $order) {
                $orderM->where(['id'=>$order['id']])->update(['status'=>OrderStatusEnum::CLOSED,'update_time'=>$now]);
                $o_user = $userM->where(['id'=>$order['user_id'],'status'=>1,'isdelete'=>0])->field(['id','username','mobile'])->find();
                if(!$o_user) continue;
                //发短信
                if(!empty($o_user['mobile']) && preg_match('/^(0|86|17951)?(13[0-9]|15[0-9]|17[0-9]|18[0-9]|14[57]|16[0-9])[0-9]{8}$/',$o_user['mobile'])){
//                    $o_content = "您好！尊敬的".$o_user['mobile']."用户,您在タスク下的订单".$order['order_no']."因超过24小时未付款，系统自动取消。如有疑问请致电服务热线 ：020-83031318";
                    //发送短信
                    try{
                        $SendTemplateSMS->sendTemplateSMS($o_user['mobile'],array($o_user['mobile'],$order['order_no'],config('site.contact')),235128);//注：测试模板1，只能使用未上线状态的应用进行测试；测试没问题后，你就可以申请自己的短信模板并正式使用了。
                    }catch (Exception $e){
                        Log::write('发送支付超时通知失败：'.$e->getMessage());
                    }
                }
            }
        }*/
    }
}