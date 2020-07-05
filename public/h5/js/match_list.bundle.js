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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
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

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(49);
var no_data_tips_html = __webpack_require__(8);
//#page height=100%
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
            text: "您目前还不是建东会员，暂无球员数据分析",
            buttons: buttons
        });
        return false;
    }

    var page = 1;
    var size = 10;

    var opt = {};
    opt.itemsPerLoad = size;
    opt.page = page;
    opt.maxItems = 0;
    opt.lastIndex = 0;
    opt.loading = false;
    opt.ele = $("#page-match-list.list-block");

    addItem(opt);

    $("#page-match-list.list-block").infinite().on("infinite", function () {
        var self = this;
        if (opt.loading) return;
        opt.loading = true;
        addItem(opt);
    });

    function addItem(opt) {
        $._ajax({
            type: "get",
            url: domain + "/api/v1/competition/begins",
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

    $("#page-match-list").on('click', '.weui-btn_primary', function (event) {
        event.preventDefault();
        /* Act on the event */
        var $curr = $(this).parents("a.item-content");
        var curr_title = $curr.find('.item-title').text();
        var curr_id = $curr.find('button').data("id");
        var $btn = $(this);
        if (!$btn.hasClass("weui-btn_disabled")) {
            $.confirm("您确定要报名参加 " + curr_title + " 这个赛事吗?", function () {
                $._ajax({
                    url: domain + "/api/v1/competition/apply/commit",
                    data: {
                        id: curr_id
                    },
                    success: function success(data) {
                        if (data.error_code === 0) {
                            $.toast("报名成功", function () {
                                $btn.html("取消").addClass("weui-btn_disabled");
                                console.log('报名成功');
                            });
                        }
                    }
                });
            }, function () {
                //取消操作
            });
        } else {

            $.confirm("您确定要取消参加 " + curr_title + " 这个赛事吗?", function () {
                $._ajax({
                    url: domain + "/api/v1/competition/apply/cancel",
                    data: {
                        id: curr_id
                    },
                    success: function success(data) {
                        if (data.error_code === 0) {
                            $.toast("取消成功", function () {
                                $btn.html("报名").removeClass("weui-btn_disabled");
                                console.log('取消报名成功');
                            });
                        }
                    }
                });
            }, function () {
                //取消操作
            });
        }
    });
});

/***/ }),

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $each = $imports.$each, data = $data.data, list = $data.list, i = $data.i, $escape = $imports.$escape;
    $each(data, function (list, i) {
        $$out += '\r\n<li>\r\n <!--    <a href="match_detail.html?id=';
        $$out += $escape(list.id);
        $$out += '" class="item-link item-content"> -->\r\n       <a  class="item-content">\r\n        <div class="item-media"><span style="background-image: url(';
        $$out += $escape(list.main_img_url);
        $$out += ');"></span></div>\r\n        <div class="item-inner">\r\n            <div class="item-title-row">\r\n                <div class="item-title">';
        $$out += $escape(list.title);
        $$out += '</div>\r\n            </div>\r\n            <div class="item-subtitle">时间:';
        $$out += $escape(list.play_time);
        $$out += '</div>\r\n            <div class="item-text">';
        $$out += $escape(list.summary);
        $$out += '</div>\r\n        </div>\r\n        <div class="item-inner">\r\n          <button data-id="';
        $$out += $escape(list.id);
        $$out += '" class="weui-btn weui-btn_mini weui-btn_primary ';
        if (list.apply_status === 1) {
            $$out += 'weui-btn_disabled';
        }
        $$out += '">';
        if (list.apply_status === 1) {
            $$out += '取消';
        } else {
            $$out += '报名';
        }
        $$out += '</button> \r\n        </div>\r\n    </a>\r\n</li>\r\n';
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
//# sourceMappingURL=match_list.bundle.js.map