const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");

//画面ロード
$(function(){
    //既存コメントロード
    comments_load();
    //ボタン活性・非活性
    disableSenderButton();
});

//ボタンクリック時にコメント保存・読み込みイベント発火
$('#comment-button').on('click', function(){
    post_comments();
    comments_load();
});

//コメントの非同期保存アクション
function post_comments(){
    const user_comment = $("#comment-input").val();
    const location_url = $(location).attr('href').split('/', 7);
    const bikeId = location_url[4];
    const senderId = location_url[5];
    const receiverId = location_url[6];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/comments/' + bikeId + '/' + senderId + '/' + receiverId + '/store',
        type: 'POST',
        data: {'bikeId' : bikeId, 'senderId' : senderId, 'receiverId' : receiverId, 'body' : user_comment},
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
    const receiverId = location_url[6];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/comments/' + bikeId + '/' + senderId + '/' + receiverId + '/' + 'get',
        type: 'GET',
        data: {'bikeId' : bikeId, 'senderId' : senderId, 'receiverId' : receiverId},
        dataType: 'json',
    }).done(function(data){
        for(let i in data){
            $('.comment-view').empty();
            $('.comment-view').append('<p>' + data[i] + '</p>');
        }
    }).fail(function(){
        console.log("コメント表示エラー");
    });
}

//送信ボタンの不活性化処理
function disableSenderButton(){
    //コメントフォームの入力がされた場合、イベント発火
    $("#comment-input").on("input", function(){
        //入力されたコメントを取得
        let inputComment = $(this).val();
        //送信ボタンを定数に定義
        const SENDER_BUTTON = $("#comment-button")

        //コメントが入力されている場合
        if(inputComment){
            //送信ボタンを活性化
            SENDER_BUTTON.prop('disabled', false);
        }else{
            //送信ボタンを非活性化
            SENDER_BUTTON.prop('disabled', true);
        }
    })
}