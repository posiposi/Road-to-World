const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");

//画面ロード時に既存コメントを読み込み
$(function(){
    comments_load();
});

//ボタンクリック時にコメント保存・読み込みイベント発火
$('#comment-button').on('click', function(){
    post_comments();
    comments_load();
});

//コメントの非同期保存アクション
function post_comments(){
    const user_comment = $("#comment-form").val();
    const location_url = $(location).attr('href').split('/', 7);
    const bikeId = location_url[4];
    const senderId = location_url[5];
    const recieverId = location_url[6];
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
    }).fail(function() {
        console.log('error');
    });
}

//既存コメントの表示
function comments_load(){
    const location_url = $(location).attr('href').split('/', 7);
    const bikeId = location_url[4];
    const senderId = location_url[5];
    const recieverId = location_url[6];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/comments/' + bikeId + '/' + senderId + '/' + recieverId + '/' + 'get',
        type: 'GET',
        data: {'bikeId' : bikeId, 'senderId' : senderId, 'receiverId' : recieverId},
        dataType: 'json',
    }).done(function(data){
        console.log('非同期ページ変遷完了');
        for(let i in data){
            console.log(data[i])
            $('#comment-view').empty();
            $('#comment-view').append('<p>' + data[i] + '</p>');
        }
    }).fail(function(){
        console.log("コメント表示エラー");
    });
}