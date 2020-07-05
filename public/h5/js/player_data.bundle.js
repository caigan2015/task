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
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
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

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(53);

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

    var team = $._ajax({
        async: false,
        type: "get",
        url: domain + "/api/v1/team/by_user"
    }).responseJSON;
    team.data = team;
    team.type = 0;
    console.log(template(team));
    $("#page-player-data>ul").html(template(team));

    var winH = $(window).height();
    var categorySpace = 10;

    $('.js_category').on('click', function () {
        var $this = $(this),
            $inner = $this.next('.js_categoryInner'),
            $page = $this.parents('#page-player-data'),
            $parent = $(this).parent('li'),
            curr_id = $this.data("id");
        var innerH = $inner.data('height');

        //请求一次后，防止多余请求
        if ($this.attr("data-id") !== undefined) {
            var competitions = $._ajax({
                async: false,
                type: "get",
                url: domain + "/api/v1/team/" + curr_id + "/competitions"
            }).responseJSON;
            competitions.data = competitions;
            competitions.type = 1;
            $this.next().find(".page__category-content").html(template(competitions));
            $this.removeAttr("data-id");
        }

        if (!innerH) {
            $inner.css('height', 'auto');
            innerH = $inner.height();
            $inner.removeAttr('style');
            $inner.data('height', innerH);
        }

        if ($parent.hasClass('js_show')) {
            $parent.removeClass('js_show');
        } else {
            $parent.siblings().removeClass('js_show');

            $parent.addClass('js_show');
            if (this.offsetTop + this.offsetHeight + innerH > $page.scrollTop() + winH) {
                var scrollTop = this.offsetTop + this.offsetHeight + innerH - winH + categorySpace;

                if (scrollTop > this.offsetTop) {
                    scrollTop = this.offsetTop - categorySpace;
                }
                $page.scrollTop(scrollTop);
            }
        }
    });
});

/***/ }),

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', type = $data.type, $each = $imports.$each, data = $data.data, list = $data.list, i = $data.i, $escape = $imports.$escape;
    if (type == 0) {
        $$out += ' ';
        $each(data, function (list, i) {
            $$out += '\r\n<li>\r\n    <div class="weui-flex js_category" data-id="';
            $$out += $escape(list.id);
            $$out += '">\r\n        <p class="weui-flex__item">';
            $$out += $escape(list.name);
            $$out += '</p>\r\n        <img src="';
            $$out += $escape(list.logo);
            $$out += '" alt="">\r\n    </div>\r\n    <div class="page__category js_categoryInner list-block media-list">\r\n        <ul class="weui-cells page__category-content">\r\n        </ul>\r\n    </div>\r\n</li>\r\n';
        });
        $$out += ' ';
    } else {
        $$out += ' ';
        $each(data, function (list, i) {
            $$out += '\r\n<li>\r\n    <a href="player_data_detail.html?id=';
            $$out += $escape(list.id);
            $$out += '" class="item-link item-content">\r\n        <div class="item-media"><span style="background-image: url(';
            $$out += $escape(list.main_img_url);
            $$out += ');"></span></div>\r\n        <div class="item-inner">\r\n            <div class="item-title-row">\r\n                <div class="item-title">';
            $$out += $escape(list.title);
            $$out += '</div>\r\n            </div>\r\n            <div class="item-subtitle">';
            $$out += $escape(list.play_time);
            $$out += '</div>\r\n        </div>\r\n    </a>\r\n</li>\r\n';
        });
        $$out += ' ';
    }
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=player_data.bundle.js.map