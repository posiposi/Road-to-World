const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");

// イベント発火
$(function () {
    $('#comment-button').on('click', function(){
        let user_comment = $("#comment-form").val();
        let location_url = $(location).attr('href').split('/', 6); //アクセスURLを取得
        let bikeId = location_url[4];
        let recieverId = location_url[5];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/comments/' + bikeId + '/' + recieverId + '/store',
            type: 'POST',
            data: {'bikeId' : bikeId, 'recieverId' : recieverId, 'body' : user_comment},
            dataType: 'json',
        }).done(function(data) {
            $('#comment-view').html(data);
            console.log(data);
        }).fail(function() {
            console.log('error');
        });
    })
})