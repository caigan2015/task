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
/******/ 	return __webpack_require__(__webpack_require__.s = 75);
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

/***/ 75:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(76);

$(document).ready(function () {
    var data = $._ajax({
        async: false,
        type: "get",
        url: domain + "/api/v1/user/info"
    }).responseJSON;

    $("#page-vip").html(template(data));

    // $._ajax({
    //     type: "get",
    //     url: domain + "/api/v1/member/info",
    //     success: function(data) {
    //         console.log(data);
    //         data.is_member = is_member;
    //         $("#page-vip").html(template(data));
    //     },
    //     error: function(xhr) {
    //         var data = xhr.responseJSON;
    //         data.is_member = is_member;
    //         	console.log("----------------------------"+data.error_code === 30002)
    //         if (xhr.status === 404 && data.error_code === 30002) {

    //             $("#page-vip").html(template(data));
    //         }
    //     }
    // });
});

/***/ }),

/***/ 76:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $escape = $imports.$escape, head_img = $data.head_img, username = $data.username, member_status = $data.member_status, member_expire_time = $data.member_expire_time;
    $$out += '<div class="weui-cells">\r\n    <div class="weui-cell">\r\n        <div class="weui-cell__hd"><span class="avatar" style="background-image: url(';
    $$out += $escape(head_img);
    $$out += ');"></span></div>\r\n        <div class="weui-cell__bd">\r\n            <p class="name">';
    $$out += $escape(username);
    $$out += ' <i class="icon-vip';
    $$out += $escape(member_status === 1 ? ' on' : '');
    $$out += '"></i></p>\r\n            <p class="deadline">';
    if (member_status === 1) {
        $$out += $escape(member_expire_time.split(' ')[0]);
        $$out += '到期';
    } else {
        $$out += '你还不是建东会员';
    }
    $$out += '</p>\r\n        </div>\r\n        <div class="weui-cell__ft"><a class="pay-btn weui-btn weui-btn_mini weui-btn_primary" href="service_desc.html">';
    $$out += $escape(member_status !== 1 ? '立即开通' : '立即续费');
    $$out += '</a></div>\r\n    </div>\r\n</div>\r\n<div class="weui-cells__title">';
    $$out += $escape(member_status !== 1 ? '' : '我的');
    $$out += '会员特权</div>\r\n<div class="weui-grids">\r\n    <a href="player_info.html" class="weui-grid">\r\n        <div class="weui-grid__icon">\r\n            <i class="icon-accessibility"></i>\r\n        </div>\r\n        <p class="weui-grid__label">\r\n            球员信息\r\n        </p>\r\n    </a>\r\n    <a href="player_data.html" class="weui-grid">\r\n        <div class="weui-grid__icon">\r\n            <i class="icon-library-books"></i>\r\n        </div>\r\n        <p class="weui-grid__label">\r\n            数据分析\r\n        </p>\r\n    </a>\r\n    <a href="match_list.html" class="weui-grid">\r\n        <div class="weui-grid__icon">\r\n            <i class="icon-person-add"></i>\r\n        </div>\r\n        <p class="weui-grid__label">\r\n            赛事报名\r\n        </p>\r\n    </a>\r\n</div>';
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=vip.bundle.js.map