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
/******/ 	return __webpack_require__(__webpack_require__.s = 32);
/******/ })
/************************************************************************/
/******/ ({

/***/ 32:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


$(document).ready(function ($) {
    var $phone = $("input[name='telephone']");
    var $code = $("input[name='code']");
    $(document).on('click', '.weui-vcode-btn', function (event) {
        event.preventDefault();
        /* Act on the event */
        var btn = $(this);
        var flag = $phone.validate();
        if (flag) {
            $._ajax({
                url: domain + "/api/v1/identify/code",
                data: {
                    phone: $phone.val()
                },
                success: function success(data) {
                    console.log(data);
                    if (data.error_code === 0) {
                        $.toptip(data.msg, "success");
                        var count = 60;
                        btn.addClass('disabled');
                        var resend = setInterval(function () {
                            count--;
                            if (count > 0) {
                                btn.html(count + "s后重新获取");
                                $.setCookie("captcha", count, count * 1000);
                            } else {
                                clearInterval(resend);
                                btn.html("获取验证码").removeClass('disabled').removeAttr('disabled');
                            }
                        }, 1000);
                        btn.prop('disabled', true);
                    }
                }
            });
        }
    });

    $(document).on('click', '.weui-btn_primary', function (event) {
        event.preventDefault();
        /* Act on the event */
        var flag = $("input[name='telephone'],input[name='code']").validate();
        if (flag) {
            $._ajax({
                url: domain + "/api/v1/user/bind",
                data: {
                    phone: $phone.val(),
                    code: $code.val()
                },
                success: function success(data) {
                    console.log(data);
                    if (data.error_code === 0) {
                        $.toptip(data.msg, "success");
                    }
                    setTimeout(function () {
                        history.back();
                    }, 3000);
                }
            });
        }
    });

    /*防止刷新：检测是否存在cookie*/
    if ($.getCookie("captcha")) {
        //bug 修复 关闭浏览器倒计时继续，
        // var count = $.getCookie("captcha");
        var real = JSON.parse(localStorage.getItem("captcha"));
        var count = Math.ceil((real.expires - new Date().getTime()) / 1000);

        var btn = $('.weui-vcode-btn');
        btn.addClass('disabled');
        btn.html(count + 's后重新获取').prop('disabled', true);
        var resend = setInterval(function () {
            count--;
            if (count > 0) {
                btn.html(count + 's后重新获取').prop('disabled', true);
                $.setCookie("captcha", count, count * 1000);
            } else {
                clearInterval(resend);
                btn.html("获取验证码").removeClass('disabled').removeAttr('disabled');
            }
        }, 1000);
    }
});

/***/ })

/******/ });
//# sourceMappingURL=bind.bundle.js.map