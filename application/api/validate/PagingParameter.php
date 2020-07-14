<?php


namespace app\api\validate;


class PagingParameter extends BaseValidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => 'ページングパラメータは正の整数でなければなりません',
        'size' => 'ページングパラメータは正の整数でなければなりません'
    ];
}