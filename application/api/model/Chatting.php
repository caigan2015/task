<?php

namespace app\api\model;

class Chatting extends BaseModel
{

    public static function getSummary($data,$field=[])
    {
        return self::where($data)->order(['create_time' => 'desc'])->field($field)->with(['user'])->select();
    }

    public function orderChatting()
    {
        return $this->belongsTo('Order','order_id','id');
    }

    public function getContentAttr($value)
    {
        return html_entity_decode($value);
    }

    protected function getFileAttr($val)
    {
        return $this->prefixImgUrl($val);
    }
}
