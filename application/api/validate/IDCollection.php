<?php

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    // 千万不要在require | checkIDS中加空格
    // 不然你会哭的
    // 源码中是没有去处多余空格的判断的
    // 这将导致验证不执行
    protected $rule = [

        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'idsパラメーターは、コンマで区切られた複数の正の整数でなければなりません'
    ];

    protected function checkIDs($value)
    {
        $values = explode(',', $value);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                return false;
            }
        }
        return true;
    }

    protected function checkIDs1($value, $rule, $data)
    {
        $result = true;
        $values = explode(',', $value);
        if (empty($values)) {
            $result = false;
        }
        array_walk($values, function ($id) use (&$result) {
            if (!$this->isPositiveInteger($id)) {
                // 必须是正整数
                $result = false;
            }
        });
        return $result;
    }



}