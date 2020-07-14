const restUrl = "http://www.task.jp/api/v1/";
const baseUrl = "http://www.task.jp/h5/";
const indexUrl = baseUrl + 'index.html';
$(function () {
    $('#header').load('header.html');
    $('#footer').load('footer.html');
    getUserInfo();
});

function request(params, needVerify) {
    var url = restUrl + params.uri;
    if (!params.method) {
        params.method = 'GET';
    }
    var data = params.data ? params.data : {};
    var headers = {
        // "Content-type": "application/json"
    };
    if (needVerify) {
        var token = sessionStorage.getItem('token');
        if (!token && location.href !== indexUrl) {
            console.log(indexUrl);
            location.href = indexUrl;
        }
        headers.token = token;
    }

    console.log(params);
    $.ajax({
        type: params.method,
        url: url,
        data: data,
        dataType: "json",
        headers: headers,
        success: function (res) {
            console.log(res);
            var code = res.error_code.toString();
            if (code === '0') {
                params.sCallback && params.sCallback(res.info);
            } else {
                if (code === '10015') {
                    sessionStorage.clear();
                    if (location.href !== indexUrl) {
                        location.href = indexUrl;
                    }
                }
                params.eCallback && params.eCallback(res);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest.text);
        }
    });
}
/**
 *
 */
function getUserInfo() {

    var token = sessionStorage.getItem('token');
    if (!token) {
        sessionStorage.clear();
        if (location.href !== indexUrl) {
            location.href = indexUrl;
        }
        $('.login-item').show();
        return;
    }
    var params = {
        uri: 'user/info',
        method: 'GET',
        data: {},
        sCallback: function (res) {
            // sessionStorage.setItem('token',res.token);
            $('.login-item').hide();
            $('.user-center-item').show();
            $('.username-item').text(res.username);
        },
        eCallback: function (res) {
            $('.login-item').show();
            $('.user-center-item').hide();
            $('.username-item').text('');
        }
    };
    request(params, true);
}
/**
 *
 */
function logout() {
    var params = {
        uri: 'user/logout',
        method: 'GET',
        data: {},
        sCallback: function (res) {
            sessionStorage.clear();
            $('.login-item').show();
            $('.user-center-item').hide();
            $('.username-item').text('');
            if (location.href !== indexUrl) {
                location.href = indexUrl;
            }
        },
        eCallback: function (res) {
            console.log(res.msg);
        }
    };
    request(params, true);
}
/**
 *
 * @param variable
 * @returns {boolean}
 */
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] === variable) {
            return pair[1];
        }
    }
    return (false);
}
function textarealength(obj,maxlength){
    var v = $(obj).val();
    var l = v.length;
    var length_obj = $(obj).parent().find(".textarea-length");
    length_obj.text(v.length);
    l > maxlength ? length_obj.addClass("text-danger") : length_obj.removeClass("text-danger");
}

function scrollBack(obj,time) {
    $('html, body').animate({
        scrollTop: (obj ? obj.offset().top : 0)
    }, time ? time : 500);
}