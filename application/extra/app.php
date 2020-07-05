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
    //赛事类型
    'race_type' =>[
        1=>'版权私有',
        2=>'公共资源',
    ],
    'banners_position'=>[
        1 => '球员中心',
        2 => '赛事中心',
        3 => '资讯中心',
    ],
    'video_type' =>[
        1 => '回放',
        2 => '集锦',
        3 => '直播',
    ],
    'file_cate' =>[
        1 => '图片',
        2 => '视频',
        3 => '其它',
    ],
    //可报名的赛事距离开始的天数
//    'play_time_days'=> 30,

    'ossbrowser_downpath' => 'Docs/oss-browser-win32-x64.zip',
    
    'instanceName' => '建东直播聊天室',
    'socket_address' => 'websocket://0.0.0.0:20120',
    'token_expire_in' => 7200,
    
];