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
/******/ 	return __webpack_require__(__webpack_require__.s = 62);
/******/ })
/************************************************************************/
/******/ ({

/***/ 62:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


function count(inputEle) {
    var r = $(inputEle).val().length;
    return r;
}

$(document).ready(function () {
    $(document).on('click', '.weui-btn_primary', function (event) {
        event.preventDefault();
        /* Act on the event */
        var $type = $("input[name='type']");
        var $phone = $("input[name='phone']");
        var $title = $("input[name='title']");
        var $content = $("textarea[name='content']");
        var flag = $("textarea[name='content'],input[name='phone']").validate();
        if (flag) {
            $._ajax({
                url: domain + "/api/v1/feeds",
                data: {
                    type: $type.val(),
                    phone: $phone.val(),
                    title: $title.val(),
                    content: $content.val()
                },
                success: function success(data) {
                    console.log(data);
                    if (data.error_code === 0) {
                        $.toast("提交成功", function () {
                            history.back();
                        });
                    }
                }
            });
        }
    });

    $(".weui-textarea").on('keyup blur', function (event) {
        event.preventDefault();
        var r = count($(".weui-textarea"));
        if (r <= 200) {
            $(".weui-textarea-counter span").html(r);
        } else {
            $(".weui-textarea").val($(".weui-textarea").val().substring(0, 200));
        }
        /* Act on the event */
    });
});

/***/ })

/******/ });
//# sourceMappingURL=suggestion.bundle.js.map