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
    'model_path' => 'common',
    'validate_path' => 'common',
    'base_url' => 'http://www.task.jp',
    'password_key' => 'jiandong',
    //
    'user_type' =>[
        0=>'Worker',
        1=>'Client',
    ],
    'request_type' =>[
        1=>'ASK',
        2=>'TASK',
    ],
    //

    'default_offer_image' => '',
    'ossbrowser_downpath' => 'Docs/oss-browser-win32-x64.zip',
    
    'instanceName' => '',
    'socket_address' => 'websocket://0.0.0.0:20120',
    'token_expire_in' => 7200,
    
];