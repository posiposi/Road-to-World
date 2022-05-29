const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");


//コメント送信ボタンクリック時にイベント発火
$('#comment-button').on('click', function(){
    get_comments();
    // comments_load();
});

//コメントの非同期保存アクション
function get_comments(){
    $(function(){
        //ajaxに渡すための各種データを取得
        let user_comment = $("#comment-form").val();
        let location_url = $(location).attr('href').split('/', 7);
        let bikeId = location_url[4];
        let senderId = location_url[5];
        let recieverId = location_url[6];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/comments/' + bikeId + '/' + senderId + '/' + recieverId + '/store',
            type: 'POST',
            data: {'bikeId' : bikeId, 'senderId' : senderId, 'recieverId' : recieverId, 'body' : user_comment},
            // dataType: 'json',
        }).done(function() {
            console.log('post_success');
            // for(let i in data){
            //     console.log(data[i])
            //     $('#comment-view').empty();
            //     $('#comment-view').append('<p>' + data[i] + '</p>');
            // }
        }).fail(function() {
            console.log('error');
        });
    })
}

//既存コメントの表示
function comments_load(){
    $(function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/comments/' + bikeId + '/' + senderId + '/' + receiverId + '/show',
            type: 'GET',
            data: {'bikeId' : bikeId, 'senderId' : senderId, 'recieverId' : recieverId,},
            dataType: 'json',
        }).done(function(data){
            console.log('非同期ページ変遷完了');
        }).fail(function(){
            console.log("コメント表示エラー");
        });
    })
}