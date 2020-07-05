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
/******/ 	return __webpack_require__(__webpack_require__.s = 60);
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

/***/ 60:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(61);

$(document).ready(function ($) {
    var data = $._ajax({
        async: false,
        type: "get",
        url: domain + "/api/v1/business/joinus"
    }).responseJSON;
    data.is_member = is_member;
    $("#page-service-desc").html(template(data));

    $(document).on("click", "#page-service-desc .weui-btn_primary", function () {
        var isAgree = $("#page-service-desc #weuiAgree").prop("checked");
        if (!isAgree) {
            $.toptip("请先阅读《タスク服务协议》及《视频购买观看协议》及《英东体育尊享会员服务协议》，同意上述协议", "warning");
            return false;
        }
        var order = $._ajax({
            async: false,
            url: domain + "/api/v1/order/commit",
            data: {
                business_id: data.id,
                name: data.title
            }
        }).responseJSON;
        if (order.error_code === 10011) {
            $.modal({
                text: "您还没绑定手机号码！",
                buttons: [{
                    text: "去绑定",
                    onClick: function onClick() {
                        location.href = "bind.html";
                    }
                }, {
                    text: "返回",
                    onClick: function onClick() {}
                }]
            });
        } else {
            $._ajax({
                url: domain + "/api/v1/pay/pre_order",
                data: { id: order.id },
                success: function success(data) {
                    wx.chooseWXPay({
                        timestamp: data.timeStamp,
                        nonceStr: data.nonceStr,
                        package: data.package,
                        signType: data.signType,
                        paySign: data.paySign,
                        success: function success(res) {
                            console.log(res);
                            $.toast("支付成功", function () {
                                window.location.href = "user_center.html";
                            });
                        }
                    });
                }
            });
        }
    });
});

/***/ }),

/***/ 61:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', content = $data.content, $escape = $imports.$escape, is_member = $data.is_member, price = $data.price, specs = $data.specs, title = $data.title;
    $$out += '<div class="weui-tab__bd">\r\n    <div class="content">';
    $$out += content;
    $$out += '\r\n        <div class="weui-agree">\r\n            <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" checked="checked">\r\n            <span class="weui-agree__text">\r\n       已阅读并同意<a href="protocol.html?type=1">\u300Aタスク服务协议\u300B</a>及<a href="protocol.html?type=2">\u300A视频购买观看协议\u300B</a>及<a href="protocol.html?type=3">\u300Aタスク尊享会员服务协议\u300B</a>且知晓因版权问题\uFF0C仅限大陆地区观看\u3002\r\n      </span>\r\n        </div>\r\n    </div>\r\n</div>\r\n<div class="weui-tabbar">\r\n    <a href="javascript:;" class="weui-btn weui-btn_primary">';
    $$out += $escape(is_member === true ? '会员续费' : '加入会员');
    $$out += '\uFF08';
    $$out += $escape(price);
    $$out += '元/';
    $$out += $escape(specs);
    $$out += '\uFF09</a>\r\n</div>\r\n<script>\r\ndocument.title = "';
    $$out += $escape(title);
    $$out += '"\r\n</script>';
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=service_desc.bundle.js.map