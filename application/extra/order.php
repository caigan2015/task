<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author yuan1994 <tianpian0805@gmail.com>
 * @link http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */


return [
    /*支付状态*/
    'pay_status'=>[
        '-1'=>'已关闭',
        '0'=>"待支付",
        '1'=>"已支付",
        '2'=>"已超时",
        '3'=>"退款中",
        '4'=>"已退款",
        '5'=>"已取消",
    ],
    /*支付方式*/
    'pay_way'=>[
        1 =>"微信支付",
        2 =>"支付宝支付",
        3 =>"银联支付",
    ],

    'order_timeout' => 24*3600,
    
];