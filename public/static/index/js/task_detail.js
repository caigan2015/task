/**
 * Created by Administrator on 2020/07/08.
 */
//register


$(function () {
    var task_id = $('.task_id').val();
    var params = {
        uri: 'offer/' + task_id,
        method: 'GET',
        data: {},
        sCallback: function (data) {
            $('.title').html(data.title);
            $('.request_type').html(data.request_type_text);
            $('.category').html(data.category.name);
            $('.description').html(data.description);
            $('.key_word').html(data.key_word);
        },
        eCallback: function (res) {
            alert(res.msg);
        }
    };
    request(params);

    $('.apply').on('click', (function (e) {
        var params = {
            uri: 'order/apply',
            method: 'POST',
            data: {
                offer_id: task_id
            },
            sCallback: function (data) {
                location = 'task/order/' + data.order_id;
            },
            eCallback: function (res) {
                alert(res.msg);
            }
        };
        request(params, true);
    }));
});
