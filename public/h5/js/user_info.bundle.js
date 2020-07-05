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
/******/ 	return __webpack_require__(__webpack_require__.s = 65);
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

/***/ 4:
/***/ (function(module, exports) {

module.exports = {"domain":"http://www.gzjiandongsp.com","webSocketUrl":"ws://www.gzjiandongsp.com:19833","gender_list":[{"name":"保密","value":0,"class":"unknow"},{"name":"男","value":1,"class":"male"},{"name":"女","value":2,"class":"female"}],"emojiData":[{"code":"wx","name":"微笑","path":"emoji/1.gif"},{"code":"pz","name":"撇嘴","path":"emoji/2.gif"},{"code":"se","name":"色","path":"emoji/3.gif"},{"code":"fd","name":"发呆","path":"emoji/4.gif"},{"code":"dy","name":"得意","path":"emoji/5.gif"},{"code":"ll","name":"流泪","path":"emoji/6.gif"},{"code":"hx","name":"害羞","path":"emoji/7.gif"},{"code":"bz","name":"闭嘴","path":"emoji/8.gif"},{"code":"shui","name":"睡","path":"emoji/9.gif"},{"code":"dk","name":"大哭","path":"emoji/10.gif"},{"code":"gg","name":"尴尬","path":"emoji/11.gif"},{"code":"fn","name":"发怒","path":"emoji/12.gif"},{"code":"tp","name":"调皮","path":"emoji/13.gif"},{"code":"cy","name":"呲牙","path":"emoji/14.gif"},{"code":"jy","name":"惊讶","path":"emoji/15.gif"},{"code":"ng","name":"难过","path":"emoji/16.gif"},{"code":"kuk","name":"酷","path":"emoji/17.gif"},{"code":"lengh","name":"冷汗","path":"emoji/18.gif"},{"code":"zk","name":"抓狂","path":"emoji/19.gif"},{"code":"tuu","name":"吐","path":"emoji/20.gif"},{"code":"tx","name":"偷笑","path":"emoji/21.gif"},{"code":"ka","name":"可爱","path":"emoji/22.gif"},{"code":"baiy","name":"白眼","path":"emoji/23.gif"},{"code":"am","name":"傲慢","path":"emoji/24.gif"},{"code":"jie","name":"饥饿","path":"emoji/25.gif"},{"code":"kun","name":"困","path":"emoji/26.gif"},{"code":"jk","name":"惊恐","path":"emoji/27.gif"},{"code":"lh","name":"流汗","path":"emoji/28.gif"},{"code":"hanx","name":"憨笑","path":"emoji/29.gif"},{"code":"db","name":"大兵","path":"emoji/30.gif"},{"code":"fendou","name":"奋斗","path":"emoji/31.gif"},{"code":"zhm","name":"咒骂","path":"emoji/32.gif"},{"code":"yiw","name":"疑问","path":"emoji/33.gif"},{"code":"xu","name":"嘘..","path":"emoji/34.gif"},{"code":"yun","name":"晕","path":"emoji/35.gif"},{"code":"zhem","name":"折磨","path":"emoji/36.gif"},{"code":"shuai","name":"衰","path":"emoji/37.gif"},{"code":"kl","name":"骷髅","path":"emoji/38.gif"},{"code":"qiao","name":"敲打","path":"emoji/39.gif"},{"code":"zj","name":"再见","path":"emoji/40.gif"},{"code":"ch","name":"擦汗","path":"emoji/41.gif"},{"code":"kb","name":"抠鼻","path":"emoji/42.gif"},{"code":"zhem","name":"鼓掌","path":"emoji/43.gif"},{"code":"qd","name":"糗大了","path":"emoji/44.gif"},{"code":"huaix","name":"坏笑","path":"emoji/45.gif"},{"code":"zhh","name":"左哼哼","path":"emoji/46.gif"},{"code":"yhh","name":"右哼哼","path":"emoji/47.gif"},{"code":"hq","name":"哈欠","path":"emoji/48.gif"},{"code":"bs","name":"鄙视","path":"emoji/49.gif"},{"code":"wq","name":"委屈","path":"emoji/50.gif"},{"code":"kk","name":"快哭了","path":"emoji/51.gif"},{"code":"yx","name":"阴险","path":"emoji/52.gif"},{"code":"qq","name":"亲亲","path":"emoji/53.gif"},{"code":"xia","name":"吓","path":"emoji/54.gif"},{"code":"kel","name":"可怜","path":"emoji/55.gif"},{"code":"cd","name":"菜刀","path":"emoji/56.gif"},{"code":"xig","name":"西瓜","path":"emoji/57.gif"},{"code":"pj","name":"啤酒","path":"emoji/58.gif"},{"code":"lq","name":"篮球","path":"emoji/59.gif"},{"code":"pp","name":"乒乓","path":"emoji/60.gif"},{"code":"kf","name":"咖啡","path":"emoji/61.gif"},{"code":"fan","name":"饭","path":"emoji/62.gif"},{"code":"zt","name":"猪头","path":"emoji/63.gif"},{"code":"mg","name":"玫瑰","path":"emoji/64.gif"},{"code":"dx","name":"凋谢","path":"emoji/65.gif"},{"code":"sa","name":"示爱","path":"emoji/66.gif"},{"code":"xin","name":"爱心","path":"emoji/67.gif"},{"code":"xs","name":"心碎","path":"emoji/68.gif"},{"code":"dg","name":"蛋糕","path":"emoji/69.gif"},{"code":"shd","name":"闪电","path":"emoji/70.gif"},{"code":"zhd","name":"炸弹","path":"emoji/71.gif"},{"code":"dao","name":"刀","path":"emoji/72.gif"},{"code":"zq","name":"足球","path":"emoji/73.gif"},{"code":"pch","name":"瓢虫","path":"emoji/74.gif"},{"code":"bb","name":"便便","path":"emoji/75.gif"},{"code":"yl","name":"月亮","path":"emoji/76.gif"},{"code":"ty","name":"太阳","path":"emoji/77.gif"},{"code":"lw","name":"礼物","path":"emoji/78.gif"},{"code":"yb","name":"拥抱","path":"emoji/79.gif"},{"code":"qiang","name":"强","path":"emoji/80.gif"},{"code":"ruo","name":"弱","path":"emoji/81.gif"},{"code":"ws","name":"握手","path":"emoji/82.gif"},{"code":"shl","name":"胜利","path":"emoji/83.gif"},{"code":"bq","name":"抱拳","path":"emoji/84.gif"},{"code":"gy","name":"勾引","path":"emoji/85.gif"},{"code":"qt","name":"拳头","path":"emoji/86.gif"},{"code":"cj","name":"差劲","path":"emoji/87.gif"},{"code":"aini","name":"爱你","path":"emoji/88.gif"},{"code":"bu","name":"NO","path":"emoji/89.gif"},{"code":"hd","name":"OK","path":"emoji/90.gif"},{"code":"aiq","name":"爱情","path":"emoji/91.gif"},{"code":"fw","name":"飞吻","path":"emoji/92.gif"},{"code":"tiao","name":"跳跳","path":"emoji/93.gif"},{"code":"fad","name":"发抖","path":"emoji/94.gif"},{"code":"oh","name":"怄火","path":"emoji/95.gif"},{"code":"zhq","name":"转圈","path":"emoji/96.gif"},{"code":"kt","name":"磕头","path":"emoji/97.gif"},{"code":"ht","name":"回头","path":"emoji/98.gif"},{"code":"tsh","name":"跳绳","path":"emoji/99.gif"},{"code":"hsh","name":"挥手","path":"emoji/100.gif"},{"code":"jd","name":"激动","path":"emoji/101.gif"},{"code":"jw","name":"街舞","path":"emoji/102.gif"},{"code":"xw","name":"献吻","path":"emoji/103.gif"},{"code":"zuotj","name":"左太极","path":"emoji/104.gif"},{"code":"youtj","name":"右太极","path":"emoji/105.gif"},{"code":"shx","name":"双喜","path":"emoji/106.gif"},{"code":"bp","name":"鞭炮","path":"emoji/107.gif"},{"code":"dl","name":"灯笼","path":"emoji/108.gif"},{"code":"fc","name":"发财","path":"emoji/109.gif"},{"code":"kg","name":"K歌","path":"emoji/110.gif"},{"code":"gw","name":"购物","path":"emoji/111.gif"},{"code":"yj","name":"邮件","path":"emoji/112.gif"},{"code":"zshuai","name":"主帅","path":"emoji/113.gif"},{"code":"hec","name":"喝彩","path":"emoji/114.gif"},{"code":"qidao","name":"祈祷","path":"emoji/115.gif"},{"code":"baojin","name":"爆筋","path":"emoji/116.gif"},{"code":"bangbangt","name":"棒棒糖","path":"emoji/117.gif"},{"code":"hn","name":"喝奶","path":"emoji/118.gif"},{"code":"xiam","name":"下面","path":"emoji/119.gif"},{"code":"xiangj","name":"吃蕉","path":"emoji/120.gif"},{"code":"fj","name":"飞机","path":"emoji/121.gif"},{"code":"jiaoc","name":"轿车","path":"emoji/122.gif"},{"code":"zuohc","name":"左火车","path":"emoji/123.gif"},{"code":"chex","name":"车厢","path":"emoji/124.gif"},{"code":"youhc","name":"右火车","path":"emoji/125.gif"},{"code":"dyun","name":"多云","path":"emoji/126.gif"},{"code":"xiayu","name":"下雨","path":"emoji/127.gif"},{"code":"cp","name":"钞票","path":"emoji/128.gif"},{"code":"xm","name":"熊猫","path":"emoji/129.gif"},{"code":"dengp","name":"灯泡","path":"emoji/130.gif"},{"code":"fengc","name":"风车","path":"emoji/131.gif"},{"code":"naoz","name":"闹钟","path":"emoji/132.gif"},{"code":"yus","name":"雨伞","path":"emoji/133.gif"},{"code":"qq","name":"气球","path":"emoji/134.gif"},{"code":"zuanj","name":"钻戒","path":"emoji/135.gif"},{"code":"sf","name":"沙发","path":"emoji/136.gif"},{"code":"zhij","name":"纸巾","path":"emoji/137.gif"},{"code":"yao","name":"药","path":"emoji/138.gif"},{"code":"shq","name":"手枪","path":"emoji/139.gif"},{"code":"qw","name":"青蛙","path":"emoji/140.gif"}],"emojiPath":"/h5/images/","protocol":[{"type":1,"title":"タスク服务协议","code":"service_agreement"},{"type":2,"title":"タスク网视频购买观看协议","code":"purchase_agreement"},{"type":3,"title":"タスク尊享会员服务协议","code":"membership_agreement"}]}

/***/ }),

/***/ 6:
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ 65:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


__webpack_require__(66);

__webpack_require__(68);

var _config = __webpack_require__(4);

//使用require导入css文件
var template = __webpack_require__(70);

$(document).ready(function () {
    var data = $._ajax({
        async: false,
        type: "get",
        url: domain + "/api/v1/user/info"
    }).responseJSON;

    $("#page-user-info").html(template(data));

    $("#page-user-info").on("click", ".name-cell", function () {
        var ex_value = $(this).find(".weui-cell__ft").text();

        $.prompt({
            title: '修改昵称',
            input: ex_value,
            empty: false, // 是否允许为空
            onOK: function onOK(value) {
                console.log(value);
                $._ajax({
                    url: domain + "/api/v1/user/save",
                    data: {
                        username: value
                    },
                    success: function success(data) {
                        if (data.error_code === 0) {
                            $.toast("修改成功");
                            $("#page-user-info .name-cell .weui-cell__ft").html(value);
                        }
                    }
                });
            },
            onCancel: function onCancel() {
                //点击取消
                //todo
            }
        });
    });

    $("#crop-image").cropper({
        aspectRatio: 1,
        viewMode: 1
    });

    $(document).on("change", "[name='uploadAvatar']", function () {
        // 检查是否为图像类型
        var simpleFile = this.files[0];
        if (!/image\/\w+/.test(simpleFile.type)) {
            alert("请确保文件类型为图像类型");
            return false;
        }
        var reader = new FileReader();
        // 将文件以二进制文件读入页面中
        $.showLoading();
        reader.onload = function (e) {
            var imgFile = e.target.result;
            $("#cutter-popup").popup();
            $("#crop-image").cropper("reset");
            $("#crop-image").cropper("replace", imgFile);
            // cutter.reset().replace(imgFile);
            $.hideLoading();
            //重置input值，避免重复上传同一的图片不触发onchange事件
            $("[name='uploadAvatar']").val("");
        };
        reader.readAsDataURL(simpleFile);
    });
    $(document).on("click", "#cutter-popup .weui-btn_primary", function () {
        var src_data = $("#crop-image").cropper("getCroppedCanvas", {
            width: 100,
            height: 100
        }).toDataURL('image/jpeg');;
        $._ajax({
            url: domain + "/api/v1/user/save",
            data: {
                head_img: src_data.replace("data:image/jpeg;base64,", "")
            },
            success: function success(data) {
                if (data.error_code === 0) {
                    $.toast("修改成功", function () {
                        $.closePopup();
                        $("#page-user-info .avatar-cell .weui-cell__ft span").css("background-image", "url(" + src_data + ")");
                    });
                }
            }
        });
    });

    $(document).on('click', '#page-user-info .gender-cell', function (event) {
        event.preventDefault();
        /* Act on the event */
        $(".gender-input").picker("open");
    });

    $(".gender-input").picker({
        title: "请选择性别",
        toolbarTemplate: '<div class="toolbar">\
          <div class="toolbar-inner"><a href="javascript:;" class="picker-button close-picker">关闭</a>\
          <h1 class="title">{{title}}</h1>\
          </div>\
          </div>',
        cols: [{
            textAlign: 'center',
            values: ["保密", "男", "女"]
        }],
        onChange: function onChange(picker) {
            var value = 0;
            for (var i = 0; i < _config.gender_list.length; i++) {
                if (picker.value[0] === _config.gender_list[i].name) {
                    value = _config.gender_list[i].value;
                }
            }
            console.log(value);
            $._ajax({
                url: domain + "/api/v1/user/save",
                data: { sex: value }
            });
        }
    });

    // $(document).on('click', '#page-user-info .birthday-cell', function(event) {
    //     event.preventDefault();
    //     /* Act on the event */
    //     $(".birthday-input").calendar("open"); //打开弹窗

    // });
    // var today = new Date().getTime();
    // var ex_birthday = $(".birthday-input").val();
    // ex_birthday === "点击设置" ? ex_birthday = [today] : ex_birthday = [ex_birthday];
    // $(".birthday-input").calendar({
    //     value: ex_birthday,
    //     maxDate: today,
    //     dateFormat: 'yyyy-mm-dd',
    //     onChange: function(calendar) {
    //         console.log(calendar.value);
    //         var value = new Date(calendar.value[0]).format("yyyy-MM-dd");
    //         $.ajax({
    //             type: "post",
    //             url: "/users/modify",
    //             data: { userBirthday: value, userName: userInfo.userName, type: "userBirthday", token: token },
    //             success: function(data) {
    //                 if (data.code === 200) {
    //                     // userInfo.userGender = value;
    //                     // setCache("userInfo", userInfo);
    //                 }
    //             }
    //         });
    //     }
    // });
});

/***/ }),

/***/ 66:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(67);
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {"hmr":true}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__(7)(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../_css-loader@0.28.9@css-loader/index.js??ref--2-1!../../_postcss-loader@2.0.10@postcss-loader/lib/index.js!./cropper.min.css", function() {
			var newContent = require("!!../../_css-loader@0.28.9@css-loader/index.js??ref--2-1!../../_postcss-loader@2.0.10@postcss-loader/lib/index.js!./cropper.min.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 67:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(6)(false);
// imports


// module
exports.push([module.i, "/*!\n * Cropper v3.1.4\n * https://github.com/fengyuanchen/cropper\n *\n * Copyright (c) 2014-2018 Chen Fengyuan\n * Released under the MIT license\n *\n * Date: 2018-01-13T09:37:21.486Z\n */.cropper-container{direction:ltr;font-size:0;line-height:0;position:relative;-ms-touch-action:none;touch-action:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.cropper-container img{display:block;height:100%;image-orientation:0deg;max-height:none!important;max-width:none!important;min-height:0!important;min-width:0!important;width:100%}.cropper-canvas,.cropper-crop-box,.cropper-drag-box,.cropper-modal,.cropper-wrap-box{bottom:0;left:0;position:absolute;right:0;top:0}.cropper-canvas,.cropper-wrap-box{overflow:hidden}.cropper-drag-box{background-color:#fff;opacity:0}.cropper-modal{background-color:#000;opacity:.5}.cropper-view-box{display:block;height:100%;outline-color:rgba(51,153,255,.75);outline:1px solid #39f;overflow:hidden;width:100%}.cropper-dashed{border:0 dashed #eee;display:block;opacity:.5;position:absolute}.cropper-dashed.dashed-h{border-bottom-width:1px;border-top-width:1px;height:33.33333%;left:0;top:33.33333%;width:100%}.cropper-dashed.dashed-v{border-left-width:1px;border-right-width:1px;height:100%;left:33.33333%;top:0;width:33.33333%}.cropper-center{display:block;height:0;left:50%;opacity:.75;position:absolute;top:50%;width:0}.cropper-center:after,.cropper-center:before{background-color:#eee;content:\" \";display:block;position:absolute}.cropper-center:before{height:1px;left:-3px;top:0;width:7px}.cropper-center:after{height:7px;left:0;top:-3px;width:1px}.cropper-face,.cropper-line,.cropper-point{display:block;height:100%;opacity:.1;position:absolute;width:100%}.cropper-face{background-color:#fff;left:0;top:0}.cropper-line{background-color:#39f}.cropper-line.line-e{cursor:ew-resize;right:-3px;top:0;width:5px}.cropper-line.line-n{cursor:ns-resize;height:5px;left:0;top:-3px}.cropper-line.line-w{cursor:ew-resize;left:-3px;top:0;width:5px}.cropper-line.line-s{bottom:-3px;cursor:ns-resize;height:5px;left:0}.cropper-point{background-color:#39f;height:5px;opacity:.75;width:5px}.cropper-point.point-e{cursor:ew-resize;margin-top:-3px;right:-3px;top:50%}.cropper-point.point-n{cursor:ns-resize;left:50%;margin-left:-3px;top:-3px}.cropper-point.point-w{cursor:ew-resize;left:-3px;margin-top:-3px;top:50%}.cropper-point.point-s{bottom:-3px;cursor:s-resize;left:50%;margin-left:-3px}.cropper-point.point-ne{cursor:nesw-resize;right:-3px;top:-3px}.cropper-point.point-nw{cursor:nwse-resize;left:-3px;top:-3px}.cropper-point.point-sw{bottom:-3px;cursor:nesw-resize;left:-3px}.cropper-point.point-se{bottom:-3px;cursor:nwse-resize;height:20px;opacity:1;right:-3px;width:20px}@media (min-width:768px){.cropper-point.point-se{height:15px;width:15px}}@media (min-width:992px){.cropper-point.point-se{height:10px;width:10px}}@media (min-width:1200px){.cropper-point.point-se{height:5px;opacity:.75;width:5px}}.cropper-point.point-se:before{background-color:#39f;bottom:-50%;content:\" \";display:block;height:200%;opacity:0;position:absolute;right:-50%;width:200%}.cropper-invisible{opacity:0}.cropper-bg{background-image:url(\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAQMAAAAlPW0iAAAAA3NCSVQICAjb4U/gAAAABlBMVEXMzMz////TjRV2AAAACXBIWXMAAArrAAAK6wGCiw1aAAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M26LyyjAAAABFJREFUCJlj+M/AgBVhF/0PAH6/D/HkDxOGAAAAAElFTkSuQmCC\")}.cropper-hide{display:block;height:0;position:absolute;width:0}.cropper-hidden{display:none!important}.cropper-move{cursor:move}.cropper-crop{cursor:crosshair}.cropper-disabled .cropper-drag-box,.cropper-disabled .cropper-face,.cropper-disabled .cropper-line,.cropper-disabled .cropper-point{cursor:not-allowed}", ""]);

// exports
exports.locals = {
	"cropper-container": "cropper-container",
	"cropper-canvas": "cropper-canvas",
	"cropper-crop-box": "cropper-crop-box",
	"cropper-drag-box": "cropper-drag-box",
	"cropper-modal": "cropper-modal",
	"cropper-wrap-box": "cropper-wrap-box",
	"cropper-view-box": "cropper-view-box",
	"cropper-dashed": "cropper-dashed",
	"dashed-h": "dashed-h",
	"dashed-v": "dashed-v",
	"cropper-center": "cropper-center",
	"cropper-face": "cropper-face",
	"cropper-line": "cropper-line",
	"cropper-point": "cropper-point",
	"line-e": "line-e",
	"line-n": "line-n",
	"line-w": "line-w",
	"line-s": "line-s",
	"point-e": "point-e",
	"point-n": "point-n",
	"point-w": "point-w",
	"point-s": "point-s",
	"point-ne": "point-ne",
	"point-nw": "point-nw",
	"point-sw": "point-sw",
	"point-se": "point-se",
	"cropper-invisible": "cropper-invisible",
	"cropper-bg": "cropper-bg",
	"cropper-hide": "cropper-hide",
	"cropper-hidden": "cropper-hidden",
	"cropper-move": "cropper-move",
	"cropper-crop": "cropper-crop",
	"cropper-disabled": "cropper-disabled"
};

/***/ }),

/***/ 68:
/***/ (function(module, exports, __webpack_require__) {

/*!
 * Cropper v3.1.4
 * https://github.com/fengyuanchen/cropper
 *
 * Copyright (c) 2014-2018 Chen Fengyuan
 * Released under the MIT license
 *
 * Date: 2018-01-13T09:37:52.890Z
 */

(function (global, factory) {
	 true ? factory(__webpack_require__(69)) :
	typeof define === 'function' && define.amd ? define(['jquery'], factory) :
	(factory(global.jQuery));
}(this, (function ($) { 'use strict';

$ = $ && $.hasOwnProperty('default') ? $['default'] : $;

var WINDOW = typeof window !== 'undefined' ? window : {};
var NAMESPACE = 'cropper';

// Actions
var ACTION_ALL = 'all';
var ACTION_CROP = 'crop';
var ACTION_MOVE = 'move';
var ACTION_ZOOM = 'zoom';
var ACTION_EAST = 'e';
var ACTION_WEST = 'w';
var ACTION_SOUTH = 's';
var ACTION_NORTH = 'n';
var ACTION_NORTH_EAST = 'ne';
var ACTION_NORTH_WEST = 'nw';
var ACTION_SOUTH_EAST = 'se';
var ACTION_SOUTH_WEST = 'sw';

// Classes
var CLASS_CROP = NAMESPACE + '-crop';
var CLASS_DISABLED = NAMESPACE + '-disabled';
var CLASS_HIDDEN = NAMESPACE + '-hidden';
var CLASS_HIDE = NAMESPACE + '-hide';
var CLASS_INVISIBLE = NAMESPACE + '-invisible';
var CLASS_MODAL = NAMESPACE + '-modal';
var CLASS_MOVE = NAMESPACE + '-move';

// Data keys
var DATA_ACTION = 'action';
var DATA_PREVIEW = 'preview';

// Drag modes
var DRAG_MODE_CROP = 'crop';
var DRAG_MODE_MOVE = 'move';
var DRAG_MODE_NONE = 'none';

// Events
var EVENT_CROP = 'crop';
var EVENT_CROP_END = 'cropend';
var EVENT_CROP_MOVE = 'cropmove';
var EVENT_CROP_START = 'cropstart';
var EVENT_DBLCLICK = 'dblclick';
var EVENT_ERROR = 'error';
var EVENT_LOAD = 'load';
var EVENT_POINTER_DOWN = WINDOW.PointerEvent ? 'pointerdown' : 'touchstart mousedown';
var EVENT_POINTER_MOVE = WINDOW.PointerEvent ? 'pointermove' : 'touchmove mousemove';
var EVENT_POINTER_UP = WINDOW.PointerEvent ? 'pointerup pointercancel' : 'touchend touchcancel mouseup';
var EVENT_READY = 'ready';
var EVENT_RESIZE = 'resize';
var EVENT_WHEEL = 'wheel mousewheel DOMMouseScroll';
var EVENT_ZOOM = 'zoom';

// RegExps
var REGEXP_ACTIONS = /^(e|w|s|n|se|sw|ne|nw|all|crop|move|zoom)$/;
var REGEXP_DATA_URL = /^data:/;
var REGEXP_DATA_URL_JPEG = /^data:image\/jpeg;base64,/;
var REGEXP_TAG_NAME = /^(img|canvas)$/i;

var DEFAULTS = {
  // Define the view mode of the cropper
  viewMode: 0, // 0, 1, 2, 3

  // Define the dragging mode of the cropper
  dragMode: DRAG_MODE_CROP, // 'crop', 'move' or 'none'

  // Define the aspect ratio of the crop box
  aspectRatio: NaN,

  // An object with the previous cropping result data
  data: null,

  // A selector for adding extra containers to preview
  preview: '',

  // Re-render the cropper when resize the window
  responsive: true,

  // Restore the cropped area after resize the window
  restore: true,

  // Check if the current image is a cross-origin image
  checkCrossOrigin: true,

  // Check the current image's Exif Orientation information
  checkOrientation: true,

  // Show the black modal
  modal: true,

  // Show the dashed lines for guiding
  guides: true,

  // Show the center indicator for guiding
  center: true,

  // Show the white modal to highlight the crop box
  highlight: true,

  // Show the grid background
  background: true,

  // Enable to crop the image automatically when initialize
  autoCrop: true,

  // Define the percentage of automatic cropping area when initializes
  autoCropArea: 0.8,

  // Enable to move the image
  movable: true,

  // Enable to rotate the image
  rotatable: true,

  // Enable to scale the image
  scalable: true,

  // Enable to zoom the image
  zoomable: true,

  // Enable to zoom the image by dragging touch
  zoomOnTouch: true,

  // Enable to zoom the image by wheeling mouse
  zoomOnWheel: true,

  // Define zoom ratio when zoom the image by wheeling mouse
  wheelZoomRatio: 0.1,

  // Enable to move the crop box
  cropBoxMovable: true,

  // Enable to resize the crop box
  cropBoxResizable: true,

  // Toggle drag mode between "crop" and "move" when click twice on the cropper
  toggleDragModeOnDblclick: true,

  // Size limitation
  minCanvasWidth: 0,
  minCanvasHeight: 0,
  minCropBoxWidth: 0,
  minCropBoxHeight: 0,
  minContainerWidth: 200,
  minContainerHeight: 100,

  // Shortcuts of events
  ready: null,
  cropstart: null,
  cropmove: null,
  cropend: null,
  crop: null,
  zoom: null
};

var TEMPLATE = '<div class="cropper-container">' + '<div class="cropper-wrap-box">' + '<div class="cropper-canvas"></div>' + '</div>' + '<div class="cropper-drag-box"></div>' + '<div class="cropper-crop-box">' + '<span class="cropper-view-box"></span>' + '<span class="cropper-dashed dashed-h"></span>' + '<span class="cropper-dashed dashed-v"></span>' + '<span class="cropper-center"></span>' + '<span class="cropper-face"></span>' + '<span class="cropper-line line-e" data-action="e"></span>' + '<span class="cropper-line line-n" data-action="n"></span>' + '<span class="cropper-line line-w" data-action="w"></span>' + '<span class="cropper-line line-s" data-action="s"></span>' + '<span class="cropper-point point-e" data-action="e"></span>' + '<span class="cropper-point point-n" data-action="n"></span>' + '<span class="cropper-point point-w" data-action="w"></span>' + '<span class="cropper-point point-s" data-action="s"></span>' + '<span class="cropper-point point-ne" data-action="ne"></span>' + '<span class="cropper-point point-nw" data-action="nw"></span>' + '<span class="cropper-point point-sw" data-action="sw"></span>' + '<span class="cropper-point point-se" data-action="se"></span>' + '</div>' + '</div>';

var classCallCheck = function (instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
};

var createClass = function () {
  function defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  return function (Constructor, protoProps, staticProps) {
    if (protoProps) defineProperties(Constructor.prototype, protoProps);
    if (staticProps) defineProperties(Constructor, staticProps);
    return Constructor;
  };
}();









































var toConsumableArray = function (arr) {
  if (Array.isArray(arr)) {
    for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) arr2[i] = arr[i];

    return arr2;
  } else {
    return Array.from(arr);
  }
};

/**
 * Check if the given value is a string.
 * @param {*} value - The value to check.
 * @returns {boolean} Returns `true` if the given value is a string, else `false`.
 */
function isString(value) {
  return typeof value === 'string';
}

/**
 * Check if the given value is not a number.
 */
var isNaN = Number.isNaN || WINDOW.isNaN;

/**
 * Check if the given value is a number.
 * @param {*} value - The value to check.
 * @returns {boolean} Returns `true` if the given value is a number, else `false`.
 */
function isNumber(value) {
  return typeof value === 'number' && !isNaN(value);
}

/**
 * Check if the given value is undefined.
 * @param {*} value - The value to check.
 * @returns {boolean} Returns `true` if the given value is undefined, else `false`.
 */
function isUndefined(value) {
  return typeof value === 'undefined';
}

/**
 * Takes a function and returns a new one that will always have a particular context.
 * Custom proxy to avoid jQuery's guid.
 * @param {Function} fn - The target function.
 * @param {Object} context - The new context for the function.
 * @returns {Function} The new function.
 */
function proxy(fn, context) {
  for (var _len = arguments.length, args = Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
    args[_key - 2] = arguments[_key];
  }

  return function () {
    for (var _len2 = arguments.length, args2 = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args2[_key2] = arguments[_key2];
    }

    return fn.apply(context, args.concat(args2));
  };
}

/**
 * Get the own enumerable properties of a given object.
 * @param {Object} obj - The target object.
 * @returns {Array} All the own enumerable properties of the given object.
 */
var objectKeys = Object.keys || function objectKeys(obj) {
  var keys = [];

  $.each(obj, function (key) {
    keys.push(key);
  });

  return keys;
};

var REGEXP_DECIMALS = /\.\d*(?:0|9){12}\d*$/i;

/**
 * Normalize decimal number.
 * Check out {@link http://0.30000000000000004.com/ }
 * @param {number} value - The value to normalize.
 * @param {number} [times=100000000000] - The times for normalizing.
 * @returns {number} Returns the normalized number.
 */
function normalizeDecimalNumber(value) {
  var times = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 100000000000;

  return REGEXP_DECIMALS.test(value) ? Math.round(value * times) / times : value;
}

var location = WINDOW.location;

var REGEXP_ORIGINS = /^(https?:)\/\/([^:/?#]+):?(\d*)/i;

/**
 * Check if the given URL is a cross origin URL.
 * @param {string} url - The target URL.
 * @returns {boolean} Returns `true` if the given URL is a cross origin URL, else `false`.
 */
function isCrossOriginURL(url) {
  var parts = url.match(REGEXP_ORIGINS);

  return parts && (parts[1] !== location.protocol || parts[2] !== location.hostname || parts[3] !== location.port);
}

/**
 * Add timestamp to the given URL.
 * @param {string} url - The target URL.
 * @returns {string} The result URL.
 */
function addTimestamp(url) {
  var timestamp = 'timestamp=' + new Date().getTime();

  return url + (url.indexOf('?') === -1 ? '?' : '&') + timestamp;
}

/**
 * Get transform values base on the given object.
 * @param {Object} obj - The target object.
 * @returns {string} A string contains transform values.
 */
function getTransformValues(_ref) {
  var rotate = _ref.rotate,
      scaleX = _ref.scaleX,
      scaleY = _ref.scaleY,
      translateX = _ref.translateX,
      translateY = _ref.translateY;

  var values = [];

  if (isNumber(translateX) && translateX !== 0) {
    values.push('translateX(' + translateX + 'px)');
  }

  if (isNumber(translateY) && translateY !== 0) {
    values.push('translateY(' + translateY + 'px)');
  }

  // Rotate should come first before scale to match orientation transform
  if (isNumber(rotate) && rotate !== 0) {
    values.push('rotate(' + rotate + 'deg)');
  }

  if (isNumber(scaleX) && scaleX !== 1) {
    values.push('scaleX(' + scaleX + ')');
  }

  if (isNumber(scaleY) && scaleY !== 1) {
    values.push('scaleY(' + scaleY + ')');
  }

  return values.length ? values.join(' ') : 'none';
}

var navigator = WINDOW.navigator;

var IS_SAFARI_OR_UIWEBVIEW = navigator && /(Macintosh|iPhone|iPod|iPad).*AppleWebKit/i.test(navigator.userAgent);

/**
 * Get an image's natural sizes.
 * @param {string} image - The target image.
 * @param {Function} callback - The callback function.
 */
function getImageNaturalSizes(image, callback) {
  // Modern browsers (except Safari)
  if (image.naturalWidth && !IS_SAFARI_OR_UIWEBVIEW) {
    callback(image.naturalWidth, image.naturalHeight);
    return;
  }

  var newImage = document.createElement('img');

  newImage.onload = function () {
    callback(newImage.width, newImage.height);
  };

  newImage.src = image.src;
}

/**
 * Get the max ratio of a group of pointers.
 * @param {string} pointers - The target pointers.
 * @returns {number} The result ratio.
 */
function getMaxZoomRatio(pointers) {
  var pointers2 = $.extend({}, pointers);
  var ratios = [];

  $.each(pointers, function (pointerId, pointer) {
    delete pointers2[pointerId];

    $.each(pointers2, function (pointerId2, pointer2) {
      var x1 = Math.abs(pointer.startX - pointer2.startX);
      var y1 = Math.abs(pointer.startY - pointer2.startY);
      var x2 = Math.abs(pointer.endX - pointer2.endX);
      var y2 = Math.abs(pointer.endY - pointer2.endY);
      var z1 = Math.sqrt(x1 * x1 + y1 * y1);
      var z2 = Math.sqrt(x2 * x2 + y2 * y2);
      var ratio = (z2 - z1) / z1;

      ratios.push(ratio);
    });
  });

  ratios.sort(function (a, b) {
    return Math.abs(a) < Math.abs(b);
  });

  return ratios[0];
}

/**
 * Get a pointer from an event object.
 * @param {Object} event - The target event object.
 * @param {boolean} endOnly - Indicates if only returns the end point coordinate or not.
 * @returns {Object} The result pointer contains start and/or end point coordinates.
 */
function getPointer(_ref2, endOnly) {
  var pageX = _ref2.pageX,
      pageY = _ref2.pageY;

  var end = {
    endX: pageX,
    endY: pageY
  };

  if (endOnly) {
    return end;
  }

  return $.extend({
    startX: pageX,
    startY: pageY
  }, end);
}

/**
 * Get the center point coordinate of a group of pointers.
 * @param {Object} pointers - The target pointers.
 * @returns {Object} The center point coordinate.
 */
function getPointersCenter(pointers) {
  var pageX = 0;
  var pageY = 0;
  var count = 0;

  $.each(pointers, function (pointerId, _ref3) {
    var startX = _ref3.startX,
        startY = _ref3.startY;

    pageX += startX;
    pageY += startY;
    count += 1;
  });

  pageX /= count;
  pageY /= count;

  return {
    pageX: pageX,
    pageY: pageY
  };
}

/**
 * Check if the given value is a finite number.
 */
var isFinite = Number.isFinite || WINDOW.isFinite;

/**
 * Get the max sizes in a rectangle under the given aspect ratio.
 * @param {Object} data - The original sizes.
 * @returns {Object} The result sizes.
 */
function getContainSizes(_ref4) {
  var aspectRatio = _ref4.aspectRatio,
      height = _ref4.height,
      width = _ref4.width;

  var isValidNumber = function isValidNumber(value) {
    return isFinite(value) && value > 0;
  };

  if (isValidNumber(width) && isValidNumber(height)) {
    if (height * aspectRatio > width) {
      height = width / aspectRatio;
    } else {
      width = height * aspectRatio;
    }
  } else if (isValidNumber(width)) {
    height = width / aspectRatio;
  } else if (isValidNumber(height)) {
    width = height * aspectRatio;
  }

  return {
    width: width,
    height: height
  };
}

/**
 * Get the new sizes of a rectangle after rotated.
 * @param {Object} data - The original sizes.
 * @returns {Object} The result sizes.
 */
function getRotatedSizes(_ref5) {
  var width = _ref5.width,
      height = _ref5.height,
      degree = _ref5.degree;

  degree = Math.abs(degree) % 180;

  if (degree === 90) {
    return {
      width: height,
      height: width
    };
  }

  var arc = degree % 90 * Math.PI / 180;
  var sinArc = Math.sin(arc);
  var cosArc = Math.cos(arc);
  var newWidth = width * cosArc + height * sinArc;
  var newHeight = width * sinArc + height * cosArc;

  return degree > 90 ? {
    width: newHeight,
    height: newWidth
  } : {
    width: newWidth,
    height: newHeight
  };
}

/**
 * Get a canvas which drew the given image.
 * @param {HTMLImageElement} image - The image for drawing.
 * @param {Object} imageData - The image data.
 * @param {Object} canvasData - The canvas data.
 * @param {Object} options - The options.
 * @returns {HTMLCanvasElement} The result canvas.
 */
function getSourceCanvas(image, _ref6, _ref7, _ref8) {
  var imageNaturalWidth = _ref6.naturalWidth,
      imageNaturalHeight = _ref6.naturalHeight,
      _ref6$rotate = _ref6.rotate,
      rotate = _ref6$rotate === undefined ? 0 : _ref6$rotate,
      _ref6$scaleX = _ref6.scaleX,
      scaleX = _ref6$scaleX === undefined ? 1 : _ref6$scaleX,
      _ref6$scaleY = _ref6.scaleY,
      scaleY = _ref6$scaleY === undefined ? 1 : _ref6$scaleY;
  var aspectRatio = _ref7.aspectRatio,
      naturalWidth = _ref7.naturalWidth,
      naturalHeight = _ref7.naturalHeight;
  var _ref8$fillColor = _ref8.fillColor,
      fillColor = _ref8$fillColor === undefined ? 'transparent' : _ref8$fillColor,
      _ref8$imageSmoothingE = _ref8.imageSmoothingEnabled,
      imageSmoothingEnabled = _ref8$imageSmoothingE === undefined ? true : _ref8$imageSmoothingE,
      _ref8$imageSmoothingQ = _ref8.imageSmoothingQuality,
      imageSmoothingQuality = _ref8$imageSmoothingQ === undefined ? 'low' : _ref8$imageSmoothingQ,
      _ref8$maxWidth = _ref8.maxWidth,
      maxWidth = _ref8$maxWidth === undefined ? Infinity : _ref8$maxWidth,
      _ref8$maxHeight = _ref8.maxHeight,
      maxHeight = _ref8$maxHeight === undefined ? Infinity : _ref8$maxHeight,
      _ref8$minWidth = _ref8.minWidth,
      minWidth = _ref8$minWidth === undefined ? 0 : _ref8$minWidth,
      _ref8$minHeight = _ref8.minHeight,
      minHeight = _ref8$minHeight === undefined ? 0 : _ref8$minHeight;

  var maxSizes = getContainSizes({
    aspectRatio: aspectRatio,
    width: maxWidth,
    height: maxHeight
  });
  var minSizes = getContainSizes({
    aspectRatio: aspectRatio,
    width: minWidth,
    height: minHeight
  });
  var width = Math.min(maxSizes.width, Math.max(minSizes.width, naturalWidth));
  var height = Math.min(maxSizes.height, Math.max(minSizes.height, naturalHeight));
  var canvas = document.createElement('canvas');
  var context = canvas.getContext('2d');
  var params = [-imageNaturalWidth / 2, -imageNaturalHeight / 2, imageNaturalWidth, imageNaturalHeight];

  canvas.width = normalizeDecimalNumber(width);
  canvas.height = normalizeDecimalNumber(height);
  context.fillStyle = fillColor;
  context.fillRect(0, 0, width, height);
  context.save();
  context.translate(width / 2, height / 2);
  context.rotate(rotate * Math.PI / 180);
  context.scale(scaleX, scaleY);
  context.imageSmoothingEnabled = !!imageSmoothingEnabled;
  context.imageSmoothingQuality = imageSmoothingQuality;
  context.drawImage.apply(context, [image].concat(toConsumableArray($.map(params, function (param) {
    return Math.floor(normalizeDecimalNumber(param));
  }))));
  context.restore();
  return canvas;
}

var fromCharCode = String.fromCharCode;

/**
 * Get string from char code in data view.
 * @param {DataView} dataView - The data view for read.
 * @param {number} start - The start index.
 * @param {number} length - The read length.
 * @returns {string} The read result.
 */

function getStringFromCharCode(dataView, start, length) {
  var str = '';
  var i = void 0;

  length += start;

  for (i = start; i < length; i += 1) {
    str += fromCharCode(dataView.getUint8(i));
  }

  return str;
}

var REGEXP_DATA_URL_HEAD = /^data:.*,/;

/**
 * Transform Data URL to array buffer.
 * @param {string} dataURL - The Data URL to transform.
 * @returns {ArrayBuffer} The result array buffer.
 */
function dataURLToArrayBuffer(dataURL) {
  var base64 = dataURL.replace(REGEXP_DATA_URL_HEAD, '');
  var binary = atob(base64);
  var arrayBuffer = new ArrayBuffer(binary.length);
  var uint8 = new Uint8Array(arrayBuffer);

  $.each(uint8, function (i) {
    uint8[i] = binary.charCodeAt(i);
  });

  return arrayBuffer;
}

/**
 * Transform array buffer to Data URL.
 * @param {ArrayBuffer} arrayBuffer - The array buffer to transform.
 * @param {string} mimeType - The mime type of the Data URL.
 * @returns {string} The result Data URL.
 */
function arrayBufferToDataURL(arrayBuffer, mimeType) {
  var uint8 = new Uint8Array(arrayBuffer);
  var data = '';

  // TypedArray.prototype.forEach is not supported in some browsers.
  $.each(uint8, function (i, value) {
    data += fromCharCode(value);
  });

  return 'data:' + mimeType + ';base64,' + btoa(data);
}

/**
 * Get orientation value from given array buffer.
 * @param {ArrayBuffer} arrayBuffer - The array buffer to read.
 * @returns {number} The read orientation value.
 */
function getOrientation(arrayBuffer) {
  var dataView = new DataView(arrayBuffer);
  var orientation = void 0;
  var littleEndian = void 0;
  var app1Start = void 0;
  var ifdStart = void 0;

  // Only handle JPEG image (start by 0xFFD8)
  if (dataView.getUint8(0) === 0xFF && dataView.getUint8(1) === 0xD8) {
    var length = dataView.byteLength;
    var offset = 2;

    while (offset < length) {
      if (dataView.getUint8(offset) === 0xFF && dataView.getUint8(offset + 1) === 0xE1) {
        app1Start = offset;
        break;
      }

      offset += 1;
    }
  }

  if (app1Start) {
    var exifIDCode = app1Start + 4;
    var tiffOffset = app1Start + 10;

    if (getStringFromCharCode(dataView, exifIDCode, 4) === 'Exif') {
      var endianness = dataView.getUint16(tiffOffset);

      littleEndian = endianness === 0x4949;

      if (littleEndian || endianness === 0x4D4D /* bigEndian */) {
          if (dataView.getUint16(tiffOffset + 2, littleEndian) === 0x002A) {
            var firstIFDOffset = dataView.getUint32(tiffOffset + 4, littleEndian);

            if (firstIFDOffset >= 0x00000008) {
              ifdStart = tiffOffset + firstIFDOffset;
            }
          }
        }
    }
  }

  if (ifdStart) {
    var _length = dataView.getUint16(ifdStart, littleEndian);
    var _offset = void 0;
    var i = void 0;

    for (i = 0; i < _length; i += 1) {
      _offset = ifdStart + i * 12 + 2;

      if (dataView.getUint16(_offset, littleEndian) === 0x0112 /* Orientation */) {
          // 8 is the offset of the current tag's value
          _offset += 8;

          // Get the original orientation value
          orientation = dataView.getUint16(_offset, littleEndian);

          // Override the orientation with its default value
          dataView.setUint16(_offset, 1, littleEndian);
          break;
        }
    }
  }

  return orientation;
}

/**
 * Parse Exif Orientation value.
 * @param {number} orientation - The orientation to parse.
 * @returns {Object} The parsed result.
 */
function parseOrientation(orientation) {
  var rotate = 0;
  var scaleX = 1;
  var scaleY = 1;

  switch (orientation) {
    // Flip horizontal
    case 2:
      scaleX = -1;
      break;

    // Rotate left 180°
    case 3:
      rotate = -180;
      break;

    // Flip vertical
    case 4:
      scaleY = -1;
      break;

    // Flip vertical and rotate right 90°
    case 5:
      rotate = 90;
      scaleY = -1;
      break;

    // Rotate right 90°
    case 6:
      rotate = 90;
      break;

    // Flip horizontal and rotate right 90°
    case 7:
      rotate = 90;
      scaleX = -1;
      break;

    // Rotate left 90°
    case 8:
      rotate = -90;
      break;

    default:
  }

  return {
    rotate: rotate,
    scaleX: scaleX,
    scaleY: scaleY
  };
}

var render = {
  render: function render() {
    this.initContainer();
    this.initCanvas();
    this.initCropBox();
    this.renderCanvas();

    if (this.cropped) {
      this.renderCropBox();
    }
  },
  initContainer: function initContainer() {
    var $element = this.$element,
        options = this.options,
        $container = this.$container,
        $cropper = this.$cropper;


    $cropper.addClass(CLASS_HIDDEN);
    $element.removeClass(CLASS_HIDDEN);

    $cropper.css(this.container = {
      width: Math.max($container.width(), Number(options.minContainerWidth) || 200),
      height: Math.max($container.height(), Number(options.minContainerHeight) || 100)
    });

    $element.addClass(CLASS_HIDDEN);
    $cropper.removeClass(CLASS_HIDDEN);
  },


  // Canvas (image wrapper)
  initCanvas: function initCanvas() {
    var container = this.container,
        image = this.image;
    var viewMode = this.options.viewMode;

    var rotated = Math.abs(image.rotate) % 180 === 90;
    var naturalWidth = rotated ? image.naturalHeight : image.naturalWidth;
    var naturalHeight = rotated ? image.naturalWidth : image.naturalHeight;
    var aspectRatio = naturalWidth / naturalHeight;
    var canvasWidth = container.width;
    var canvasHeight = container.height;

    if (container.height * aspectRatio > container.width) {
      if (viewMode === 3) {
        canvasWidth = container.height * aspectRatio;
      } else {
        canvasHeight = container.width / aspectRatio;
      }
    } else if (viewMode === 3) {
      canvasHeight = container.width / aspectRatio;
    } else {
      canvasWidth = container.height * aspectRatio;
    }

    var canvas = {
      aspectRatio: aspectRatio,
      naturalWidth: naturalWidth,
      naturalHeight: naturalHeight,
      width: canvasWidth,
      height: canvasHeight
    };

    canvas.left = (container.width - canvasWidth) / 2;
    canvas.top = (container.height - canvasHeight) / 2;
    canvas.oldLeft = canvas.left;
    canvas.oldTop = canvas.top;

    this.canvas = canvas;
    this.limited = viewMode === 1 || viewMode === 2;
    this.limitCanvas(true, true);
    this.initialImage = $.extend({}, image);
    this.initialCanvas = $.extend({}, canvas);
  },
  limitCanvas: function limitCanvas(isSizeLimited, isPositionLimited) {
    var options = this.options,
        container = this.container,
        canvas = this.canvas,
        cropBox = this.cropBox;
    var viewMode = options.viewMode;
    var aspectRatio = canvas.aspectRatio;

    var cropped = this.cropped && cropBox;

    if (isSizeLimited) {
      var minCanvasWidth = Number(options.minCanvasWidth) || 0;
      var minCanvasHeight = Number(options.minCanvasHeight) || 0;

      if (viewMode > 0) {
        if (viewMode > 1) {
          minCanvasWidth = Math.max(minCanvasWidth, container.width);
          minCanvasHeight = Math.max(minCanvasHeight, container.height);

          if (viewMode === 3) {
            if (minCanvasHeight * aspectRatio > minCanvasWidth) {
              minCanvasWidth = minCanvasHeight * aspectRatio;
            } else {
              minCanvasHeight = minCanvasWidth / aspectRatio;
            }
          }
        } else if (minCanvasWidth) {
          minCanvasWidth = Math.max(minCanvasWidth, cropped ? cropBox.width : 0);
        } else if (minCanvasHeight) {
          minCanvasHeight = Math.max(minCanvasHeight, cropped ? cropBox.height : 0);
        } else if (cropped) {
          minCanvasWidth = cropBox.width;
          minCanvasHeight = cropBox.height;

          if (minCanvasHeight * aspectRatio > minCanvasWidth) {
            minCanvasWidth = minCanvasHeight * aspectRatio;
          } else {
            minCanvasHeight = minCanvasWidth / aspectRatio;
          }
        }
      }

      var _getContainSizes = getContainSizes({
        aspectRatio: aspectRatio,
        width: minCanvasWidth,
        height: minCanvasHeight
      });

      minCanvasWidth = _getContainSizes.width;
      minCanvasHeight = _getContainSizes.height;


      canvas.minWidth = minCanvasWidth;
      canvas.minHeight = minCanvasHeight;
      canvas.maxWidth = Infinity;
      canvas.maxHeight = Infinity;
    }

    if (isPositionLimited) {
      if (viewMode > 0) {
        var newCanvasLeft = container.width - canvas.width;
        var newCanvasTop = container.height - canvas.height;

        canvas.minLeft = Math.min(0, newCanvasLeft);
        canvas.minTop = Math.min(0, newCanvasTop);
        canvas.maxLeft = Math.max(0, newCanvasLeft);
        canvas.maxTop = Math.max(0, newCanvasTop);

        if (cropped && this.limited) {
          canvas.minLeft = Math.min(cropBox.left, cropBox.left + cropBox.width - canvas.width);
          canvas.minTop = Math.min(cropBox.top, cropBox.top + cropBox.height - canvas.height);
          canvas.maxLeft = cropBox.left;
          canvas.maxTop = cropBox.top;

          if (viewMode === 2) {
            if (canvas.width >= container.width) {
              canvas.minLeft = Math.min(0, newCanvasLeft);
              canvas.maxLeft = Math.max(0, newCanvasLeft);
            }

            if (canvas.height >= container.height) {
              canvas.minTop = Math.min(0, newCanvasTop);
              canvas.maxTop = Math.max(0, newCanvasTop);
            }
          }
        }
      } else {
        canvas.minLeft = -canvas.width;
        canvas.minTop = -canvas.height;
        canvas.maxLeft = container.width;
        canvas.maxTop = container.height;
      }
    }
  },
  renderCanvas: function renderCanvas(changed, transformed) {
    var canvas = this.canvas,
        image = this.image;


    if (transformed) {
      var _getRotatedSizes = getRotatedSizes({
        width: image.naturalWidth * Math.abs(image.scaleX || 1),
        height: image.naturalHeight * Math.abs(image.scaleY || 1),
        degree: image.rotate || 0
      }),
          naturalWidth = _getRotatedSizes.width,
          naturalHeight = _getRotatedSizes.height;

      var width = canvas.width * (naturalWidth / canvas.naturalWidth);
      var height = canvas.height * (naturalHeight / canvas.naturalHeight);

      canvas.left -= (width - canvas.width) / 2;
      canvas.top -= (height - canvas.height) / 2;
      canvas.width = width;
      canvas.height = height;
      canvas.aspectRatio = naturalWidth / naturalHeight;
      canvas.naturalWidth = naturalWidth;
      canvas.naturalHeight = naturalHeight;
      this.limitCanvas(true, false);
    }

    if (canvas.width > canvas.maxWidth || canvas.width < canvas.minWidth) {
      canvas.left = canvas.oldLeft;
    }

    if (canvas.height > canvas.maxHeight || canvas.height < canvas.minHeight) {
      canvas.top = canvas.oldTop;
    }

    canvas.width = Math.min(Math.max(canvas.width, canvas.minWidth), canvas.maxWidth);
    canvas.height = Math.min(Math.max(canvas.height, canvas.minHeight), canvas.maxHeight);

    this.limitCanvas(false, true);

    canvas.left = Math.min(Math.max(canvas.left, canvas.minLeft), canvas.maxLeft);
    canvas.top = Math.min(Math.max(canvas.top, canvas.minTop), canvas.maxTop);
    canvas.oldLeft = canvas.left;
    canvas.oldTop = canvas.top;

    this.$canvas.css({
      width: canvas.width,
      height: canvas.height,
      transform: getTransformValues({
        translateX: canvas.left,
        translateY: canvas.top
      })
    });

    this.renderImage(changed);

    if (this.cropped && this.limited) {
      this.limitCropBox(true, true);
    }
  },
  renderImage: function renderImage(changed) {
    var canvas = this.canvas,
        image = this.image;

    var width = image.naturalWidth * (canvas.width / canvas.naturalWidth);
    var height = image.naturalHeight * (canvas.height / canvas.naturalHeight);

    $.extend(image, {
      width: width,
      height: height,
      left: (canvas.width - width) / 2,
      top: (canvas.height - height) / 2
    });

    this.$clone.css({
      width: image.width,
      height: image.height,
      transform: getTransformValues($.extend({
        translateX: image.left,
        translateY: image.top
      }, image))
    });

    if (changed) {
      this.output();
    }
  },
  initCropBox: function initCropBox() {
    var options = this.options,
        canvas = this.canvas;
    var aspectRatio = options.aspectRatio;

    var autoCropArea = Number(options.autoCropArea) || 0.8;
    var cropBox = {
      width: canvas.width,
      height: canvas.height
    };

    if (aspectRatio) {
      if (canvas.height * aspectRatio > canvas.width) {
        cropBox.height = cropBox.width / aspectRatio;
      } else {
        cropBox.width = cropBox.height * aspectRatio;
      }
    }

    this.cropBox = cropBox;
    this.limitCropBox(true, true);

    // Initialize auto crop area
    cropBox.width = Math.min(Math.max(cropBox.width, cropBox.minWidth), cropBox.maxWidth);
    cropBox.height = Math.min(Math.max(cropBox.height, cropBox.minHeight), cropBox.maxHeight);

    // The width of auto crop area must large than "minWidth", and the height too. (#164)
    cropBox.width = Math.max(cropBox.minWidth, cropBox.width * autoCropArea);
    cropBox.height = Math.max(cropBox.minHeight, cropBox.height * autoCropArea);
    cropBox.left = canvas.left + (canvas.width - cropBox.width) / 2;
    cropBox.top = canvas.top + (canvas.height - cropBox.height) / 2;
    cropBox.oldLeft = cropBox.left;
    cropBox.oldTop = cropBox.top;

    this.initialCropBox = $.extend({}, cropBox);
  },
  limitCropBox: function limitCropBox(isSizeLimited, isPositionLimited) {
    var options = this.options,
        container = this.container,
        canvas = this.canvas,
        cropBox = this.cropBox,
        limited = this.limited;
    var aspectRatio = options.aspectRatio;


    if (isSizeLimited) {
      var minCropBoxWidth = Number(options.minCropBoxWidth) || 0;
      var minCropBoxHeight = Number(options.minCropBoxHeight) || 0;
      var maxCropBoxWidth = Math.min(container.width, limited ? canvas.width : container.width);
      var maxCropBoxHeight = Math.min(container.height, limited ? canvas.height : container.height);

      // The min/maxCropBoxWidth/Height must be less than container's width/Height
      minCropBoxWidth = Math.min(minCropBoxWidth, container.width);
      minCropBoxHeight = Math.min(minCropBoxHeight, container.height);

      if (aspectRatio) {
        if (minCropBoxWidth && minCropBoxHeight) {
          if (minCropBoxHeight * aspectRatio > minCropBoxWidth) {
            minCropBoxHeight = minCropBoxWidth / aspectRatio;
          } else {
            minCropBoxWidth = minCropBoxHeight * aspectRatio;
          }
        } else if (minCropBoxWidth) {
          minCropBoxHeight = minCropBoxWidth / aspectRatio;
        } else if (minCropBoxHeight) {
          minCropBoxWidth = minCropBoxHeight * aspectRatio;
        }

        if (maxCropBoxHeight * aspectRatio > maxCropBoxWidth) {
          maxCropBoxHeight = maxCropBoxWidth / aspectRatio;
        } else {
          maxCropBoxWidth = maxCropBoxHeight * aspectRatio;
        }
      }

      // The minWidth/Height must be less than maxWidth/Height
      cropBox.minWidth = Math.min(minCropBoxWidth, maxCropBoxWidth);
      cropBox.minHeight = Math.min(minCropBoxHeight, maxCropBoxHeight);
      cropBox.maxWidth = maxCropBoxWidth;
      cropBox.maxHeight = maxCropBoxHeight;
    }

    if (isPositionLimited) {
      if (limited) {
        cropBox.minLeft = Math.max(0, canvas.left);
        cropBox.minTop = Math.max(0, canvas.top);
        cropBox.maxLeft = Math.min(container.width, canvas.left + canvas.width) - cropBox.width;
        cropBox.maxTop = Math.min(container.height, canvas.top + canvas.height) - cropBox.height;
      } else {
        cropBox.minLeft = 0;
        cropBox.minTop = 0;
        cropBox.maxLeft = container.width - cropBox.width;
        cropBox.maxTop = container.height - cropBox.height;
      }
    }
  },
  renderCropBox: function renderCropBox() {
    var options = this.options,
        container = this.container,
        cropBox = this.cropBox;


    if (cropBox.width > cropBox.maxWidth || cropBox.width < cropBox.minWidth) {
      cropBox.left = cropBox.oldLeft;
    }

    if (cropBox.height > cropBox.maxHeight || cropBox.height < cropBox.minHeight) {
      cropBox.top = cropBox.oldTop;
    }

    cropBox.width = Math.min(Math.max(cropBox.width, cropBox.minWidth), cropBox.maxWidth);
    cropBox.height = Math.min(Math.max(cropBox.height, cropBox.minHeight), cropBox.maxHeight);

    this.limitCropBox(false, true);

    cropBox.left = Math.min(Math.max(cropBox.left, cropBox.minLeft), cropBox.maxLeft);
    cropBox.top = Math.min(Math.max(cropBox.top, cropBox.minTop), cropBox.maxTop);
    cropBox.oldLeft = cropBox.left;
    cropBox.oldTop = cropBox.top;

    if (options.movable && options.cropBoxMovable) {
      // Turn to move the canvas when the crop box is equal to the container
      this.$face.data(DATA_ACTION, cropBox.width >= container.width && cropBox.height >= container.height ? ACTION_MOVE : ACTION_ALL);
    }

    this.$cropBox.css({
      width: cropBox.width,
      height: cropBox.height,
      transform: getTransformValues({
        translateX: cropBox.left,
        translateY: cropBox.top
      })
    });

    if (this.cropped && this.limited) {
      this.limitCanvas(true, true);
    }

    if (!this.disabled) {
      this.output();
    }
  },
  output: function output() {
    this.preview();

    if (this.completed) {
      this.trigger(EVENT_CROP, this.getData());
    }
  }
};

var preview = {
  initPreview: function initPreview() {
    var crossOrigin = this.crossOrigin;

    var url = crossOrigin ? this.crossOriginUrl : this.url;
    var image = document.createElement('img');

    if (crossOrigin) {
      image.crossOrigin = crossOrigin;
    }

    image.src = url;

    var $clone2 = $(image);

    this.$preview = $(this.options.preview);
    this.$clone2 = $clone2;
    this.$viewBox.html($clone2);
    this.$preview.each(function (i, element) {
      var $element = $(element);
      var img = document.createElement('img');

      // Save the original size for recover
      $element.data(DATA_PREVIEW, {
        width: $element.width(),
        height: $element.height(),
        html: $element.html()
      });

      if (crossOrigin) {
        img.crossOrigin = crossOrigin;
      }

      img.src = url;

      /**
       * Override img element styles
       * Add `display:block` to avoid margin top issue
       * Add `height:auto` to override `height` attribute on IE8
       * (Occur only when margin-top <= -height)
       */
      img.style.cssText = 'display:block;' + 'width:100%;' + 'height:auto;' + 'min-width:0!important;' + 'min-height:0!important;' + 'max-width:none!important;' + 'max-height:none!important;' + 'image-orientation:0deg!important;"';

      $element.html(img);
    });
  },
  resetPreview: function resetPreview() {
    this.$preview.each(function (i, element) {
      var $element = $(element);
      var data = $element.data(DATA_PREVIEW);

      $element.css({
        width: data.width,
        height: data.height
      }).html(data.html).removeData(DATA_PREVIEW);
    });
  },
  preview: function preview() {
    var image = this.image,
        canvas = this.canvas,
        cropBox = this.cropBox;
    var cropBoxWidth = cropBox.width,
        cropBoxHeight = cropBox.height;
    var width = image.width,
        height = image.height;

    var left = cropBox.left - canvas.left - image.left;
    var top = cropBox.top - canvas.top - image.top;

    if (!this.cropped || this.disabled) {
      return;
    }

    this.$clone2.css({
      width: width,
      height: height,
      transform: getTransformValues($.extend({
        translateX: -left,
        translateY: -top
      }, image))
    });

    this.$preview.each(function (i, element) {
      var $element = $(element);
      var data = $element.data(DATA_PREVIEW);
      var originalWidth = data.width;
      var originalHeight = data.height;
      var newWidth = originalWidth;
      var newHeight = originalHeight;
      var ratio = 1;

      if (cropBoxWidth) {
        ratio = originalWidth / cropBoxWidth;
        newHeight = cropBoxHeight * ratio;
      }

      if (cropBoxHeight && newHeight > originalHeight) {
        ratio = originalHeight / cropBoxHeight;
        newWidth = cropBoxWidth * ratio;
        newHeight = originalHeight;
      }

      $element.css({
        width: newWidth,
        height: newHeight
      }).find('img').css({
        width: width * ratio,
        height: height * ratio,
        transform: getTransformValues($.extend({
          translateX: -left * ratio,
          translateY: -top * ratio
        }, image))
      });
    });
  }
};

var events = {
  bind: function bind() {
    var $element = this.$element,
        options = this.options,
        $cropper = this.$cropper;


    if ($.isFunction(options.cropstart)) {
      $element.on(EVENT_CROP_START, options.cropstart);
    }

    if ($.isFunction(options.cropmove)) {
      $element.on(EVENT_CROP_MOVE, options.cropmove);
    }

    if ($.isFunction(options.cropend)) {
      $element.on(EVENT_CROP_END, options.cropend);
    }

    if ($.isFunction(options.crop)) {
      $element.on(EVENT_CROP, options.crop);
    }

    if ($.isFunction(options.zoom)) {
      $element.on(EVENT_ZOOM, options.zoom);
    }

    $cropper.on(EVENT_POINTER_DOWN, proxy(this.cropStart, this));

    if (options.zoomable && options.zoomOnWheel) {
      $cropper.on(EVENT_WHEEL, proxy(this.wheel, this));
    }

    if (options.toggleDragModeOnDblclick) {
      $cropper.on(EVENT_DBLCLICK, proxy(this.dblclick, this));
    }

    $(this.element.ownerDocument).on(EVENT_POINTER_MOVE, this.onCropMove = proxy(this.cropMove, this)).on(EVENT_POINTER_UP, this.onCropEnd = proxy(this.cropEnd, this));

    if (options.responsive) {
      $(window).on(EVENT_RESIZE, this.onResize = proxy(this.resize, this));
    }
  },
  unbind: function unbind() {
    var $element = this.$element,
        options = this.options,
        $cropper = this.$cropper;


    if ($.isFunction(options.cropstart)) {
      $element.off(EVENT_CROP_START, options.cropstart);
    }

    if ($.isFunction(options.cropmove)) {
      $element.off(EVENT_CROP_MOVE, options.cropmove);
    }

    if ($.isFunction(options.cropend)) {
      $element.off(EVENT_CROP_END, options.cropend);
    }

    if ($.isFunction(options.crop)) {
      $element.off(EVENT_CROP, options.crop);
    }

    if ($.isFunction(options.zoom)) {
      $element.off(EVENT_ZOOM, options.zoom);
    }

    $cropper.off(EVENT_POINTER_DOWN, this.cropStart);

    if (options.zoomable && options.zoomOnWheel) {
      $cropper.off(EVENT_WHEEL, this.wheel);
    }

    if (options.toggleDragModeOnDblclick) {
      $cropper.off(EVENT_DBLCLICK, this.dblclick);
    }

    $(this.element.ownerDocument).off(EVENT_POINTER_MOVE, this.onCropMove).off(EVENT_POINTER_UP, this.onCropEnd);

    if (options.responsive) {
      $(window).off(EVENT_RESIZE, this.onResize);
    }
  }
};

var handlers = {
  resize: function resize() {
    var options = this.options,
        $container = this.$container,
        container = this.container;

    var minContainerWidth = Number(options.minContainerWidth) || 200;
    var minContainerHeight = Number(options.minContainerHeight) || 100;

    if (this.disabled || container.width <= minContainerWidth || container.height <= minContainerHeight) {
      return;
    }

    var ratio = $container.width() / container.width;

    // Resize when width changed or height changed
    if (ratio !== 1 || $container.height() !== container.height) {
      var canvasData = void 0;
      var cropBoxData = void 0;

      if (options.restore) {
        canvasData = this.getCanvasData();
        cropBoxData = this.getCropBoxData();
      }

      this.render();

      if (options.restore) {
        this.setCanvasData($.each(canvasData, function (i, n) {
          canvasData[i] = n * ratio;
        }));
        this.setCropBoxData($.each(cropBoxData, function (i, n) {
          cropBoxData[i] = n * ratio;
        }));
      }
    }
  },
  dblclick: function dblclick() {
    if (this.disabled || this.options.dragMode === DRAG_MODE_NONE) {
      return;
    }

    this.setDragMode(this.$dragBox.hasClass(CLASS_CROP) ? DRAG_MODE_MOVE : DRAG_MODE_CROP);
  },
  wheel: function wheel(event) {
    var _this = this;

    var e = event.originalEvent || event;
    var ratio = Number(this.options.wheelZoomRatio) || 0.1;

    if (this.disabled) {
      return;
    }

    event.preventDefault();

    // Limit wheel speed to prevent zoom too fast
    if (this.wheeling) {
      return;
    }

    this.wheeling = true;

    setTimeout(function () {
      _this.wheeling = false;
    }, 50);

    var delta = 1;

    if (e.deltaY) {
      delta = e.deltaY > 0 ? 1 : -1;
    } else if (e.wheelDelta) {
      delta = -e.wheelDelta / 120;
    } else if (e.detail) {
      delta = e.detail > 0 ? 1 : -1;
    }

    this.zoom(-delta * ratio, event);
  },
  cropStart: function cropStart(e) {
    if (this.disabled) {
      return;
    }

    var options = this.options,
        pointers = this.pointers;
    var originalEvent = e.originalEvent;

    var action = void 0;

    if (originalEvent && originalEvent.changedTouches) {
      // Handle touch event
      $.each(originalEvent.changedTouches, function (i, touch) {
        pointers[touch.identifier] = getPointer(touch);
      });
    } else {
      // Handle mouse event and pointer event
      pointers[originalEvent && originalEvent.pointerId || 0] = getPointer(originalEvent || e);
    }

    if (objectKeys(pointers).length > 1 && options.zoomable && options.zoomOnTouch) {
      action = ACTION_ZOOM;
    } else {
      action = $(e.target).data(DATA_ACTION);
    }

    if (!REGEXP_ACTIONS.test(action)) {
      return;
    }

    if (this.trigger(EVENT_CROP_START, {
      originalEvent: originalEvent,
      action: action
    }).isDefaultPrevented()) {
      return;
    }

    e.preventDefault();

    this.action = action;
    this.cropping = false;

    if (action === ACTION_CROP) {
      this.cropping = true;
      this.$dragBox.addClass(CLASS_MODAL);
    }
  },
  cropMove: function cropMove(e) {
    var action = this.action;


    if (this.disabled || !action) {
      return;
    }

    var pointers = this.pointers;
    var originalEvent = e.originalEvent;


    e.preventDefault();

    if (this.trigger(EVENT_CROP_MOVE, {
      originalEvent: originalEvent,
      action: action
    }).isDefaultPrevented()) {
      return;
    }

    if (originalEvent && originalEvent.changedTouches) {
      $.each(originalEvent.changedTouches, function (i, touch) {
        $.extend(pointers[touch.identifier], getPointer(touch, true));
      });
    } else {
      $.extend(pointers[originalEvent && originalEvent.pointerId || 0], getPointer(originalEvent || e, true));
    }

    this.change(e);
  },
  cropEnd: function cropEnd(e) {
    if (this.disabled) {
      return;
    }

    var action = this.action;
    var pointers = this.pointers;
    var originalEvent = e.originalEvent;


    if (originalEvent && originalEvent.changedTouches) {
      $.each(originalEvent.changedTouches, function (i, touch) {
        delete pointers[touch.identifier];
      });
    } else {
      delete pointers[originalEvent && originalEvent.pointerId || 0];
    }

    if (!action) {
      return;
    }

    e.preventDefault();

    if (!objectKeys(pointers).length) {
      this.action = '';
    }

    if (this.cropping) {
      this.cropping = false;
      this.$dragBox.toggleClass(CLASS_MODAL, this.cropped && this.options.modal);
    }

    this.trigger(EVENT_CROP_END, {
      originalEvent: originalEvent,
      action: action
    });
  }
};

var change = {
  change: function change(e) {
    var options = this.options,
        pointers = this.pointers,
        container = this.container,
        canvas = this.canvas,
        cropBox = this.cropBox;
    var action = this.action;
    var aspectRatio = options.aspectRatio;
    var left = cropBox.left,
        top = cropBox.top,
        width = cropBox.width,
        height = cropBox.height;

    var right = left + width;
    var bottom = top + height;
    var minLeft = 0;
    var minTop = 0;
    var maxWidth = container.width;
    var maxHeight = container.height;
    var renderable = true;
    var offset = void 0;

    // Locking aspect ratio in "free mode" by holding shift key (#259)
    if (!aspectRatio && e.shiftKey) {
      aspectRatio = width && height ? width / height : 1;
    }

    if (this.limited) {
      minLeft = cropBox.minLeft;
      minTop = cropBox.minTop;

      maxWidth = minLeft + Math.min(container.width, canvas.width, canvas.left + canvas.width);
      maxHeight = minTop + Math.min(container.height, canvas.height, canvas.top + canvas.height);
    }

    var pointer = pointers[objectKeys(pointers)[0]];
    var range = {
      x: pointer.endX - pointer.startX,
      y: pointer.endY - pointer.startY
    };
    var check = function check(side) {
      switch (side) {
        case ACTION_EAST:
          if (right + range.x > maxWidth) {
            range.x = maxWidth - right;
          }

          break;

        case ACTION_WEST:
          if (left + range.x < minLeft) {
            range.x = minLeft - left;
          }

          break;

        case ACTION_NORTH:
          if (top + range.y < minTop) {
            range.y = minTop - top;
          }

          break;

        case ACTION_SOUTH:
          if (bottom + range.y > maxHeight) {
            range.y = maxHeight - bottom;
          }

          break;

        default:
      }
    };

    switch (action) {
      // Move crop box
      case ACTION_ALL:
        left += range.x;
        top += range.y;
        break;

      // Resize crop box
      case ACTION_EAST:
        if (range.x >= 0 && (right >= maxWidth || aspectRatio && (top <= minTop || bottom >= maxHeight))) {
          renderable = false;
          break;
        }

        check(ACTION_EAST);
        width += range.x;

        if (aspectRatio) {
          height = width / aspectRatio;
          top -= range.x / aspectRatio / 2;
        }

        if (width < 0) {
          action = ACTION_WEST;
          width = 0;
        }

        break;

      case ACTION_NORTH:
        if (range.y <= 0 && (top <= minTop || aspectRatio && (left <= minLeft || right >= maxWidth))) {
          renderable = false;
          break;
        }

        check(ACTION_NORTH);
        height -= range.y;
        top += range.y;

        if (aspectRatio) {
          width = height * aspectRatio;
          left += range.y * aspectRatio / 2;
        }

        if (height < 0) {
          action = ACTION_SOUTH;
          height = 0;
        }

        break;

      case ACTION_WEST:
        if (range.x <= 0 && (left <= minLeft || aspectRatio && (top <= minTop || bottom >= maxHeight))) {
          renderable = false;
          break;
        }

        check(ACTION_WEST);
        width -= range.x;
        left += range.x;

        if (aspectRatio) {
          height = width / aspectRatio;
          top += range.x / aspectRatio / 2;
        }

        if (width < 0) {
          action = ACTION_EAST;
          width = 0;
        }

        break;

      case ACTION_SOUTH:
        if (range.y >= 0 && (bottom >= maxHeight || aspectRatio && (left <= minLeft || right >= maxWidth))) {
          renderable = false;
          break;
        }

        check(ACTION_SOUTH);
        height += range.y;

        if (aspectRatio) {
          width = height * aspectRatio;
          left -= range.y * aspectRatio / 2;
        }

        if (height < 0) {
          action = ACTION_NORTH;
          height = 0;
        }

        break;

      case ACTION_NORTH_EAST:
        if (aspectRatio) {
          if (range.y <= 0 && (top <= minTop || right >= maxWidth)) {
            renderable = false;
            break;
          }

          check(ACTION_NORTH);
          height -= range.y;
          top += range.y;
          width = height * aspectRatio;
        } else {
          check(ACTION_NORTH);
          check(ACTION_EAST);

          if (range.x >= 0) {
            if (right < maxWidth) {
              width += range.x;
            } else if (range.y <= 0 && top <= minTop) {
              renderable = false;
            }
          } else {
            width += range.x;
          }

          if (range.y <= 0) {
            if (top > minTop) {
              height -= range.y;
              top += range.y;
            }
          } else {
            height -= range.y;
            top += range.y;
          }
        }

        if (width < 0 && height < 0) {
          action = ACTION_SOUTH_WEST;
          height = 0;
          width = 0;
        } else if (width < 0) {
          action = ACTION_NORTH_WEST;
          width = 0;
        } else if (height < 0) {
          action = ACTION_SOUTH_EAST;
          height = 0;
        }

        break;

      case ACTION_NORTH_WEST:
        if (aspectRatio) {
          if (range.y <= 0 && (top <= minTop || left <= minLeft)) {
            renderable = false;
            break;
          }

          check(ACTION_NORTH);
          height -= range.y;
          top += range.y;
          width = height * aspectRatio;
          left += range.y * aspectRatio;
        } else {
          check(ACTION_NORTH);
          check(ACTION_WEST);

          if (range.x <= 0) {
            if (left > minLeft) {
              width -= range.x;
              left += range.x;
            } else if (range.y <= 0 && top <= minTop) {
              renderable = false;
            }
          } else {
            width -= range.x;
            left += range.x;
          }

          if (range.y <= 0) {
            if (top > minTop) {
              height -= range.y;
              top += range.y;
            }
          } else {
            height -= range.y;
            top += range.y;
          }
        }

        if (width < 0 && height < 0) {
          action = ACTION_SOUTH_EAST;
          height = 0;
          width = 0;
        } else if (width < 0) {
          action = ACTION_NORTH_EAST;
          width = 0;
        } else if (height < 0) {
          action = ACTION_SOUTH_WEST;
          height = 0;
        }

        break;

      case ACTION_SOUTH_WEST:
        if (aspectRatio) {
          if (range.x <= 0 && (left <= minLeft || bottom >= maxHeight)) {
            renderable = false;
            break;
          }

          check(ACTION_WEST);
          width -= range.x;
          left += range.x;
          height = width / aspectRatio;
        } else {
          check(ACTION_SOUTH);
          check(ACTION_WEST);

          if (range.x <= 0) {
            if (left > minLeft) {
              width -= range.x;
              left += range.x;
            } else if (range.y >= 0 && bottom >= maxHeight) {
              renderable = false;
            }
          } else {
            width -= range.x;
            left += range.x;
          }

          if (range.y >= 0) {
            if (bottom < maxHeight) {
              height += range.y;
            }
          } else {
            height += range.y;
          }
        }

        if (width < 0 && height < 0) {
          action = ACTION_NORTH_EAST;
          height = 0;
          width = 0;
        } else if (width < 0) {
          action = ACTION_SOUTH_EAST;
          width = 0;
        } else if (height < 0) {
          action = ACTION_NORTH_WEST;
          height = 0;
        }

        break;

      case ACTION_SOUTH_EAST:
        if (aspectRatio) {
          if (range.x >= 0 && (right >= maxWidth || bottom >= maxHeight)) {
            renderable = false;
            break;
          }

          check(ACTION_EAST);
          width += range.x;
          height = width / aspectRatio;
        } else {
          check(ACTION_SOUTH);
          check(ACTION_EAST);

          if (range.x >= 0) {
            if (right < maxWidth) {
              width += range.x;
            } else if (range.y >= 0 && bottom >= maxHeight) {
              renderable = false;
            }
          } else {
            width += range.x;
          }

          if (range.y >= 0) {
            if (bottom < maxHeight) {
              height += range.y;
            }
          } else {
            height += range.y;
          }
        }

        if (width < 0 && height < 0) {
          action = ACTION_NORTH_WEST;
          height = 0;
          width = 0;
        } else if (width < 0) {
          action = ACTION_SOUTH_WEST;
          width = 0;
        } else if (height < 0) {
          action = ACTION_NORTH_EAST;
          height = 0;
        }

        break;

      // Move canvas
      case ACTION_MOVE:
        this.move(range.x, range.y);
        renderable = false;
        break;

      // Zoom canvas
      case ACTION_ZOOM:
        this.zoom(getMaxZoomRatio(pointers), e.originalEvent);
        renderable = false;
        break;

      // Create crop box
      case ACTION_CROP:
        if (!range.x || !range.y) {
          renderable = false;
          break;
        }

        offset = this.$cropper.offset();
        left = pointer.startX - offset.left;
        top = pointer.startY - offset.top;
        width = cropBox.minWidth;
        height = cropBox.minHeight;

        if (range.x > 0) {
          action = range.y > 0 ? ACTION_SOUTH_EAST : ACTION_NORTH_EAST;
        } else if (range.x < 0) {
          left -= width;
          action = range.y > 0 ? ACTION_SOUTH_WEST : ACTION_NORTH_WEST;
        }

        if (range.y < 0) {
          top -= height;
        }

        // Show the crop box if is hidden
        if (!this.cropped) {
          this.$cropBox.removeClass(CLASS_HIDDEN);
          this.cropped = true;

          if (this.limited) {
            this.limitCropBox(true, true);
          }
        }

        break;

      default:
    }

    if (renderable) {
      cropBox.width = width;
      cropBox.height = height;
      cropBox.left = left;
      cropBox.top = top;
      this.action = action;
      this.renderCropBox();
    }

    // Override
    $.each(pointers, function (i, p) {
      p.startX = p.endX;
      p.startY = p.endY;
    });
  }
};

var methods = {
  // Show the crop box manually
  crop: function crop() {
    if (!this.ready || this.disabled) {
      return;
    }

    if (!this.cropped) {
      this.cropped = true;
      this.limitCropBox(true, true);

      if (this.options.modal) {
        this.$dragBox.addClass(CLASS_MODAL);
      }

      this.$cropBox.removeClass(CLASS_HIDDEN);
    }

    this.setCropBoxData(this.initialCropBox);
  },


  // Reset the image and crop box to their initial states
  reset: function reset() {
    if (!this.ready || this.disabled) {
      return;
    }

    this.image = $.extend({}, this.initialImage);
    this.canvas = $.extend({}, this.initialCanvas);
    this.cropBox = $.extend({}, this.initialCropBox);
    this.renderCanvas();

    if (this.cropped) {
      this.renderCropBox();
    }
  },


  // Clear the crop box
  clear: function clear() {
    if (!this.cropped || this.disabled) {
      return;
    }

    $.extend(this.cropBox, {
      left: 0,
      top: 0,
      width: 0,
      height: 0
    });

    this.cropped = false;
    this.renderCropBox();
    this.limitCanvas(true, true);

    // Render canvas after crop box rendered
    this.renderCanvas();
    this.$dragBox.removeClass(CLASS_MODAL);
    this.$cropBox.addClass(CLASS_HIDDEN);
  },


  /**
   * Replace the image's src and rebuild the cropper
   * @param {string} url - The new URL.
   * @param {boolean} [onlyColorChanged] - Indicate if the new image only changed color.
   */
  replace: function replace(url, onlyColorChanged) {
    if (!this.disabled && url) {
      if (this.isImg) {
        this.$element.attr('src', url);
      }

      if (onlyColorChanged) {
        this.url = url;
        this.$clone.attr('src', url);

        if (this.ready) {
          this.$preview.find('img').add(this.$clone2).attr('src', url);
        }
      } else {
        if (this.isImg) {
          this.replaced = true;
        }

        // Clear previous data
        this.options.data = null;
        this.load(url);
      }
    }
  },


  // Enable (unfreeze) the cropper
  enable: function enable() {
    if (this.ready) {
      this.disabled = false;
      this.$cropper.removeClass(CLASS_DISABLED);
    }
  },


  // Disable (freeze) the cropper
  disable: function disable() {
    if (this.ready) {
      this.disabled = true;
      this.$cropper.addClass(CLASS_DISABLED);
    }
  },


  // Destroy the cropper and remove the instance from the image
  destroy: function destroy() {
    var $element = this.$element;


    if (this.loaded) {
      if (this.isImg && this.replaced) {
        $element.attr('src', this.originalUrl);
      }

      this.unbuild();
      $element.removeClass(CLASS_HIDDEN);
    } else if (this.isImg) {
      $element.off(EVENT_LOAD, this.start);
    } else if (this.$clone) {
      this.$clone.remove();
    }

    $element.removeData(NAMESPACE);
  },


  /**
   * Move the canvas with relative offsets
   * @param {number} offsetX - The relative offset distance on the x-axis.
   * @param {number} offsetY - The relative offset distance on the y-axis.
   */
  move: function move(offsetX, offsetY) {
    var _canvas = this.canvas,
        left = _canvas.left,
        top = _canvas.top;


    this.moveTo(isUndefined(offsetX) ? offsetX : left + Number(offsetX), isUndefined(offsetY) ? offsetY : top + Number(offsetY));
  },


  /**
   * Move the canvas to an absolute point
   * @param {number} x - The x-axis coordinate.
   * @param {number} [y=x] - The y-axis coordinate.
   */
  moveTo: function moveTo(x, y) {
    var canvas = this.canvas;

    var changed = false;

    // If "y" is not present, its default value is "x"
    if (isUndefined(y)) {
      y = x;
    }

    x = Number(x);
    y = Number(y);

    if (this.ready && !this.disabled && this.options.movable) {
      if (isNumber(x)) {
        canvas.left = x;
        changed = true;
      }

      if (isNumber(y)) {
        canvas.top = y;
        changed = true;
      }

      if (changed) {
        this.renderCanvas(true);
      }
    }
  },


  /**
   * Zoom the canvas with a relative ratio
   * @param {Number} ratio - The target ratio.
   * @param {Event} _event - The related event if any.
   */
  zoom: function zoom(ratio, _event) {
    var canvas = this.canvas;


    ratio = Number(ratio);

    if (ratio < 0) {
      ratio = 1 / (1 - ratio);
    } else {
      ratio = 1 + ratio;
    }

    this.zoomTo(canvas.width * ratio / canvas.naturalWidth, _event);
  },


  /**
   * Zoom the canvas to an absolute ratio
   * @param {number} ratio - The target ratio.
   * @param {Event} _event - The related event if any.
   */
  zoomTo: function zoomTo(ratio, _event) {
    var options = this.options,
        pointers = this.pointers,
        canvas = this.canvas;
    var width = canvas.width,
        height = canvas.height,
        naturalWidth = canvas.naturalWidth,
        naturalHeight = canvas.naturalHeight;


    ratio = Number(ratio);

    if (ratio >= 0 && this.ready && !this.disabled && options.zoomable) {
      var newWidth = naturalWidth * ratio;
      var newHeight = naturalHeight * ratio;
      var originalEvent = void 0;

      if (_event) {
        originalEvent = _event.originalEvent;
      }

      if (this.trigger(EVENT_ZOOM, {
        originalEvent: originalEvent,
        oldRatio: width / naturalWidth,
        ratio: newWidth / naturalWidth
      }).isDefaultPrevented()) {
        return;
      }

      if (originalEvent) {
        var offset = this.$cropper.offset();
        var center = pointers && objectKeys(pointers).length ? getPointersCenter(pointers) : {
          pageX: _event.pageX || originalEvent.pageX || 0,
          pageY: _event.pageY || originalEvent.pageY || 0
        };

        // Zoom from the triggering point of the event
        canvas.left -= (newWidth - width) * ((center.pageX - offset.left - canvas.left) / width);
        canvas.top -= (newHeight - height) * ((center.pageY - offset.top - canvas.top) / height);
      } else {
        // Zoom from the center of the canvas
        canvas.left -= (newWidth - width) / 2;
        canvas.top -= (newHeight - height) / 2;
      }

      canvas.width = newWidth;
      canvas.height = newHeight;
      this.renderCanvas(true);
    }
  },


  /**
   * Rotate the canvas with a relative degree
   * @param {number} degree - The rotate degree.
   */
  rotate: function rotate(degree) {
    this.rotateTo((this.image.rotate || 0) + Number(degree));
  },


  /**
   * Rotate the canvas to an absolute degree
   * @param {number} degree - The rotate degree.
   */
  rotateTo: function rotateTo(degree) {
    degree = Number(degree);

    if (isNumber(degree) && this.ready && !this.disabled && this.options.rotatable) {
      this.image.rotate = degree % 360;
      this.renderCanvas(true, true);
    }
  },


  /**
   * Scale the image on the x-axis.
   * @param {number} scaleX - The scale ratio on the x-axis.
   */
  scaleX: function scaleX(_scaleX) {
    var scaleY = this.image.scaleY;


    this.scale(_scaleX, isNumber(scaleY) ? scaleY : 1);
  },


  /**
   * Scale the image on the y-axis.
   * @param {number} scaleY - The scale ratio on the y-axis.
   */
  scaleY: function scaleY(_scaleY) {
    var scaleX = this.image.scaleX;


    this.scale(isNumber(scaleX) ? scaleX : 1, _scaleY);
  },


  /**
   * Scale the image
   * @param {number} scaleX - The scale ratio on the x-axis.
   * @param {number} [scaleY=scaleX] - The scale ratio on the y-axis.
   */
  scale: function scale(scaleX) {
    var scaleY = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : scaleX;
    var image = this.image;

    var transformed = false;

    scaleX = Number(scaleX);
    scaleY = Number(scaleY);

    if (this.ready && !this.disabled && this.options.scalable) {
      if (isNumber(scaleX)) {
        image.scaleX = scaleX;
        transformed = true;
      }

      if (isNumber(scaleY)) {
        image.scaleY = scaleY;
        transformed = true;
      }

      if (transformed) {
        this.renderCanvas(true, true);
      }
    }
  },


  /**
   * Get the cropped area position and size data (base on the original image)
   * @param {boolean} [rounded=false] - Indicate if round the data values or not.
   * @returns {Object} The result cropped data.
   */
  getData: function getData() {
    var rounded = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    var options = this.options,
        image = this.image,
        canvas = this.canvas,
        cropBox = this.cropBox;

    var data = void 0;

    if (this.ready && this.cropped) {
      data = {
        x: cropBox.left - canvas.left,
        y: cropBox.top - canvas.top,
        width: cropBox.width,
        height: cropBox.height
      };

      var ratio = image.width / image.naturalWidth;

      $.each(data, function (i, n) {
        n /= ratio;
        data[i] = rounded ? Math.round(n) : n;
      });
    } else {
      data = {
        x: 0,
        y: 0,
        width: 0,
        height: 0
      };
    }

    if (options.rotatable) {
      data.rotate = image.rotate || 0;
    }

    if (options.scalable) {
      data.scaleX = image.scaleX || 1;
      data.scaleY = image.scaleY || 1;
    }

    return data;
  },


  /**
   * Set the cropped area position and size with new data
   * @param {Object} data - The new data.
   */
  setData: function setData(data) {
    var options = this.options,
        image = this.image,
        canvas = this.canvas;

    var cropBoxData = {};

    if ($.isFunction(data)) {
      data = data.call(this.element);
    }

    if (this.ready && !this.disabled && $.isPlainObject(data)) {
      var transformed = false;

      if (options.rotatable) {
        if (isNumber(data.rotate) && data.rotate !== image.rotate) {
          image.rotate = data.rotate;
          transformed = true;
        }
      }

      if (options.scalable) {
        if (isNumber(data.scaleX) && data.scaleX !== image.scaleX) {
          image.scaleX = data.scaleX;
          transformed = true;
        }

        if (isNumber(data.scaleY) && data.scaleY !== image.scaleY) {
          image.scaleY = data.scaleY;
          transformed = true;
        }
      }

      if (transformed) {
        this.renderCanvas(true, true);
      }

      var ratio = image.width / image.naturalWidth;

      if (isNumber(data.x)) {
        cropBoxData.left = data.x * ratio + canvas.left;
      }

      if (isNumber(data.y)) {
        cropBoxData.top = data.y * ratio + canvas.top;
      }

      if (isNumber(data.width)) {
        cropBoxData.width = data.width * ratio;
      }

      if (isNumber(data.height)) {
        cropBoxData.height = data.height * ratio;
      }

      this.setCropBoxData(cropBoxData);
    }
  },


  /**
   * Get the container size data.
   * @returns {Object} The result container data.
   */
  getContainerData: function getContainerData() {
    return this.ready ? $.extend({}, this.container) : {};
  },


  /**
   * Get the image position and size data.
   * @returns {Object} The result image data.
   */
  getImageData: function getImageData() {
    return this.loaded ? $.extend({}, this.image) : {};
  },


  /**
   * Get the canvas position and size data.
   * @returns {Object} The result canvas data.
   */
  getCanvasData: function getCanvasData() {
    var canvas = this.canvas;

    var data = {};

    if (this.ready) {
      $.each(['left', 'top', 'width', 'height', 'naturalWidth', 'naturalHeight'], function (i, n) {
        data[n] = canvas[n];
      });
    }

    return data;
  },


  /**
   * Set the canvas position and size with new data.
   * @param {Object} data - The new canvas data.
   */
  setCanvasData: function setCanvasData(data) {
    var canvas = this.canvas;
    var aspectRatio = canvas.aspectRatio;


    if ($.isFunction(data)) {
      data = data.call(this.$element);
    }

    if (this.ready && !this.disabled && $.isPlainObject(data)) {
      if (isNumber(data.left)) {
        canvas.left = data.left;
      }

      if (isNumber(data.top)) {
        canvas.top = data.top;
      }

      if (isNumber(data.width)) {
        canvas.width = data.width;
        canvas.height = data.width / aspectRatio;
      } else if (isNumber(data.height)) {
        canvas.height = data.height;
        canvas.width = data.height * aspectRatio;
      }

      this.renderCanvas(true);
    }
  },


  /**
   * Get the crop box position and size data.
   * @returns {Object} The result crop box data.
   */
  getCropBoxData: function getCropBoxData() {
    var cropBox = this.cropBox;


    return this.ready && this.cropped ? {
      left: cropBox.left,
      top: cropBox.top,
      width: cropBox.width,
      height: cropBox.height
    } : {};
  },


  /**
   * Set the crop box position and size with new data.
   * @param {Object} data - The new crop box data.
   */
  setCropBoxData: function setCropBoxData(data) {
    var cropBox = this.cropBox;
    var aspectRatio = this.options.aspectRatio;

    var widthChanged = void 0;
    var heightChanged = void 0;

    if ($.isFunction(data)) {
      data = data.call(this.$element);
    }

    if (this.ready && this.cropped && !this.disabled && $.isPlainObject(data)) {
      if (isNumber(data.left)) {
        cropBox.left = data.left;
      }

      if (isNumber(data.top)) {
        cropBox.top = data.top;
      }

      if (isNumber(data.width) && data.width !== cropBox.width) {
        widthChanged = true;
        cropBox.width = data.width;
      }

      if (isNumber(data.height) && data.height !== cropBox.height) {
        heightChanged = true;
        cropBox.height = data.height;
      }

      if (aspectRatio) {
        if (widthChanged) {
          cropBox.height = cropBox.width / aspectRatio;
        } else if (heightChanged) {
          cropBox.width = cropBox.height * aspectRatio;
        }
      }

      this.renderCropBox();
    }
  },


  /**
   * Get a canvas drawn the cropped image.
   * @param {Object} [options={}] - The config options.
   * @returns {HTMLCanvasElement} - The result canvas.
   */
  getCroppedCanvas: function getCroppedCanvas() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    if (!this.ready || !window.HTMLCanvasElement) {
      return null;
    }

    var canvasData = this.canvas;

    var source = getSourceCanvas(this.$clone[0], this.image, canvasData, options);

    // Returns the source canvas if it is not cropped.
    if (!this.cropped) {
      return source;
    }

    var _getData = this.getData(),
        x = _getData.x,
        y = _getData.y,
        initialWidth = _getData.width,
        initialHeight = _getData.height;

    var aspectRatio = initialWidth / initialHeight;
    var maxSizes = getContainSizes({
      aspectRatio: aspectRatio,
      width: options.maxWidth || Infinity,
      height: options.maxHeight || Infinity
    });
    var minSizes = getContainSizes({
      aspectRatio: aspectRatio,
      width: options.minWidth || 0,
      height: options.minHeight || 0
    });

    var _getContainSizes = getContainSizes({
      aspectRatio: aspectRatio,
      width: options.width || initialWidth,
      height: options.height || initialHeight
    }),
        width = _getContainSizes.width,
        height = _getContainSizes.height;

    width = Math.min(maxSizes.width, Math.max(minSizes.width, width));
    height = Math.min(maxSizes.height, Math.max(minSizes.height, height));

    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');

    canvas.width = normalizeDecimalNumber(width);
    canvas.height = normalizeDecimalNumber(height);
    context.fillStyle = options.fillColor || 'transparent';
    context.fillRect(0, 0, width, height);

    var _options$imageSmoothi = options.imageSmoothingEnabled,
        imageSmoothingEnabled = _options$imageSmoothi === undefined ? true : _options$imageSmoothi,
        imageSmoothingQuality = options.imageSmoothingQuality;


    context.imageSmoothingEnabled = imageSmoothingEnabled;

    if (imageSmoothingQuality) {
      context.imageSmoothingQuality = imageSmoothingQuality;
    }

    // https://developer.mozilla.org/en-US/docs/Web/API/CanvasRenderingContext2D.drawImage
    var sourceWidth = source.width;
    var sourceHeight = source.height;

    // Source canvas parameters
    var srcX = x;
    var srcY = y;
    var srcWidth = void 0;
    var srcHeight = void 0;

    // Destination canvas parameters
    var dstX = void 0;
    var dstY = void 0;
    var dstWidth = void 0;
    var dstHeight = void 0;

    if (srcX <= -initialWidth || srcX > sourceWidth) {
      srcX = 0;
      srcWidth = 0;
      dstX = 0;
      dstWidth = 0;
    } else if (srcX <= 0) {
      dstX = -srcX;
      srcX = 0;
      srcWidth = Math.min(sourceWidth, initialWidth + srcX);
      dstWidth = srcWidth;
    } else if (srcX <= sourceWidth) {
      dstX = 0;
      srcWidth = Math.min(initialWidth, sourceWidth - srcX);
      dstWidth = srcWidth;
    }

    if (srcWidth <= 0 || srcY <= -initialHeight || srcY > sourceHeight) {
      srcY = 0;
      srcHeight = 0;
      dstY = 0;
      dstHeight = 0;
    } else if (srcY <= 0) {
      dstY = -srcY;
      srcY = 0;
      srcHeight = Math.min(sourceHeight, initialHeight + srcY);
      dstHeight = srcHeight;
    } else if (srcY <= sourceHeight) {
      dstY = 0;
      srcHeight = Math.min(initialHeight, sourceHeight - srcY);
      dstHeight = srcHeight;
    }

    // All the numerical parameters should be integer for `drawImage`
    // https://github.com/fengyuanchen/cropper/issues/476
    var params = [srcX, srcY, srcWidth, srcHeight];

    // Avoid "IndexSizeError"
    if (dstWidth > 0 && dstHeight > 0) {
      var scale = width / initialWidth;

      params.push(dstX * scale, dstY * scale, dstWidth * scale, dstHeight * scale);
    }

    context.drawImage.apply(context, [source].concat(toConsumableArray($.map(params, function (param) {
      return Math.floor(normalizeDecimalNumber(param));
    }))));
    return canvas;
  },


  /**
   * Change the aspect ratio of the crop box.
   * @param {number} aspectRatio - The new aspect ratio.
   */
  setAspectRatio: function setAspectRatio(aspectRatio) {
    var options = this.options;


    if (!this.disabled && !isUndefined(aspectRatio)) {
      // 0 -> NaN
      options.aspectRatio = Math.max(0, aspectRatio) || NaN;

      if (this.ready) {
        this.initCropBox();

        if (this.cropped) {
          this.renderCropBox();
        }
      }
    }
  },


  /**
   * Change the drag mode.
   * @param {string} mode - The new drag mode.
   */
  setDragMode: function setDragMode(mode) {
    var options = this.options;

    var croppable = void 0;
    var movable = void 0;

    if (this.loaded && !this.disabled) {
      croppable = mode === DRAG_MODE_CROP;
      movable = options.movable && mode === DRAG_MODE_MOVE;
      mode = croppable || movable ? mode : DRAG_MODE_NONE;

      this.$dragBox.data(DATA_ACTION, mode).toggleClass(CLASS_CROP, croppable).toggleClass(CLASS_MOVE, movable);

      if (!options.cropBoxMovable) {
        // Sync drag mode to crop box when it is not movable(#300)
        this.$face.data(DATA_ACTION, mode).toggleClass(CLASS_CROP, croppable).toggleClass(CLASS_MOVE, movable);
      }
    }
  }
};

var Cropper = function () {
  /**
   * Create a new Cropper.
   * @param {Element} element - The target element for cropping.
   * @param {Object} [options={}] - The configuration options.
   */
  function Cropper(element) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    classCallCheck(this, Cropper);

    if (!element || !REGEXP_TAG_NAME.test(element.tagName)) {
      throw new Error('The first argument is required and must be an <img> or <canvas> element.');
    }

    this.element = element;
    this.$element = $(element);
    this.options = $.extend({}, DEFAULTS, $.isPlainObject(options) && options);
    this.completed = false;
    this.cropped = false;
    this.disabled = false;
    this.isImg = false;
    this.limited = false;
    this.loaded = false;
    this.ready = false;
    this.replaced = false;
    this.wheeling = false;
    this.originalUrl = '';
    this.canvas = null;
    this.cropBox = null;
    this.pointers = {};
    this.init();
  }

  createClass(Cropper, [{
    key: 'init',
    value: function init() {
      var $element = this.$element;

      var url = void 0;

      if ($element.is('img')) {
        this.isImg = true;

        // Should use `$.fn.attr` here. e.g.: "img/picture.jpg"
        url = $element.attr('src') || '';
        this.originalUrl = url;

        // Stop when it's a blank image
        if (!url) {
          return;
        }

        // Should use `$.fn.prop` here. e.g.: "http://example.com/img/picture.jpg"
        url = $element.prop('src');
      } else if ($element.is('canvas') && window.HTMLCanvasElement) {
        url = $element[0].toDataURL();
      }

      this.load(url);
    }

    // A shortcut for triggering custom events

  }, {
    key: 'trigger',
    value: function trigger(type, data) {
      var e = $.Event(type, data);

      this.$element.trigger(e);

      return e;
    }
  }, {
    key: 'load',
    value: function load(url) {
      var _this = this;

      if (!url) {
        return;
      }

      this.url = url;
      this.image = {};

      var $element = this.$element,
          options = this.options;


      if (!options.checkOrientation || !window.ArrayBuffer) {
        this.clone();
        return;
      }

      // XMLHttpRequest disallows to open a Data URL in some browsers like IE11 and Safari
      if (REGEXP_DATA_URL.test(url)) {
        if (REGEXP_DATA_URL_JPEG.test(url)) {
          this.read(dataURLToArrayBuffer(url));
        } else {
          this.clone();
        }

        return;
      }

      var xhr = new XMLHttpRequest();

      xhr.onerror = function () {
        _this.clone();
      };

      xhr.onload = function () {
        _this.read(xhr.response);
      };

      // Bust cache when there is a "crossOrigin" property
      if (options.checkCrossOrigin && isCrossOriginURL(url) && !$element.prop('crossOrigin')) {
        url = addTimestamp(url);
      }

      xhr.open('get', url);
      xhr.responseType = 'arraybuffer';
      xhr.withCredentials = $element.prop('crossOrigin') === 'use-credentials';
      xhr.send();
    }
  }, {
    key: 'read',
    value: function read(arrayBuffer) {
      var options = this.options,
          image = this.image;

      var orientation = getOrientation(arrayBuffer);
      var rotate = 0;
      var scaleX = 1;
      var scaleY = 1;

      if (orientation > 1) {
        this.url = arrayBufferToDataURL(arrayBuffer, 'image/jpeg');

        var _parseOrientation = parseOrientation(orientation);

        rotate = _parseOrientation.rotate;
        scaleX = _parseOrientation.scaleX;
        scaleY = _parseOrientation.scaleY;
      }

      if (options.rotatable) {
        image.rotate = rotate;
      }

      if (options.scalable) {
        image.scaleX = scaleX;
        image.scaleY = scaleY;
      }

      this.clone();
    }
  }, {
    key: 'clone',
    value: function clone() {
      var $element = this.$element,
          options = this.options,
          url = this.url;

      var crossOrigin = '';
      var crossOriginUrl = void 0;

      if (options.checkCrossOrigin && isCrossOriginURL(url)) {
        crossOrigin = $element.prop('crossOrigin');

        if (crossOrigin) {
          crossOriginUrl = url;
        } else {
          crossOrigin = 'anonymous';

          // Bust cache (#148) when there is not a "crossOrigin" property
          crossOriginUrl = addTimestamp(url);
        }
      }

      this.crossOrigin = crossOrigin;
      this.crossOriginUrl = crossOriginUrl;

      var image = document.createElement('img');

      if (crossOrigin) {
        image.crossOrigin = crossOrigin;
      }

      image.src = crossOriginUrl || url;

      var $clone = $(image);

      this.$clone = $clone;

      if (this.isImg) {
        if (this.element.complete) {
          this.start();
        } else {
          $element.one(EVENT_LOAD, $.proxy(this.start, this));
        }
      } else {
        $clone.one(EVENT_LOAD, $.proxy(this.start, this)).one(EVENT_ERROR, $.proxy(this.stop, this)).addClass(CLASS_HIDE).insertAfter($element);
      }
    }
  }, {
    key: 'start',
    value: function start() {
      var _this2 = this;

      var $clone = this.$clone;

      var $image = this.$element;

      if (!this.isImg) {
        $clone.off(EVENT_ERROR, this.stop);
        $image = $clone;
      }

      getImageNaturalSizes($image[0], function (naturalWidth, naturalHeight) {
        $.extend(_this2.image, {
          naturalWidth: naturalWidth,
          naturalHeight: naturalHeight,
          aspectRatio: naturalWidth / naturalHeight
        });

        _this2.loaded = true;
        _this2.build();
      });
    }
  }, {
    key: 'stop',
    value: function stop() {
      this.$clone.remove();
      this.$clone = null;
    }
  }, {
    key: 'build',
    value: function build() {
      var _this3 = this;

      if (!this.loaded) {
        return;
      }

      // Unbuild first when replace
      if (this.ready) {
        this.unbuild();
      }

      var $element = this.$element,
          options = this.options,
          $clone = this.$clone;

      var $cropper = $(TEMPLATE);
      var $cropBox = $cropper.find('.' + NAMESPACE + '-crop-box');
      var $face = $cropBox.find('.' + NAMESPACE + '-face');

      // Create cropper elements
      this.$container = $element.parent();
      this.$cropper = $cropper;
      this.$canvas = $cropper.find('.' + NAMESPACE + '-canvas').append($clone);
      this.$dragBox = $cropper.find('.' + NAMESPACE + '-drag-box');
      this.$cropBox = $cropBox;
      this.$viewBox = $cropper.find('.' + NAMESPACE + '-view-box');
      this.$face = $face;

      // Hide the original image
      $element.addClass(CLASS_HIDDEN).after($cropper);

      // Show the clone image if is hidden
      if (!this.isImg) {
        $clone.removeClass(CLASS_HIDE);
      }

      this.initPreview();
      this.bind();

      options.aspectRatio = Math.max(0, options.aspectRatio) || NaN;
      options.viewMode = Math.max(0, Math.min(3, Math.round(options.viewMode))) || 0;

      this.cropped = options.autoCrop;

      if (options.autoCrop) {
        if (options.modal) {
          this.$dragBox.addClass(CLASS_MODAL);
        }
      } else {
        $cropBox.addClass(CLASS_HIDDEN);
      }

      if (!options.guides) {
        $cropBox.find('.' + NAMESPACE + '-dashed').addClass(CLASS_HIDDEN);
      }

      if (!options.center) {
        $cropBox.find('.' + NAMESPACE + '-center').addClass(CLASS_HIDDEN);
      }

      if (options.cropBoxMovable) {
        $face.addClass(CLASS_MOVE).data(DATA_ACTION, ACTION_ALL);
      }

      if (!options.highlight) {
        $face.addClass(CLASS_INVISIBLE);
      }

      if (options.background) {
        $cropper.addClass(NAMESPACE + '-bg');
      }

      if (!options.cropBoxResizable) {
        $cropBox.find('.' + NAMESPACE + '-line,.' + NAMESPACE + '-point').addClass(CLASS_HIDDEN);
      }

      this.setDragMode(options.dragMode);
      this.render();
      this.ready = true;
      this.setData(options.data);

      // Trigger the ready event asynchronously to keep `data('cropper')` is defined
      this.completing = setTimeout(function () {
        if ($.isFunction(options.ready)) {
          $element.one(EVENT_READY, options.ready);
        }

        _this3.trigger(EVENT_READY);
        _this3.trigger(EVENT_CROP, _this3.getData());
        _this3.completed = true;
      }, 0);
    }
  }, {
    key: 'unbuild',
    value: function unbuild() {
      if (!this.ready) {
        return;
      }

      if (!this.completed) {
        clearTimeout(this.completing);
      }

      this.ready = false;
      this.completed = false;
      this.initialImage = null;

      // Clear `initialCanvas` is necessary when replace
      this.initialCanvas = null;
      this.initialCropBox = null;
      this.container = null;
      this.canvas = null;

      // Clear `cropBox` is necessary when replace
      this.cropBox = null;
      this.unbind();

      this.resetPreview();
      this.$preview = null;

      this.$viewBox = null;
      this.$cropBox = null;
      this.$dragBox = null;
      this.$canvas = null;
      this.$container = null;

      this.$cropper.remove();
      this.$cropper = null;
    }

    /**
     * Change the default options.
     * @param {Object} options - The new default options.
     */

  }], [{
    key: 'setDefaults',
    value: function setDefaults(options) {
      $.extend(DEFAULTS, $.isPlainObject(options) && options);
    }
  }]);
  return Cropper;
}();

if ($.extend) {
  $.extend(Cropper.prototype, render, preview, events, handlers, change, methods);
}

if ($.fn) {
  var AnotherCropper = $.fn.cropper;

  $.fn.cropper = function jQueryCropper(option) {
    for (var _len = arguments.length, args = Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
      args[_key - 1] = arguments[_key];
    }

    var result = void 0;

    this.each(function (i, element) {
      var $element = $(element);
      var data = $element.data(NAMESPACE);

      if (!data) {
        if (/destroy/.test(option)) {
          return;
        }

        var options = $.extend({}, $element.data(), $.isPlainObject(option) && option);

        data = new Cropper(element, options);
        $element.data(NAMESPACE, data);
      }

      if (isString(option)) {
        var fn = data[option];

        if ($.isFunction(fn)) {
          result = fn.apply(data, args);
        }
      }
    });

    return isUndefined(result) ? this : result;
  };

  $.fn.cropper.Constructor = Cropper;
  $.fn.cropper.setDefaults = Cropper.setDefaults;
  $.fn.cropper.noConflict = function noConflict() {
    $.fn.cropper = AnotherCropper;
    return this;
  };
}

})));


/***/ }),

/***/ 69:
/***/ (function(module, exports) {

module.exports = window.jQuery;

/***/ }),

/***/ 7:
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getElement = (function (fn) {
	var memo = {};

	return function(selector) {
		if (typeof memo[selector] === "undefined") {
			var styleTarget = fn.call(this, selector);
			// Special case to return head of iframe instead of iframe itself
			if (styleTarget instanceof window.HTMLIFrameElement) {
				try {
					// This will throw an exception if access to iframe is blocked
					// due to cross-origin restrictions
					styleTarget = styleTarget.contentDocument.head;
				} catch(e) {
					styleTarget = null;
				}
			}
			memo[selector] = styleTarget;
		}
		return memo[selector]
	};
})(function (target) {
	return document.querySelector(target)
});

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(9);

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
	if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else if (typeof options.insertAt === "object" && options.insertAt.before) {
		var nextSibling = getElement(options.insertInto + " " + options.insertAt.before);
		target.insertBefore(style, nextSibling);
	} else {
		throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	options.attrs.type = "text/css";

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	options.attrs.type = "text/css";
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = options.transform(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ 70:
/***/ (function(module, exports, __webpack_require__) {

var $imports = __webpack_require__(1);
module.exports = function ($data) {
    'use strict';
    $data = $data || {};
    var $$out = '', $escape = $imports.$escape, head_img = $data.head_img, username = $data.username, mobile = $data.mobile, sex = $data.sex;
    $$out += '<div class="weui-cells">\r\n    <a class="weui-cell weui-cell_access avatar-cell">\r\n        <div class="weui-cell__bd">\r\n            <p>头像</p>\r\n        </div>\r\n        <div class="weui-cell__ft">\r\n            <span style="background-image: url(';
    $$out += $escape(head_img);
    $$out += ');"></span>\r\n        </div>\r\n        <input type="file" name="uploadAvatar">\r\n    </a>\r\n    <a class="weui-cell weui-cell_access name-cell">\r\n        <div class="weui-cell__bd">\r\n            <p>昵称</p>\r\n        </div>\r\n        <div class="weui-cell__ft">';
    $$out += $escape(username);
    $$out += '</div>\r\n    </a>\r\n    <a class="weui-cell weui-cell_access phone-cell" href="bind.html">\r\n        <div class="weui-cell__bd">\r\n            <p>手机</p>\r\n        </div>\r\n        <div class="weui-cell__ft">\r\n            <input class="weui-input phone-input" type="text" readonly="" value="';
    if (mobile !== ' ') {
        $$out += $escape(mobile);
    } else {
        $$out += '去绑定';
    }
    $$out += '">\r\n        </div>\r\n    </a>\r\n    <a class="weui-cell weui-cell_access gender-cell">\r\n        <div class="weui-cell__bd">\r\n            <p>性别</p>\r\n        </div>\r\n        <div class="weui-cell__ft">\r\n            <input class="weui-input gender-input" type="text" readonly="" value="';
    $$out += $escape(sex);
    $$out += '">\r\n        </div>\r\n    </a>\r\n    <!--     <a class="weui-cell weui-cell_access birthday-cell">\r\n        <div class="weui-cell__bd">\r\n            <p> 生日</p>\r\n        </div>\r\n        <div class="weui-cell__ft">\r\n            <input class="weui-input birthday-input" type="text" readonly="" value="点击设置">\r\n        </div>\r\n    </a> -->\r\n</div>';
    return $$out;
};

/***/ }),

/***/ 9:
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ })

/******/ });
//# sourceMappingURL=user_info.bundle.js.map