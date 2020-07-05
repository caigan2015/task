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
/******/ 	return __webpack_require__(__webpack_require__.s = 33);
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

/***/ 33:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


//api/v1/order/by_user
//订单状态 
//-1已关闭 ！
//0待支付！
//1已支付 ！
//2已超时 x
//3退款中 x
//4已退款x
//5已取消！

var template = __webpack_require__(34);
var no_data_tips_html = __webpack_require__(8);
$(document).ready(function ($) {

    var page = 1;
    var size = 10;

    var opt = {};
    opt.itemsPerLoad = size;
    opt.page = page;
    opt.maxItems = 0;
    opt.lastIndex = 0;
    opt.loading = false;
    opt.ele = $("#page-history");

    addItem(opt);

    $("#page-history").infinite().on("infinite", function () {
        var self = this;
        if (opt.loading) return;
        opt.loading = true;
        addItem(opt);
    });

    function addItem(opt) {
        $._ajax({
            type: "get",
            url: domain + "/api/v1/order/by_user",
            data: {
                page: opt.page,
                size: opt.itemsPerLoad
            },
            success: function success(data) {
                opt.ele.find("ul").append(template(data));
                console.log(data);
                opt.lastIndex = opt.ele.find('ul>li').length;
                opt.maxItems = data.total;
                if (opt.lastIndex >= opt.maxItems) {
                    // 加载完毕，则注销无限加载事件，以防不必要的加载
                    opt.ele.destroyInfinite();
                    // 删除加载提示符
                    opt.ele.find(".weui-loadmore").remove();
                }
                opt.page++;
                opt.loading = false;

                if (data.total === 0) {
                    opt.ele.html(no_data_tips_html());
                    return false;
                }
            }
        });
    }

    $(document).on('click', '#page-history .pay-btn', function (event) {
        event.preventDefault();
        /* Act on the event */
        var curr_id = $(this).parents(".weui-form-preview").data("id");
        $._ajax({
            url: domain + "/api/v1/pay/pre_order",
            data: { id: curr_id },
            success: function success(data) {
                wx.chooseWXPay({
                    timestamp: data.timeStamp, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
                    nonceStr: data.nonceStr, // 支付签名随机串，不长于 32 位
                    package: data.package, // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
                    signType: data.signType, // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
                    paySign: data.paySign, // 支付签名
                    success: function success(res) {
                        console.log(res);
                        $.toast("支付成功", function () {
                            window.location.href = "user_center.html";
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '#page-history .cancel-btn', function (event) {
        event.preventDefault();
        var curr_id = $(this).parents(".weui-form-preview").data("id");
        $._ajax({
            url: domain + "/api/v1/order/cancel",
            data: { id: curr_id },
            success: function success(data) {
                console.log(data);
                $.toast("取消成功", function () {
                    window.location.reload();
                });
            }
        });
    });

    $(document).on('click', '#page-history .close-btn', function (event) {
        event.preventDefault();
        var curr_id = $(this).parents(".weui-form-preview").data("id");
        $._ajax({
            url: domain + "/api/v1/order/close",
            data: { id: curr_id },
            success: function success(data) {
                console.log(data);
                $.toast("关闭成功", function () {
                    window.location.reload();
                });
            }
        });
    });
});

/***/ }),

/***/ 34:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $each = $imports.$each, data = $data.data, list = $data.list, i = $data.i, $escape = $imports.$escape;
    $$out += ' ';
    $each(data, function (list, i) {
        $$out += '\r\n<li>\r\n    <div class="weui-form-preview" data-id="';
        $$out += $escape(list.id);
        $$out += '">\r\n        <div class="weui-form-preview__hd">\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">商品/服务</label>\r\n                <em class="weui-form-preview__value">';
        $$out += $escape(list.name);
        $$out += '</em>\r\n            </div>\r\n        </div>\r\n        <div class="weui-form-preview__bd">\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">订单号</label>\r\n                <span class="weui-form-preview__value">';
        $$out += $escape(list.order_no);
        $$out += '</span>\r\n            </div>\r\n<!--             <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">价格</label>\r\n                <span class="weui-form-preview__value">\uFFE5';
        $$out += $escape(list.price);
        $$out += '</span>\r\n            </div>\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">数量</label>\r\n                <span class="weui-form-preview__value">';
        $$out += $escape(list.count);
        $$out += '</span>\r\n            </div> -->\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">支付金额</label>\r\n                <span class="weui-form-preview__value">\uFFE5';
        $$out += $escape(list.total_price);
        $$out += '</span>\r\n            </div>\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">状态</label>\r\n              <!--  状态码';
        $$out += $escape(list.status);
        $$out += ' -->\r\n                <span class="weui-form-preview__value">';
        if (list.status == 0) {
            $$out += '未支付';
        } else if (list.status == 1) {
            $$out += '已完成';
        } else if (list.status == -1) {
            $$out += '已关闭';
        } else if (list.status == 5) {
            $$out += '已取消';
        }
        $$out += '</span>\r\n            </div>\r\n            <div class="weui-form-preview__item">\r\n                <label class="weui-form-preview__label">';
        if (list.status == 1) {
            $$out += '支付';
        } else {
            $$out += '下单';
        }
        $$out += '时间</label>\r\n                <span class="weui-form-preview__value">';
        if (list.status == 1) {
            $$out += $escape(list.pay_time);
        } else {
            $$out += $escape(list.create_time);
        }
        $$out += '</span>\r\n            </div>\r\n        </div>\r\n        ';
        if (!(list.status == -1 || list.status == 1)) {
            $$out += '\r\n        <div class="weui-form-preview__ft">\r\n            ';
            if (list.status == 0) {
                $$out += '<a class="weui-form-preview__btn weui-form-preview__btn_primary pay-btn" href="javascript:">支付</a><a class="weui-form-preview__btn weui-form-preview__btn_default cancel-btn" href="javascript:">取消</a>\r\n            ';
            } else if (list.status != 0 && list.status != -1 && list.status != 1) {
                $$out += '<a class="weui-form-preview__btn weui-form-preview__btn_default close-btn" href="javascript:">关闭</a> ';
            }
            $$out += '\r\n        </div>\r\n        ';
        }
        $$out += '\r\n    </div>\r\n</li>\r\n';
    });
    return $$out;
};

/***/ }),

/***/ 8:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '';
    $$out += '<div class="weui-loadmore weui-loadmore_line">\r\n  <span class="weui-loadmore__tips">暂无数据</span>\r\n</div>';
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=history.bundle.js.map