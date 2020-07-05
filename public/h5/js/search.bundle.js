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
/******/ 	return __webpack_require__(__webpack_require__.s = 58);
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

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(59);

$(document).ready(function () {
    var $searchBar = $('#searchBar'),
        $searchResult = $('#searchResult'),
        $searchText = $('#searchText'),
        $searchInput = $('#searchInput'),
        $searchClear = $('#searchClear'),
        $searchCancel = $('#searchCancel');

    function hideSearchResult() {
        $searchResult.hide();
        $searchInput.val('');
    }

    function cancelSearch() {
        hideSearchResult();
        $searchBar.removeClass('weui-search-bar_focusing');
        $searchText.show();
    }

    $searchText.on('click', function () {
        $searchBar.addClass('weui-search-bar_focusing');
        $searchInput.focus();
    });
    $searchInput.on('blur', function () {
        if (!this.value.length) cancelSearch();
    }).on('input', function () {
        if (this.value.length) {
            $searchResult.show();
        } else {
            $searchResult.hide();
        }
    });
    $searchClear.on('click', function () {
        hideSearchResult();
        $searchInput.focus();
    });
    $searchCancel.on('click', function () {
        cancelSearch();
        $searchInput.blur();
    });
    $searchInput.on('keypress', function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            event.stopPropagation();

            curr_keyword = $searchInput.val();
            window.location.href = "search.html?keyword=" + $searchInput.val();
        }
    });

    var curr_keyword = $.getParameter("keyword");
    if (curr_keyword !== null) {
        $searchInput.val(curr_keyword);
        $searchBar.addClass('weui-search-bar_focusing');
    }

    var page = 1;
    var size = 10;

    var opt = {};
    opt.itemsPerLoad = size;
    opt.page = page;
    opt.maxItems = 0;
    opt.lastIndex = 0;
    opt.loading = false;
    opt.ele = $("#page-search.list-block");

    addItem(opt);

    $("#page-search.list-block").infinite().on("infinite", function () {
        var self = this;
        if (opt.loading) return;
        opt.loading = true;
        addItem(opt);
    });

    function addItem(opt) {
        $._ajax({
            url: domain + "/api/v1/competition/play" + "?page=" + opt.page + "&size=" + opt.itemsPerLoad,
            data: {
                search: curr_keyword
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
                } else {
                    opt.page++;
                    opt.loading = false;
                }
            }
        });
    }
});

/***/ }),

/***/ 59:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $each = $imports.$each, data = $data.data, list = $data.list, i = $data.i, undefined = $data.undefined, $escape = $imports.$escape;
    $each(data, function (list, i) {
        $$out += '\r\n<li>\r\n    <a href="';
        if (list.file === undefined) {
            $$out += 'live';
        } else {
            $$out += 'videos';
        }
        $$out += '.html?id=';
        $$out += $escape(list.id);
        $$out += '" class="item-link item-content">\r\n        <div class="weui-mark-vip"><span class="weui-mark-lt marker-';
        if (list.type == 3) {
            $$out += 'live';
        } else if (list.type == 1) {
            $$out += 'playback';
        } else if (list.type == 2) {
            $$out += 'collection';
        }
        $$out += '"></span></div>\r\n        <div class="item-media"><span style="background-image: url(';
        $$out += $escape(list.main_img_url);
        $$out += ');"></span></div>\r\n        <div class="item-inner">\r\n            <div class="item-title-row">\r\n                <div class="item-title">';
        $$out += $escape(list.title);
        $$out += '</div>\r\n            </div>\r\n            <div class="item-subtitle">比赛时间\uFF1A';
        $$out += $escape(list.play_time);
        $$out += '</div>\r\n            ';
        if (list.live_status !== undefined) {
            $$out += '<div class="item-subtitle">';
            if (list.live_status === 1) {
                $$out += '进行中';
            } else {
                $$out += '已过期';
            }
            $$out += '</div>';
        }
        $$out += '\r\n            <div class="item-text">';
        $$out += $escape(list.summary);
        $$out += '</div>\r\n        </div>\r\n    </a>\r\n</li>\r\n';
    });
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=search.bundle.js.map