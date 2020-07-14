/**
 * Created by Administrator on 2020/07/08.
 */

$(function () {
    $('#login-modal').on('show.bs.modal', function (e) {
        $('#result').hide();
        $('.error-msg-show').hide();
    }).on('hide.bs.modal', function (e) {
        $('#result').hide();
        $('.error-msg-show').hide();
    });
    getTaskList();
});
//register
$('.register-btn').click(function (e) {
    var e_mail = $('.e_mail-register').val();
    var username = $('.username-register').val();
    var password = $('.password-register').val();
    var params = {
        uri : 'user/register',
        method : 'POST',
        data : {
            e_mail : e_mail,
            username : username,
            password : password
        },
        sCallback : function (res) {
            $('#result').html('success!Please go to the mailbox to verify.').show();
        },
        eCallback : function (res) {
            $('#result').html(res.msg).show();
        }
    };
    request(params);
});

//login
$('.login-btn').click(function (e) {
    var e_mail = $('.e_mail-login').val();
    var password = $('.password-login').val();
    var params = {
        uri : 'user/login',
        method : 'POST',
        data : {
            "e_mail" : e_mail,
            "password" : password
        },
        sCallback : function (res) {
            sessionStorage.setItem('token',res.token);
            $('#result').html('success!').show();
            $('.login-item').hide();
            $('.user-center-item').show();
            $('.username-item').text(res.user_info.username);
            $('#login-modal').modal('hide');
        },
        eCallback : function (res) {
            $('#result').html(res.msg).show();
        }
    };
    request(params,false);
});

$('.task-add-item').click(function (e) {
    var token = sessionStorage.getItem('token');
   if(!token){
       $('.error-msg-show').text('not login').show();
       return;
   }
   location = baseUrl + 'create_offer.html';
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
            var data = res.data;
            for (var i = 0;i<data.length;i++){
                html += 'a';
            }
            // $('.task_list').append(html);
            // $('.total_count').html(res.info.total);
            $('.error-msg-show').hide();
        },
        eCallback : function (res) {
            alert(res.msg);
        }
    };
    request(params);
}
