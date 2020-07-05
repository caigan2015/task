<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;


//Login
Route::post('api/:version/user/register', 'api/:version.Token/getToken');
Route::post('api/:version/user/login', 'api/:version.Token/getAppToken');
Route::post('api/:version/token/verify', 'api/:version.Token/verifyToken');

//User
Route::post('api/:version/user/register', 'api/:version.Identify/register');
Route::post('api/:version/user/login', 'api/:version.Identify/login');
Route::get('api/:version/user/logout', 'api/:version.User/logout');
Route::post('api/:version/user/save', 'api/:version.User/updateUser');
//Member
Route::get('api/:version/member/info', 'api/:version.Member/getMember');

//Identify
Route::post('api/:version/identify/code', 'api/:version.Identify/getCode');

//Business
Route::get('api/:version/business/joinus', 'api/:version.Business/getMembership');
//Order
Route::post('api/:version/order/commit', 'api/:version.Order/orderCommit');
Route::post('api/:version/order/cancel', 'api/:version.Order/orderCancel');
Route::post('api/:version/order/close', 'api/:version.Order/orderClose');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');

//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');//微信回调接口不能加?参数1=值1&……
Route::post('api/:version/wxconfig', 'api/:version.Token/getWxConfig');//微信回调接口不能加?参数1=值1&……
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');

//MeepoPS
Route::get('socket/meepops', 'socket/MeepoPS/start');//人机聊天
Route::get('socket/trident', 'socket/Trident/start');//人人聊天

//Feeds
Route::post('api/:version/feeds', 'api/:version.Feeds/createFeeds');

//Competition
Route::get('api/:version/competition/by_member', 'api/:version.Competition/getSummaryForMember');
Route::get('api/:version/team/:id/competitions', 'api/:version.Competition/getSummaryByTeamId',[], ['id'=>'\d+']);
Route::get('api/:version/competition/:id', 'api/:version.Competition/getDetail',[], ['id'=>'\d+']);
Route::get('api/:version/competition/begins', 'api/:version.Competition/getAboutToBegins');
Route::post('api/:version/competition/apply/commit', 'api/:version.Competition/createApply');
Route::post('api/:version/competition/apply/cancel', 'api/:version.Competition/cancelApply');
Route::post('api/:version/competition/video', 'api/:version.Competition/getCompetitionVideos');
Route::post('api/:version/competition/live', 'api/:version.Competition/getCompetitionLives');
Route::post('api/:version/competition/play_notify', 'api/:version.Competition/playNotify');
Route::get('api/:version/competition/online/:id', 'api/:version.Competition/liveOnlineUserNum',[], ['id'=>'\d+']);

//Team
Route::get('api/:version/team/by_user', 'api/:version.Team/getSummaryByUid',[], ['id'=>'\d+']);

//video
Route::get('api/:version/competitionvideo/:id', 'api/:version.competitionVideo/getCompetitionVideo',[], ['id'=>'\d+']);
//live
Route::get('api/:version/competitionlive/:id', 'api/:version.competitionLive/getCompetitionLive',[], ['id'=>'\d+']);
Route::get('api/:version/guest/:id', 'api/:version.competitionLive/getGuestsByLiveId',[], ['id'=>'\d+']);
//search
Route::post('api/:version/competition/play', 'api/:version.Competition/getPlaysBySearch');

//Banner
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner',[], ['id'=>'\d+']);
Route::post('api/:version/banner/by_position', 'api/:version.Banner/getBannersByPosition');

//Config
Route::post('api/:version/config/value', 'api/:version.Config/getValueByCode');

//Test
Route::get('api/:version/test', 'api/:version.Test/index');

//Index

Route::get('index', 'index/Index/index');
Route::get('task/info', 'index/Index/taskInfo');
Route::get('user/login', 'index/Index/login');
Route::get('user/profile', 'index/Index/profile');
Route::get('user/offer/create', 'index/Index/createMyOffer');
Route::get('user/offer/list', 'index/Index/myOfferList');
Route::get('user/offer/info', 'index/Index/myOfferInfo');
Route::get('user/task/list', 'index/Index/myTaskList');
Route::get('task/order', 'index/Index/taskOrder');



