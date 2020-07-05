<?php

namespace app\api\model;

class Offer extends BaseModel
{

    public static function getSummary($data, $field = [], $paginate = true, $page = 1, $size = 30)
    {
        $query = self::where($data)->where(['status' => 1])->order(['create_time' => 'desc'])->field($field);
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
        return self::where($data)->where(['status' => 1])->field($field)->find();
    }

}
