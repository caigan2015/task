/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ 4:
/***/ (function(module, exports) {

module.exports = {"domain":"http://www.gzjiandongsp.com","webSocketUrl":"ws://www.gzjiandongsp.com:19833","gender_list":[{"name":"保密","value":0,"class":"unknow"},{"name":"男","value":1,"class":"male"},{"name":"女","value":2,"class":"female"}],"emojiData":[{"code":"wx","name":"微笑","path":"emoji/1.gif"},{"code":"pz","name":"撇嘴","path":"emoji/2.gif"},{"code":"se","name":"色","path":"emoji/3.gif"},{"code":"fd","name":"发呆","path":"emoji/4.gif"},{"code":"dy","name":"得意","path":"emoji/5.gif"},{"code":"ll","name":"流泪","path":"emoji/6.gif"},{"code":"hx","name":"害羞","path":"emoji/7.gif"},{"code":"bz","name":"闭嘴","path":"emoji/8.gif"},{"code":"shui","name":"睡","path":"emoji/9.gif"},{"code":"dk","name":"大哭","path":"emoji/10.gif"},{"code":"gg","name":"尴尬","path":"emoji/11.gif"},{"code":"fn","name":"发怒","path":"emoji/12.gif"},{"code":"tp","name":"调皮","path":"emoji/13.gif"},{"code":"cy","name":"呲牙","path":"emoji/14.gif"},{"code":"jy","name":"惊讶","path":"emoji/15.gif"},{"code":"ng","name":"难过","path":"emoji/16.gif"},{"code":"kuk","name":"酷","path":"emoji/17.gif"},{"code":"lengh","name":"冷汗","path":"emoji/18.gif"},{"code":"zk","name":"抓狂","path":"emoji/19.gif"},{"code":"tuu","name":"吐","path":"emoji/20.gif"},{"code":"tx","name":"偷笑","path":"emoji/21.gif"},{"code":"ka","name":"可爱","path":"emoji/22.gif"},{"code":"baiy","name":"白眼","path":"emoji/23.gif"},{"code":"am","name":"傲慢","path":"emoji/24.gif"},{"code":"jie","name":"饥饿","path":"emoji/25.gif"},{"code":"kun","name":"困","path":"emoji/26.gif"},{"code":"jk","name":"惊恐","path":"emoji/27.gif"},{"code":"lh","name":"流汗","path":"emoji/28.gif"},{"code":"hanx","name":"憨笑","path":"emoji/29.gif"},{"code":"db","name":"大兵","path":"emoji/30.gif"},{"code":"fendou","name":"奋斗","path":"emoji/31.gif"},{"code":"zhm","name":"咒骂","path":"emoji/32.gif"},{"code":"yiw","name":"疑问","path":"emoji/33.gif"},{"code":"xu","name":"嘘..","path":"emoji/34.gif"},{"code":"yun","name":"晕","path":"emoji/35.gif"},{"code":"zhem","name":"折磨","path":"emoji/36.gif"},{"code":"shuai","name":"衰","path":"emoji/37.gif"},{"code":"kl","name":"骷髅","path":"emoji/38.gif"},{"code":"qiao","name":"敲打","path":"emoji/39.gif"},{"code":"zj","name":"再见","path":"emoji/40.gif"},{"code":"ch","name":"擦汗","path":"emoji/41.gif"},{"code":"kb","name":"抠鼻","path":"emoji/42.gif"},{"code":"zhem","name":"鼓掌","path":"emoji/43.gif"},{"code":"qd","name":"糗大了","path":"emoji/44.gif"},{"code":"huaix","name":"坏笑","path":"emoji/45.gif"},{"code":"zhh","name":"左哼哼","path":"emoji/46.gif"},{"code":"yhh","name":"右哼哼","path":"emoji/47.gif"},{"code":"hq","name":"哈欠","path":"emoji/48.gif"},{"code":"bs","name":"鄙视","path":"emoji/49.gif"},{"code":"wq","name":"委屈","path":"emoji/50.gif"},{"code":"kk","name":"快哭了","path":"emoji/51.gif"},{"code":"yx","name":"阴险","path":"emoji/52.gif"},{"code":"qq","name":"亲亲","path":"emoji/53.gif"},{"code":"xia","name":"吓","path":"emoji/54.gif"},{"code":"kel","name":"可怜","path":"emoji/55.gif"},{"code":"cd","name":"菜刀","path":"emoji/56.gif"},{"code":"xig","name":"西瓜","path":"emoji/57.gif"},{"code":"pj","name":"啤酒","path":"emoji/58.gif"},{"code":"lq","name":"篮球","path":"emoji/59.gif"},{"code":"pp","name":"乒乓","path":"emoji/60.gif"},{"code":"kf","name":"咖啡","path":"emoji/61.gif"},{"code":"fan","name":"饭","path":"emoji/62.gif"},{"code":"zt","name":"猪头","path":"emoji/63.gif"},{"code":"mg","name":"玫瑰","path":"emoji/64.gif"},{"code":"dx","name":"凋谢","path":"emoji/65.gif"},{"code":"sa","name":"示爱","path":"emoji/66.gif"},{"code":"xin","name":"爱心","path":"emoji/67.gif"},{"code":"xs","name":"心碎","path":"emoji/68.gif"},{"code":"dg","name":"蛋糕","path":"emoji/69.gif"},{"code":"shd","name":"闪电","path":"emoji/70.gif"},{"code":"zhd","name":"炸弹","path":"emoji/71.gif"},{"code":"dao","name":"刀","path":"emoji/72.gif"},{"code":"zq","name":"足球","path":"emoji/73.gif"},{"code":"pch","name":"瓢虫","path":"emoji/74.gif"},{"code":"bb","name":"便便","path":"emoji/75.gif"},{"code":"yl","name":"月亮","path":"emoji/76.gif"},{"code":"ty","name":"太阳","path":"emoji/77.gif"},{"code":"lw","name":"礼物","path":"emoji/78.gif"},{"code":"yb","name":"拥抱","path":"emoji/79.gif"},{"code":"qiang","name":"强","path":"emoji/80.gif"},{"code":"ruo","name":"弱","path":"emoji/81.gif"},{"code":"ws","name":"握手","path":"emoji/82.gif"},{"code":"shl","name":"胜利","path":"emoji/83.gif"},{"code":"bq","name":"抱拳","path":"emoji/84.gif"},{"code":"gy","name":"勾引","path":"emoji/85.gif"},{"code":"qt","name":"拳头","path":"emoji/86.gif"},{"code":"cj","name":"差劲","path":"emoji/87.gif"},{"code":"aini","name":"爱你","path":"emoji/88.gif"},{"code":"bu","name":"NO","path":"emoji/89.gif"},{"code":"hd","name":"OK","path":"emoji/90.gif"},{"code":"aiq","name":"爱情","path":"emoji/91.gif"},{"code":"fw","name":"飞吻","path":"emoji/92.gif"},{"code":"tiao","name":"跳跳","path":"emoji/93.gif"},{"code":"fad","name":"发抖","path":"emoji/94.gif"},{"code":"oh","name":"怄火","path":"emoji/95.gif"},{"code":"zhq","name":"转圈","path":"emoji/96.gif"},{"code":"kt","name":"磕头","path":"emoji/97.gif"},{"code":"ht","name":"回头","path":"emoji/98.gif"},{"code":"tsh","name":"跳绳","path":"emoji/99.gif"},{"code":"hsh","name":"挥手","path":"emoji/100.gif"},{"code":"jd","name":"激动","path":"emoji/101.gif"},{"code":"jw","name":"街舞","path":"emoji/102.gif"},{"code":"xw","name":"献吻","path":"emoji/103.gif"},{"code":"zuotj","name":"左太极","path":"emoji/104.gif"},{"code":"youtj","name":"右太极","path":"emoji/105.gif"},{"code":"shx","name":"双喜","path":"emoji/106.gif"},{"code":"bp","name":"鞭炮","path":"emoji/107.gif"},{"code":"dl","name":"灯笼","path":"emoji/108.gif"},{"code":"fc","name":"发财","path":"emoji/109.gif"},{"code":"kg","name":"K歌","path":"emoji/110.gif"},{"code":"gw","name":"购物","path":"emoji/111.gif"},{"code":"yj","name":"邮件","path":"emoji/112.gif"},{"code":"zshuai","name":"主帅","path":"emoji/113.gif"},{"code":"hec","name":"喝彩","path":"emoji/114.gif"},{"code":"qidao","name":"祈祷","path":"emoji/115.gif"},{"code":"baojin","name":"爆筋","path":"emoji/116.gif"},{"code":"bangbangt","name":"棒棒糖","path":"emoji/117.gif"},{"code":"hn","name":"喝奶","path":"emoji/118.gif"},{"code":"xiam","name":"下面","path":"emoji/119.gif"},{"code":"xiangj","name":"吃蕉","path":"emoji/120.gif"},{"code":"fj","name":"飞机","path":"emoji/121.gif"},{"code":"jiaoc","name":"轿车","path":"emoji/122.gif"},{"code":"zuohc","name":"左火车","path":"emoji/123.gif"},{"code":"chex","name":"车厢","path":"emoji/124.gif"},{"code":"youhc","name":"右火车","path":"emoji/125.gif"},{"code":"dyun","name":"多云","path":"emoji/126.gif"},{"code":"xiayu","name":"下雨","path":"emoji/127.gif"},{"code":"cp","name":"钞票","path":"emoji/128.gif"},{"code":"xm","name":"熊猫","path":"emoji/129.gif"},{"code":"dengp","name":"灯泡","path":"emoji/130.gif"},{"code":"fengc","name":"风车","path":"emoji/131.gif"},{"code":"naoz","name":"闹钟","path":"emoji/132.gif"},{"code":"yus","name":"雨伞","path":"emoji/133.gif"},{"code":"qq","name":"气球","path":"emoji/134.gif"},{"code":"zuanj","name":"钻戒","path":"emoji/135.gif"},{"code":"sf","name":"沙发","path":"emoji/136.gif"},{"code":"zhij","name":"纸巾","path":"emoji/137.gif"},{"code":"yao","name":"药","path":"emoji/138.gif"},{"code":"shq","name":"手枪","path":"emoji/139.gif"},{"code":"qw","name":"青蛙","path":"emoji/140.gif"}],"emojiPath":"/h5/images/","protocol":[{"type":1,"title":"タスク服务协议","code":"service_agreement"},{"type":2,"title":"タスク网视频购买观看协议","code":"purchase_agreement"},{"type":3,"title":"タスク尊享会员服务协议","code":"membership_agreement"}]}

/***/ }),

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _config = __webpack_require__(4);

$(document).ready(function ($) {
    //"protocol":[{"type":1,"title":"タスク服务协议","code":"service_agreement"},{"type":2,"title":"タスク网视频购买观看协议","code":"purchase_agreement"},{"type":3,"title":"タスク尊享会员服务协议","code":"membership_agreement"}],
    var type = $.getParameter("type");
    var code = "";
    var title = "";
    var index = 0;

    for (var i = 0; i < _config.protocol.length; i++) {
        if (type == _config.protocol[i].type) {
            index = i;
            break;
        }
    }
    code = _config.protocol[index].code;
    title = _config.protocol[index].title;

    $._ajax({
        url: domain + "/api/v1/config/value",
        data: {
            code: [code],
            tags: 1
        },
        success: function success(data) {
            document.title = title;
            $("#page-protocol article").html(data[code]);
        }
    });
});

/***/ })

/******/ });
//# sourceMappingURL=protocol.bundle.js.map