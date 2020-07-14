/**
 * Created by Administrator on 2020/07/08.
 */
//register
$('.register').click(function (e) {
    var e_mail = $('.e_mail').val();
    var username = $('.username').val();
    var password = $('.password').val();
    var params = {
        uri : 'user/register',
        method : 'POST',
        data : {
            e_mail : e_mail,
            username : username,
            password : password
        },
        sCallback : function (res) {
            $('.result').html('success!Please go to the mailbox to verify.');
        },
        eCallback : function (res) {
            $('.result').html(res.msg);
        }
    };
    request(params);
});

//login
$('.login').click(function (e) {
    var e_mail = $('.e_mail').val();
    var password = $('.password').val();
    var params = {
        uri : 'user/login',
        method : 'POST',
        data : {
            e_mail : e_mail,
            password : password
        },
        sCallback : function (res) {
            alert('success');
            $('.head_img').src(res.userInfo.head_img);
            $('.username').src(res.userInfo.username);
            localStorage.setItem('token',res.info.token);
            location.reload();
        },
        eCallback : function (res) {
            alert(res.msg);
        }
    };
    request(params);
});

//get taskList
function getTaskList() {
    var data = {};
    var page = $('.page').val();
    var request_type = $('.request_type').val();
    var category_id = $('.category_id').val();
    if(page){
        data.page = page + 1;
    }
    if(request_type){
        data.request_type = request_type;
    }
    if(category_id){
        data.category_id = category_id;
    }
    var params = {
        uri : 'offer/all',
        method : 'POST',
        data : data,
        sCallback : function (res) {
            var html = '';
            var data = res.info.data;
            for (var i = 0;i<data.length;i++){
                html += 'a';
            }
            $('.task_list').append(html);
            $('.total_count').html(res.info.total);
        },
        eCallback : function (res) {
            alert(res.msg);
        }
    };
    request(params);
}

$(function () {
    getUserInfo();
    getTaskList();
});