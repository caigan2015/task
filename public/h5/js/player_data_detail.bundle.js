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
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
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

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(51);

$(document).ready(function ($) {

    var curr_id = $.getParameter("id");

    var data = $._ajax({
        async: false,
        type: "get",
        url: domain + "/api/v1/competition/" + curr_id
    }).responseJSON;

    $("#page-player-data-detail").html(template(data));

    $("#page-player-data-detail").on('click', 'img', function (event) {
        event.preventDefault();
        /* Act on the event */
        var preview_list = [];
        $("#page-player-data-detail img").each(function () {
            var path = $(this).attr("src");
            preview_list.push((path.indexOf("http") === -1 ? domain : "") + $(this).attr("src"));
        });
        var index = $("#page-player-data-detail img").index(this);
        console.log(JSON.stringify(preview_list));
        wx.previewImage({
            current: preview_list[index],
            urls: preview_list
        });
    });
});

/***/ }),

/***/ 51:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $escape = $imports.$escape, main_img_url = $data.main_img_url, title = $data.title, score = $data.score, play_time = $data.play_time, summary = $data.summary, description = $data.description;
    $$out += '<div class="content">\r\n    <img src="';
    $$out += $escape(main_img_url);
    $$out += '" alt="">\r\n    <div class="weui-cells">\r\n        <div class="weui-cell">\r\n            <div class="weui-cell__bd">\r\n                <p>队伍</p>\r\n            </div>\r\n            <div class="weui-cell__ft">';
    $$out += $escape(title);
    $$out += '</div>\r\n        </div>\r\n        <div class="weui-cell">\r\n            <div class="weui-cell__bd">\r\n                <p>比分</p>\r\n            </div>\r\n            <div class="weui-cell__ft">';
    $$out += $escape(score);
    $$out += '</div>\r\n        </div>\r\n        <div class="weui-cell">\r\n            <div class="weui-cell__bd">\r\n                <p>比赛时间</p>\r\n            </div>\r\n            <div class="weui-cell__ft">';
    $$out += $escape(play_time);
    $$out += '</div>\r\n        </div>\r\n        <div class="weui-media-box weui-media-box_text">\r\n            <h4 class="weui-media-box__title">比赛简介</h4>\r\n            <p class="weui-media-box__desc">';
    $$out += $escape(summary);
    $$out += '</p>\r\n        </div>\r\n    </div>\r\n    <article class="weui-article">\r\n        <h1>比赛报告</h1>\r\n        <section>\r\n            ';
    $$out += description;
    $$out += '\r\n        </section>\r\n    </article>\r\n</div>\r\n<script>\r\ndocument.title = "';
    $$out += $escape(title);
    $$out += '";\r\n</script>';
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=player_data_detail.bundle.js.map