<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 2:56
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Contact as ContactModel;
use app\api\model\Quarter;
use app\api\service\Identify as IdentifyService;
use app\api\service\Token as TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\PagingParameter;
use app\lib\exception\ContactException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\SuccessReturn;
use think\Exception;
use think\Request;

class Contact extends BaseController
{
    public function getContacts()
    {
        $uid = TokenService::getCurrentUid();
        $user = IdentifyService::checkUser($uid);
        $quarter = Quarter::getTopOne($user->house_id,['id','name','pid','property_id']);
        $data['property_id'] = $quarter->property_id;
        $data['quarter_id'] = $quarter->id;
        $contacts = ContactModel::getSummary($data);
        if($contacts->isEmpty()){
            throw new ContactException();
        }
        $depts = config('app.dept_type');
        $list = [];
        foreach ($depts as $key=>$dept) {
            $tmp = [];
            $tmp['dept_type'] = $key;
            $tmp['dept_type_text'] = $dept;
            $tmp['list'] = [];
            foreach ($contacts as $contact) {
                if(!empty($contact->dept_type) && ($contact->dept_type == $key)){
                    unset($contact['dept_type']);
                    $tmp['list'][] = $contact;
                }
            }
            $list[] = $tmp;
        }

        return new SuccessReturn([
            'info'=>$list
        ]);
//        return $list;
    }

}