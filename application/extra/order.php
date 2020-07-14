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
    'status'=>[
        '-1'=>'無効',
        '0'=>"両方確認待ち",
        '1'=>"支払い待ち",
        '2'=>"運営方お金を確認",
        '3'=>"タスク済みの確認",
        '4'=>"全額支払い済み確認",
        '5'=>"キャンセル",
    ],
    /*支付方式*/
    'pay_way'=>[
        1 =>"銀行振込",
    ],

    'order_timeout' => 24*3600,
    
];