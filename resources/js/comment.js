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

/** サーバー側コメント保存メソッドを呼び出す */
function post_comments(){
    /** @type {string} フォームに入力されたユーザーのコメント */
    const user_comment = $("#comment-input").val();
    /** @type {string} ajax通信用URLパラメータ */
    const location_url = $(location).attr('href').split('/', 7);
    /** @type {string} 対象自転車のID */
    const bikeId = location_url[4];
    /** @type {string} ログインユーザーのID */
    const senderId = location_url[5];
    /** @type {string} 対象自転車の保有ユーザーID */
    const receiverId = location_url[6];
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/comments/' + bikeId + '/' + senderId + '/' + receiverId + '/store',
        type: 'POST',
        data: {'bikeId' : bikeId, 'senderId' : senderId, 'receiverId' : receiverId, 'body' : user_comment},
    }).done(function() {
        console.log('post_success');
    }).fail(function() {
        console.log('error');
    });
}

/** 既存コメントをロードする */
function comments_load(){
    /** @type {string} ajax通信用URLパラメータ */
    const location_url = $(location).attr('href').split('/', 7);
    /** @type {string} 対象自転車のID */
    const bikeId = location_url[4];
    /** @type {string} ログインユーザーのID */
    const senderId = location_url[5];
    /** @type {string} 対象自転車の保有ユーザーID */
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
        //通信成功した場合はサーバーから受け取ったjsonをループ処理して表示する
        for(let i in data){
            $('.comment-view').empty();
            $('.comment-view').append('<p>' + data[i] + '</p>');
        }
    }).fail(function(){
        console.log("コメント表示エラー");
    });
}

/** 送信ボタンの活性・不活性を決定する */
function disableSenderButton(){
    //コメントフォームの入力がされた時点でイベント発火
    $("#comment-input").on("input", function(){
        /** @type {string} フォームに入力されたコメント */
        let inputComment = $(this).val();
        /** @type {HTMLElement} 送信ボタンの要素 */
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