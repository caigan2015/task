<?php

namespace app\api\model;

class Offer extends BaseModel
{

    public static function getSummary($data, $field = [], $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['status' => 1])->order(['create_time' => 'desc'])->with(['category','user'])->field($field);
        if (!$paginate) {
            return $query->select();
        } else {
            // paginate 第二参数true表示采用简洁模式，简洁模式不需要查询记录总数
            return $query->paginate(
                $size, false, [
                'page' => $page
            ]);
        }
    }

    public static function getDetail($data, $field = [])
    {
        return self::where($data)->where(['status' => 1])->with(['category','user'])->field($field)->find();
    }

    public function getDescriptionAttr($value)
    {
        return html_entity_decode($value);
    }

    public function getRequestTypeTextAttr($value,$data)
    {
        $request_type = config('app.request_type');
        return !empty($request_type[$data['request_type']]) ? $request_type[$data['request_type']] : '';
    }

    public function category()
    {
        return $this->belongsTo('Category','category_id','id');
    }

    protected function getImageAttr($val)
    {
        return $this->prefixImgUrl($val);
    }
}
