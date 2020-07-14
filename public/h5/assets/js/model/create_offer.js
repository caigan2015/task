/**
 * Created by caigan on 2020/07/12.
 */
$('.upload-img-item').change(function () {
    var filename = this.files['0']['name'];//文件名
    var arr = this.files['0']['name'].split(".");
    var filetype = arr[(arr.length - 1)];//文件类型
    console.log(filetype);
    var allowType = ['jpg'];
    if ($.inArray(filetype, allowType) != -1) {
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function (e) {
            var base64 = e.target.result;
            $('.base64-item').val(base64.replace(/data:.*;base64/i, filename));
        };
    } else {
        $(this).val('');
        $('.base64-item').val('');
        $('.error-msg-show').text(filetype + 'not noAllow');
    }
});


//submit
$('.offer-submit-btn').click(function (e) {
    $(".require-item").hide();
    $(".error-msg-show").hide();
    var requestTypeObj = $('input[name="request_type"]');
    var categoryIdObj = $('input[name="category_id"]');
    var titleObj = $('input[name="title"]');
    var descriptionObj = $('textarea[name="description"]');
    var request_type = requestTypeObj.val();
    var category_id = categoryIdObj.val();
    var title = titleObj.val();
    var description = descriptionObj.val();
    var image = $('input[name="image"]').val();
    var key_word = $('input[name="key_word"]').val();
    if(request_type === ''){
        return showRequire(requestTypeObj);
    }
    if(category_id === ''){
        return showRequire(categoryIdObj);
    }
    if(title === ''){
        return showRequire(titleObj);
    }
    if(description === ''){
        return showRequire(descriptionObj);
    }
    var data = {
        "request_type": request_type,
        "category_id": category_id,
        "title": title,
        "description": description
    };
    if (image) {
        data.image = image;
    }
    if (key_word) {
        data.key_word = key_word;
    }
    var params = {
        uri: 'myoffer/create',
        method: 'POST',
        data: data,
        sCallback: function (res) {
            scrollBack();
            $('.error-msg-show').text('success!').show();
            setTimeout(function () {
                location.href = indexUrl;
            },2000)
        },
        eCallback: function (res) {
            scrollBack();
            $('.error-msg-show').text('res.msg').show();
        }
    };
    request(params, true);
});

function showRequire(obj) {
    scrollBack(obj);
    obj.parent().find(".require-item").show();
    return false;
}
