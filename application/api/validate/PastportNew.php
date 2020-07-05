<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/23
 * Time: 3:01
 */

namespace app\api\validate;


class PastportNew extends BaseValidate
{
    // 为防止欺骗重写user_id外键
    // rule中严禁使用user_id
    // 获取post参数时过滤掉user_id
    // 所有数据库和user关联的外键统一使用user_id，而不要使用uid
    protected $rule = [
        'id'=>'require|isPositiveInteger',
        'visitor_name|访客姓名' => 'require|length:1,25',
        'sex|访客性别' => 'require|in:0,1,2',
        'enter_way|进入方式' => 'require|number',
        'schedule_time|预约来访时间' => 'require|date|checkTime',
        'has_car|是否驾车' => 'require|in:0,1',
        'plate_number|车牌号码'=>'requireif:has_car,1',
        'ID_card|身份证'=>'requireif:enter_way,2|checkIDCardNo',
        'IC_card|民生卡'=>'requireif:enter_way,3',
        'isvisited'=>'in:0,1'

    ];

    protected $scene = [
        'create'=>['visitor_name','sex','enter_way','schedule_time','has_car','plate_number'],
        'edit'=>['ID_card','IC_card','id','enter_way'],
        'get'=>['isvisited']
    ];

    protected function checkTime($value, $rule='', $data='', $field='')
    {
        if(strtotime($value)<time()){
            return '来访时间必须是未来时间';
        }
        return true;
    }
}