/**
 * Created by Administrator on 2020/07/08.
 */
//register


$(function () {
    var order_id = $('.order_id').val();
    var params = {
        uri : 'order/' + order_id,
        method : 'GET',
        data : {},
        sCallback : function (data) {
            $('.title').html(data.title);
            $('.request_type').html(data.request_type_text);
            $('.category').html(data.category.name);
            $('.description').html(data.description);
            $('.key_word').html(data.key_word);
        },
        eCallback : function (res) {
            alert(res.msg);
        }
    };
    request(params,true);

    // var params_chat = {
    //     uri : 'chatting/byorder/' + order_id,
    //     method : 'GET',
    //     data : {},
    //     sCallback : function (data) {
    //         // todo
    //     },
    //     eCallback : function (res) {
    //         alert(res.msg);
    //     }
    // };
    // request(params_chat,true);

    //socket todo
});

