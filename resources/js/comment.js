const { data } = require("jquery");
const { received } = require("laravel-mix/src/Log");

//画面ロード
$(function(){
    //既存コメントロード
    comments_load();
    //ボタン活性・非活性
    disableSenderButton();
});

//送信ボタン押下時アクション
$('#comment-button').on('click', function(){
    //コメント保存
    post_comments();
    //表示ラグを避けるために0.3秒遅延実行でコメント表示をする
    setTimeout(function(){
        comments_load();
    }, 300);
});

/** サーバー側のコメント保存メソッドを呼び出す */
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
    
    //非同期通信でコメントをDBに保存する
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

/** DB内コメントをロードする */
function comments_load(){
    /** @type {string} ajax通信用URLパラメータ */
    const location_url = $(location).attr('href').split('/', 7);
    /** @type {string} 対象自転車のID */
    const bikeId = location_url[4];
    /** @type {string} ログインユーザーのID */
    const senderId = location_url[5];
    /** @type {string} 対象自転車の保有ユーザーID */
    const receiverId = location_url[6];

    //非同期通信で対象のコメントを表示する
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/comments/' + bikeId + '/' + senderId + '/' + receiverId + '/' + 'get',
        type: 'GET',
        data: {'bikeId' : bikeId, 'senderId' : senderId, 'receiverId' : receiverId},
        dataType: 'json',
    }).done(function(data){
        //サーバから受け取ったJSONを代入
        /** @type {Array} DB内のログインユーザーコメント */
        let sender_allcomments = data.sender_allcomments;
        /** @type {Array} DB内の相手側コメント */
        let receiver_allcomments = data.receiver_allcomments;

        //送信者側の表示コメントを削除
        $('.sendercomment-view').empty();
        for(let i=0; i < sender_allcomments.length; i++){
            //DBから受け取ったログインユーザー側のコメントを表示
            $('.sendercomment-view').append('<ul>' + sender_allcomments[i].created_at + '：' + sender_allcomments[i].body + '</ul>');
        }
        
        //DBから受け取った相手側の表示コメントを削除
        $('.receivercomment-view').empty();
        for(let i=0; i < receiver_allcomments.length; i++){
            //受信者側の最新コメントを表示
            $('.receivercomment-view').append('<ul>' + receiver_allcomments[i].created_at + '：' + receiver_allcomments[i].body + '</ul>');
        }
    }).fail(function(){
        console.log("コメント表示エラー");
    });
}

/** 送信ボタンの活性・不活性を決定する */
function disableSenderButton(){
    //コメントフォームに入力がされた際にイベント発火
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