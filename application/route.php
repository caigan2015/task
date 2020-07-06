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


//User
Route::post('api/:version/user/register', 'api/:version.User/register');
Route::post('api/:version/user/login', 'api/:version.User/login');
Route::get('api/:version/user/logout', 'api/:version.User/logout');
Route::post('api/:version/user/password', 'api/:version.User/resetPassword');
Route::post('api/:version/user/profile', 'api/:version.User/updateProfile');

//offer
Route::post('api/:version/offer/all', 'api/:version.Offer/getOffers');
Route::post('api/:version/offer/:id', 'api/:version.Offer/getDetail',[], ['id'=>'\d+']);
Route::post('api/:version/myoffer/save', 'api/:version.Offer/saveOffer');
Route::post('api/:version/myoffer/all', 'api/:version.Offer/getMyOffers');
Route::post('api/:version/myoffer/:id', 'api/:version.Offer/getMyOfferDetail',[], ['id'=>'\d+']);
Route::post('api/:version/myoffer/cancel', 'api/:version.Offer/cancel');

//Order
Route::post('api/:version/order/commit', 'api/:version.Order/orderCommit');
Route::post('api/:version/order/cancel', 'api/:version.Order/orderCancel');
Route::post('api/:version/order/close', 'api/:version.Order/orderClose');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);
Route::get('api/:version/order/byuser', 'api/:version.Order/getSummaryByUser');
Route::post('api/:version/order/quote', 'api/:version.Order/priceCommit');//見積もり
Route::post('api/:version/order/confirm', 'api/:version.Order/priceConfirm');//確認見積もり
Route::post('api/:version/order/taskdone', 'api/:version.Order/taskDone');//確認見積もり

//Chatting
Route::post('api/:version/chatting/send', 'api/:version.Chatting/sendMessage');
Route::post('api/:version/chatting/byorder', 'api/:version.Chatting/getChattingByOrderId');

////MeepoPS
//Route::get('socket/meepops', 'socket/MeepoPS/start');//人机聊天
//Route::get('socket/trident', 'socket/Trident/start');//人人聊天

//Feeds
Route::post('api/:version/feeds', 'api/:version.Feeds/createFeeds');

//Category
Route::get('api/:version/categories', 'api/:version.Category/getAllCategory');
//Config
Route::get('api/:version/config', 'api/:version.Config/getValueByCode');

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



