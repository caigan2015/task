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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
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

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var template = __webpack_require__(38);

$(document).ready(function () {

    function loadmoreReInit($ele) {
        $ele.destroyInfinite();
        if ($ele.find('.weui-loadmore').length === 0) {
            var loadmore_html = '<div class="weui-loadmore"><i class="weui-loading"></i><span class="weui-loadmore__tips">正在加载</span></div>';
            $ele.append(loadmore_html);
        }
        $ele.infinite();
    }

    var page = 1;
    var size = 5;

    //生成单个的tab上拉加载初始参数
    function creatTabSetting($ele) {
        var opt = {};
        opt.itemsPerLoad = size;
        opt.page = page;
        opt.maxItems = 0;
        opt.lastIndex = 0;
        opt.loading = false;
        opt.ele = $ele;
        return opt;
    }

    var tab_setting = [];
    //恢复缓存html，滚动高度，
    var tabCache = $.getCache("live_center", true);
    //ios直接跳过
    if (tabCache !== null && device.ios !== true) {
        $(".weui-bar__item--on").removeClass("weui-bar__item--on");
        $(".weui-tab__bd-item--active").removeClass('weui-tab__bd-item--active');
        $(".weui-navbar__item[href='" + tabCache.activeTab + "']").addClass("weui-bar__item--on");
        $(tabCache.activeTab).addClass("weui-tab__bd-item--active");
        //each循环初始化
        $(".weui-tab__bd-item").each(function (index, el) {
            tab_setting[index] = tabCache.tabs[index];
            //添加缓存html
            $(el).find(".cards-list>ul").html(tabCache.tabs[index].tempHtml);
            //滚动到历史高度
            setTimeout(function () {
                $(el).scrollTop(tabCache.tabs[index].scrollTop);
            }, 100);
        });
        $(".weui-tab__bd-item").infinite().on("infinite", function () {
            var index = $(this).index();
            var self = tabCache.tabs[index];
            self.ele = $(this);
            if (self.loading) return;
            self.loading = true;
            addItem(self);
        });
    } else {
        //each循环初始化
        $(".weui-tab__bd-item").each(function (index, el) {
            tab_setting[index] = creatTabSetting($(this));
            addItem(tab_setting[index]);
        });
        $(".weui-tab__bd-item").infinite().on("infinite", function () {
            var index = $(this).index();
            var self = tab_setting[index];
            if (self.loading) return;
            self.loading = true;
            addItem(self);
        });
    }

    function addItem(opt, callback1, callback2) {
        $._ajax({
            url: domain + opt.ele.data("url") + "?page=" + opt.page + "&size=" + opt.itemsPerLoad,
            data: {
                type: opt.ele.data("type")
            },
            success: function success(data) {
                if (callback1 !== undefined) {
                    callback1();
                }
                opt.ele.find('.cards-list>ul').append(template(data));
                console.log(data);
                if (callback2 !== undefined) {
                    callback2();
                }
                opt.lastIndex = opt.ele.find('.cards-list>ul>li').length;
                opt.maxItems = data.total;
                if (opt.lastIndex >= opt.maxItems) {
                    // 加载完毕，则注销无限加载事件，以防不必要的加载
                    opt.ele.destroyInfinite();
                    // 删除加载提示符
                    opt.ele.find(".weui-loadmore").remove();
                }
                opt.page++;
                opt.loading = false;
            }
        });
    }

    $('.weui-tab__bd-item').pullToRefresh().on('pull-to-refresh', function (done) {
        var self = this;
        var i = $(self).index();
        tab_setting[i] = creatTabSetting($(self));
        addItem(tab_setting[i], function () {
            console.log(1);
            $(self).find(".cards-list.content>ul").html("");
        }, function () {
            loadmoreReInit($(self));
            $(self).pullToRefreshDone();
        });
    });

    $(function () {
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
                window.location.href = "search.html?keyword=" + $searchInput.val();
            }
        });
    });

    //安卓记录tab状态，active和相应的高度
    $("#page-live-center").on("click", ".card", function () {
        if (device.ios !== true) {
            var currTab = $(".weui-bar__item--on").attr("href");
            var tabs = tab_setting;
            $(".weui-tab__bd-item").each(function (index, el) {
                tabs[index].tempHtml = $(el).find(".cards-list.content>ul").html();
                tabs[index].scrollTop = $(el).scrollTop();
            });
            $.setCache("live_center", { activeTab: currTab, tabs: tabs }, true);
        }
        window.location.href = $(this).children("a").attr("data-href");
    });

    if (performance.navigation.type === 1) {
        $.setCache("live_center", null, true);
    }
});

/***/ }),

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $each = $imports.$each, data = $data.data, list = $data.list, i = $data.i, undefined = $data.undefined, $escape = $imports.$escape;
    $each(data, function (list, i) {
        $$out += '\r\n<li class="card" onclick="if(device.android)$.showLoading();">\r\n    <a data-href="';
        if (list.file === undefined) {
            $$out += 'live';
        } else {
            $$out += 'videos';
        }
        $$out += '.html?id=';
        $$out += $escape(list.id);
        $$out += '">\r\n    <span class="surface" style="background-image: url(';
        $$out += $escape(list.main_img_url);
        $$out += ')"></span>\r\n    <div class="card-content">\r\n        <h4 class="weui-media-box__title">';
        $$out += $escape(list.title);
        if (list.live_status !== undefined) {
            if (list.live_status === 1) {
                $$out += '<span class="weui-badge">进行中</span>';
            } else {
                $$out += '<span class="weui-badge over">已过期</span>';
            }
            $$out += ' ';
        }
        $$out += '</h4>\r\n         <p class="weui-media-box__desc">';
        if (list.summary != '') {
            $$out += $escape(list.summary);
        } else {
            $$out += '暂无简介';
        }
        $$out += '</p>\r\n';
        if (list.file === undefined) {
        } else {
            $$out += '\r\n\t<ul class="weui-media-box__info">\r\n            <li class="weui-media-box__info__meta"><i class="icon-play2"></i>';
            $$out += $escape(list.browse_num);
            $$out += '</li>\r\n        </ul> ';
        }
        $$out += '\r\n    </div>\r\n</a>\r\n</li>\r\n';
    });
    return $$out;
};

/***/ })

/******/ });
//# sourceMappingURL=live_center.bundle.js.map