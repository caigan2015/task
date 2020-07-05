<?php

return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    // 小程序app_id
    'app_id' => 'wxba58edcce1726b50',
    // 小程序app_secret
    'app_secret' => '887de394fad4c896ca6db52f15a5e5d8',

    // 微信使用code换取用户openid及session_key的url地址
        //公众号URL
    'gzh_login_url' => "https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code",
        //小程序URL
    'xcx_login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

        //获取用户信息的url地址些access_token与下面基础的access_token不一样
    'userinfo_url' =>"https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN",
    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",

    'wx_connect_url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect',


];
