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
/******/ 	return __webpack_require__(__webpack_require__.s = 54);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1,eval)("this");
} catch(e) {
	// This works if the window reference is available
	if(typeof window === "object")
		g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = __webpack_require__(2);

/***/ }),

/***/ 11:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _config = __webpack_require__(4);

var runtime = __webpack_require__(1);


//  "gender_list":  [{ "name": "保密", "value": 0, "class": "unknow" }, { "name": "男", "value": 1, "class": "male" }, { "name": "女", "value": 2, "class": "female" }]
runtime.gender2class = function (value) {
    var name = _config.gender_list[0].class;
    for (var i = 0; i < _config.gender_list.length; i++) {
        if (value === _config.gender_list[i].name) {
            name = _config.gender_list[i].class;
        }
    }
    return name;
};
runtime.timestamp2datetime = function (timestamp) {
    if (timestamp === "" || timestamp === null || timestamp === undefined) {
        return "未知时间";
    }
    var temp = new Date(timestamp * 1000);
    return temp.format("yyyy-MM-dd hh:mm");
};

module.exports = runtime;

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

/*! art-template@runtime | https://github.com/aui/art-template */

var detectNode = __webpack_require__(3);
var runtime = Object.create(detectNode ? global : window);
var ESCAPE_REG = /["&'<>]/;

/**
 * 编码模板输出的内容
 * @param  {any}        content
 * @return {string}
 */
runtime.$escape = function (content) {
    return xmlEscape(toString(content));
};

/**
 * 迭代器，支持数组与对象
 * @param {array|Object} data 
 * @param {function}     callback 
 */
runtime.$each = function (data, callback) {
    if (Array.isArray(data)) {
        for (var i = 0, len = data.length; i < len; i++) {
            callback(data[i], i);
        }
    } else {
        for (var _i in data) {
            callback(data[_i], _i);
        }
    }
};

// 将目标转成字符
function toString(value) {
    if (typeof value !== 'string') {
        if (value === undefined || value === null) {
            value = '';
        } else if (typeof value === 'function') {
            value = toString(value.call(value));
        } else {
            value = JSON.stringify(value);
        }
    }

    return value;
};

// 编码 HTML 内容
function xmlEscape(content) {
    var html = '' + content;
    var regexResult = ESCAPE_REG.exec(html);
    if (!regexResult) {
        return content;
    }

    var result = '';
    var i = void 0,
        lastIndex = void 0,
        char = void 0;
    for (i = regexResult.index, lastIndex = 0; i < html.length; i++) {

        switch (html.charCodeAt(i)) {
            case 34:
                char = '&#34;';
                break;
            case 38:
                char = '&#38;';
                break;
            case 39:
                char = '&#39;';
                break;
            case 60:
                char = '&#60;';
                break;
            case 62:
                char = '&#62;';
                break;
            default:
                continue;
        }

        if (lastIndex !== i) {
            result += html.substring(lastIndex, i);
        }

        lastIndex = i + 1;
        result += char;
    }

    if (lastIndex !== i) {
        return result + html.substring(lastIndex, i);
    } else {
        return result;
    }
};

module.exports = runtime;
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ }),

/***/ 3:
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {module.exports = false;

// Only Node.JS has a process variable that is of [[Class]] process
try {
 module.exports = Object.prototype.toString.call(global.process) === '[object process]' 
} catch(e) {}

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(0)))

/***/ }),

/***/ 4:
/***/ (function(module, exports) {

module.exports = {"domain":"http://www.gzjiandongsp.com","webSocketUrl":"ws://www.gzjiandongsp.com:19833","gender_list":[{"name":"保密","value":0,"class":"unknow"},{"name":"男","value":1,"class":"male"},{"name":"女","value":2,"class":"female"}],"emojiData":[{"code":"wx","name":"微笑","path":"emoji/1.gif"},{"code":"pz","name":"撇嘴","path":"emoji/2.gif"},{"code":"se","name":"色","path":"emoji/3.gif"},{"code":"fd","name":"发呆","path":"emoji/4.gif"},{"code":"dy","name":"得意","path":"emoji/5.gif"},{"code":"ll","name":"流泪","path":"emoji/6.gif"},{"code":"hx","name":"害羞","path":"emoji/7.gif"},{"code":"bz","name":"闭嘴","path":"emoji/8.gif"},{"code":"shui","name":"睡","path":"emoji/9.gif"},{"code":"dk","name":"大哭","path":"emoji/10.gif"},{"code":"gg","name":"尴尬","path":"emoji/11.gif"},{"code":"fn","name":"发怒","path":"emoji/12.gif"},{"code":"tp","name":"调皮","path":"emoji/13.gif"},{"code":"cy","name":"呲牙","path":"emoji/14.gif"},{"code":"jy","name":"惊讶","path":"emoji/15.gif"},{"code":"ng","name":"难过","path":"emoji/16.gif"},{"code":"kuk","name":"酷","path":"emoji/17.gif"},{"code":"lengh","name":"冷汗","path":"emoji/18.gif"},{"code":"zk","name":"抓狂","path":"emoji/19.gif"},{"code":"tuu","name":"吐","path":"emoji/20.gif"},{"code":"tx","name":"偷笑","path":"emoji/21.gif"},{"code":"ka","name":"可爱","path":"emoji/22.gif"},{"code":"baiy","name":"白眼","path":"emoji/23.gif"},{"code":"am","name":"傲慢","path":"emoji/24.gif"},{"code":"jie","name":"饥饿","path":"emoji/25.gif"},{"code":"kun","name":"困","path":"emoji/26.gif"},{"code":"jk","name":"惊恐","path":"emoji/27.gif"},{"code":"lh","name":"流汗","path":"emoji/28.gif"},{"code":"hanx","name":"憨笑","path":"emoji/29.gif"},{"code":"db","name":"大兵","path":"emoji/30.gif"},{"code":"fendou","name":"奋斗","path":"emoji/31.gif"},{"code":"zhm","name":"咒骂","path":"emoji/32.gif"},{"code":"yiw","name":"疑问","path":"emoji/33.gif"},{"code":"xu","name":"嘘..","path":"emoji/34.gif"},{"code":"yun","name":"晕","path":"emoji/35.gif"},{"code":"zhem","name":"折磨","path":"emoji/36.gif"},{"code":"shuai","name":"衰","path":"emoji/37.gif"},{"code":"kl","name":"骷髅","path":"emoji/38.gif"},{"code":"qiao","name":"敲打","path":"emoji/39.gif"},{"code":"zj","name":"再见","path":"emoji/40.gif"},{"code":"ch","name":"擦汗","path":"emoji/41.gif"},{"code":"kb","name":"抠鼻","path":"emoji/42.gif"},{"code":"zhem","name":"鼓掌","path":"emoji/43.gif"},{"code":"qd","name":"糗大了","path":"emoji/44.gif"},{"code":"huaix","name":"坏笑","path":"emoji/45.gif"},{"code":"zhh","name":"左哼哼","path":"emoji/46.gif"},{"code":"yhh","name":"右哼哼","path":"emoji/47.gif"},{"code":"hq","name":"哈欠","path":"emoji/48.gif"},{"code":"bs","name":"鄙视","path":"emoji/49.gif"},{"code":"wq","name":"委屈","path":"emoji/50.gif"},{"code":"kk","name":"快哭了","path":"emoji/51.gif"},{"code":"yx","name":"阴险","path":"emoji/52.gif"},{"code":"qq","name":"亲亲","path":"emoji/53.gif"},{"code":"xia","name":"吓","path":"emoji/54.gif"},{"code":"kel","name":"可怜","path":"emoji/55.gif"},{"code":"cd","name":"菜刀","path":"emoji/56.gif"},{"code":"xig","name":"西瓜","path":"emoji/57.gif"},{"code":"pj","name":"啤酒","path":"emoji/58.gif"},{"code":"lq","name":"篮球","path":"emoji/59.gif"},{"code":"pp","name":"乒乓","path":"emoji/60.gif"},{"code":"kf","name":"咖啡","path":"emoji/61.gif"},{"code":"fan","name":"饭","path":"emoji/62.gif"},{"code":"zt","name":"猪头","path":"emoji/63.gif"},{"code":"mg","name":"玫瑰","path":"emoji/64.gif"},{"code":"dx","name":"凋谢","path":"emoji/65.gif"},{"code":"sa","name":"示爱","path":"emoji/66.gif"},{"code":"xin","name":"爱心","path":"emoji/67.gif"},{"code":"xs","name":"心碎","path":"emoji/68.gif"},{"code":"dg","name":"蛋糕","path":"emoji/69.gif"},{"code":"shd","name":"闪电","path":"emoji/70.gif"},{"code":"zhd","name":"炸弹","path":"emoji/71.gif"},{"code":"dao","name":"刀","path":"emoji/72.gif"},{"code":"zq","name":"足球","path":"emoji/73.gif"},{"code":"pch","name":"瓢虫","path":"emoji/74.gif"},{"code":"bb","name":"便便","path":"emoji/75.gif"},{"code":"yl","name":"月亮","path":"emoji/76.gif"},{"code":"ty","name":"太阳","path":"emoji/77.gif"},{"code":"lw","name":"礼物","path":"emoji/78.gif"},{"code":"yb","name":"拥抱","path":"emoji/79.gif"},{"code":"qiang","name":"强","path":"emoji/80.gif"},{"code":"ruo","name":"弱","path":"emoji/81.gif"},{"code":"ws","name":"握手","path":"emoji/82.gif"},{"code":"shl","name":"胜利","path":"emoji/83.gif"},{"code":"bq","name":"抱拳","path":"emoji/84.gif"},{"code":"gy","name":"勾引","path":"emoji/85.gif"},{"code":"qt","name":"拳头","path":"emoji/86.gif"},{"code":"cj","name":"差劲","path":"emoji/87.gif"},{"code":"aini","name":"爱你","path":"emoji/88.gif"},{"code":"bu","name":"NO","path":"emoji/89.gif"},{"code":"hd","name":"OK","path":"emoji/90.gif"},{"code":"aiq","name":"爱情","path":"emoji/91.gif"},{"code":"fw","name":"飞吻","path":"emoji/92.gif"},{"code":"tiao","name":"跳跳","path":"emoji/93.gif"},{"code":"fad","name":"发抖","path":"emoji/94.gif"},{"code":"oh","name":"怄火","path":"emoji/95.gif"},{"code":"zhq","name":"转圈","path":"emoji/96.gif"},{"code":"kt","name":"磕头","path":"emoji/97.gif"},{"code":"ht","name":"回头","path":"emoji/98.gif"},{"code":"tsh","name":"跳绳","path":"emoji/99.gif"},{"code":"hsh","name":"挥手","path":"emoji/100.gif"},{"code":"jd","name":"激动","path":"emoji/101.gif"},{"code":"jw","name":"街舞","path":"emoji/102.gif"},{"code":"xw","name":"献吻","path":"emoji/103.gif"},{"code":"zuotj","name":"左太极","path":"emoji/104.gif"},{"code":"youtj","name":"右太极","path":"emoji/105.gif"},{"code":"shx","name":"双喜","path":"emoji/106.gif"},{"code":"bp","name":"鞭炮","path":"emoji/107.gif"},{"code":"dl","name":"灯笼","path":"emoji/108.gif"},{"code":"fc","name":"发财","path":"emoji/109.gif"},{"code":"kg","name":"K歌","path":"emoji/110.gif"},{"code":"gw","name":"购物","path":"emoji/111.gif"},{"code":"yj","name":"邮件","path":"emoji/112.gif"},{"code":"zshuai","name":"主帅","path":"emoji/113.gif"},{"code":"hec","name":"喝彩","path":"emoji/114.gif"},{"code":"qidao","name":"祈祷","path":"emoji/115.gif"},{"code":"baojin","name":"爆筋","path":"emoji/116.gif"},{"code":"bangbangt","name":"棒棒糖","path":"emoji/117.gif"},{"code":"hn","name":"喝奶","path":"emoji/118.gif"},{"code":"xiam","name":"下面","path":"emoji/119.gif"},{"code":"xiangj","name":"吃蕉","path":"emoji/120.gif"},{"code":"fj","name":"飞机","path":"emoji/121.gif"},{"code":"jiaoc","name":"轿车","path":"emoji/122.gif"},{"code":"zuohc","name":"左火车","path":"emoji/123.gif"},{"code":"chex","name":"车厢","path":"emoji/124.gif"},{"code":"youhc","name":"右火车","path":"emoji/125.gif"},{"code":"dyun","name":"多云","path":"emoji/126.gif"},{"code":"xiayu","name":"下雨","path":"emoji/127.gif"},{"code":"cp","name":"钞票","path":"emoji/128.gif"},{"code":"xm","name":"熊猫","path":"emoji/129.gif"},{"code":"dengp","name":"灯泡","path":"emoji/130.gif"},{"code":"fengc","name":"风车","path":"emoji/131.gif"},{"code":"naoz","name":"闹钟","path":"emoji/132.gif"},{"code":"yus","name":"雨伞","path":"emoji/133.gif"},{"code":"qq","name":"气球","path":"emoji/134.gif"},{"code":"zuanj","name":"钻戒","path":"emoji/135.gif"},{"code":"sf","name":"沙发","path":"emoji/136.gif"},{"code":"zhij","name":"纸巾","path":"emoji/137.gif"},{"code":"yao","name":"药","path":"emoji/138.gif"},{"code":"shq","name":"手枪","path":"emoji/139.gif"},{"code":"qw","name":"青蛙","path":"emoji/140.gif"}],"emojiPath":"/h5/images/","protocol":[{"type":1,"title":"タスク服务协议","code":"service_agreement"},{"type":2,"title":"タスク网视频购买观看协议","code":"purchase_agreement"},{"type":3,"title":"タスク尊享会员服务协议","code":"membership_agreement"}]}

/***/ }),

/***/ 54:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(11);

var template = __webpack_require__(55);

$(document).ready(function ($) {
    var buttons = [{
        text: "去开通",
        onClick: function onClick() {
            location.href = "vip.html";
        }
    }, {
        text: "返回",
        onClick: function onClick() {
            history.back();
        }
    }];
    if (!hasMobile) {
        buttons.splice(1, 0, {
            text: "绑定手机",
            onClick: function onClick() {
                location.href = "bind.html";
            }
        });
    }
    if (!is_member) {
        $.modal({
            text: "您目前还不是建东会员，暂无球员信息",
            buttons: buttons
        });
        return false;
    }

    $._ajax({
        type: "get",
        url: domain + "/api/v1/member/info",
        success: function success(data) {
            console.log(data);
            $("#page-player-info").html(template(data));
        }
    });
});

/***/ }),

/***/ 55:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $escape = $imports.$escape, photo = $data.photo, cn_name = $data.cn_name, sex = $data.sex, age = $data.age, birthday = $data.birthday, stature = $data.stature, weight = $data.weight, native_place = $data.native_place, nation = $data.nation, position = $data.position, order_id = $data.order_id, school = $data.school, individual = $data.individual, experience = $data.experience, feature = $data.feature, honor = $data.honor, comment = $data.comment;
    $$out += '<div class="weui-cells">\r\n    <div class="weui-media-box weui-media-box_appmsg">\r\n        <div class="weui-media-box__hd">\r\n            <span class="weui-media-box__thumb" style="background-image: url(';
    $$out += $escape(photo);
    $$out += ');">\r\n            </div>\r\n            <div class="weui-media-box__bd">\r\n              <h4 class="weui-media-box__title">';
    $$out += $escape(cn_name);
    $$out += ' <i class="icon-';
    $$out += $escape($imports.gender2class(sex));
    $$out += '"></i></h4>\r\n              <ul class="weui-media-box__info">\r\n               <li class="weui-media-box__info__meta">年龄\uFF1A';
    if (age !== 0) {
        $$out += $escape(age);
        $$out += '岁';
    } else {
        $$out += '-';
    }
    $$out += '</li> \r\n<!--                 ';
    if (birthday !== '') {
        $$out += '<li class="weui-media-box__info__meta">';
        $$out += $escape(birthday);
        $$out += '</li>';
    }
    $$out += ' -->\r\n            </ul>\r\n            <ul class="weui-media-box__info">\r\n             <li class="weui-media-box__info__meta">身高\uFF1A';
    if (stature !== '0') {
        $$out += $escape(stature);
        $$out += 'cm';
    } else {
        $$out += '-';
    }
    $$out += '</li>\r\n             <!--    ';
    if (weight !== '') {
        $$out += '<li class="weui-media-box__info__meta weui-media-box__info__meta_extra">';
        $$out += $escape(weight);
        $$out += 'kg</li>';
    }
    $$out += ' -->\r\n            </ul>\r\n                   <ul class="weui-media-box__info">\r\n             <li class="weui-media-box__info__meta">体重\uFF1A';
    if (weight !== '0') {
        $$out += $escape(weight);
        $$out += 'kg';
    } else {
        $$out += '-';
    }
    $$out += '</li>\r\n            </ul>\r\n<!--             <ul class="weui-media-box__info">\r\n              <li class="weui-media-box__info__meta">';
    $$out += $escape(native_place);
    $$out += '</li>\r\n              <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">';
    $$out += $escape(nation);
    $$out += '</li>\r\n            </ul> -->\r\n            <ul class="weui-media-box__info">\r\n              <li class="weui-media-box__info__meta">位置\uFF1A</li>\r\n            <li class="weui-media-box__info__meta">';
    if (position !== '') {
        $$out += $escape(position);
    } else {
        $$out += '-';
    }
    $$out += '</li>\r\n             <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">';
    if (order_id !== '') {
        $$out += $escape(order_id);
        $$out += '号';
    } else {
        $$out += '-';
    }
    $$out += '</li>\r\n            </ul>\r\n            <ul class="weui-media-box__info">\r\n              <li class="weui-media-box__info__meta">';
    if (school !== '') {
        $$out += '就读于 ';
        $$out += $escape(school);
    }
    $$out += '</li>\r\n            </ul>\r\n            </div>\r\n          </div>\r\n        <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">个人简介</h4>\r\n            <p class="weui-media-box__desc">';
    if (individual !== '') {
        $$out += $escape(individual);
    } else {
        $$out += '暂无记录';
    }
    $$out += '</p>\r\n          </div>\r\n    <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">成长经历</h4>\r\n            <p class="weui-media-box__desc">';
    if (experience !== '') {
        $$out += $escape(experience);
    } else {
        $$out += '暂无记录';
    }
    $$out += '</p>\r\n          </div>\r\n    <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">技术特点</h4>\r\n            <p class="weui-media-box__desc">';
    if (feature !== '') {
        $$out += $escape(feature);
    } else {
        $$out += '暂无记录';
    }
    $$out += '</p>\r\n          </div>\r\n    <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">个人荣誉</h4>\r\n            <p class="weui-media-box__desc">';
    if (honor !== '') {
        $$out += $escape(honor);
    } else {
        $$out += '暂无记录';
    }
    $$out += '</p>\r\n          </div>\r\n    <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">人物评价</h4>\r\n            <p class="weui-media-box__desc">';
    if (comment !== '') {
        $$out += $escape(comment);
    } else {
        $$out += '暂无记录';
    }
    $$out += '</p>\r\n          </div>\r\n</div>\r\n</div>';
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=player_info.bundle.js.map