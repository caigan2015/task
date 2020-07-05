<?php
//配置文件
return [
    // 默认输出类型
    'default_return_type'    => 'json',
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => 'htmlentities',
    // 路由使用完整匹配
    'route_complete_match'   => true,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '\app\lib\exception\ExceptionHandler',

    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        // 关闭自动记录日志，请将type设置为test
//        'type'  => 'test',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'console',
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    'default_offer_image' => '/static/index/image/default_offer_image.png'
];