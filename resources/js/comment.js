const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");

// イベント発火
$(function () {
    $('#comment-button').on('click', function(){
        let user_comment = $("#comment-form").val();
        let location_url = $(location).attr('href'); //アクセスURLを取得
        let split_url = location_url.split('/', 6); //取得URLを/で分割して配列化
        let bikeId = split_url[4];
        let receiverId = split_url[5];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/comments/' + bikeId + '/' + receiverId + '/store',
            type: 'POST',
            dataType: 'text',
        }).done(function() {
            console.log(user_comment);
            console.log(bikeId);
            console.log(receiverId);
        }).fail(function() {
            console.log('error');
        });
    })
})