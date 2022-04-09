//イベント発火
$("#comment-button").on("click", function(){
    //テキスト入力フォームの値を取得
    const message = $("#comment-form").val();
    console.log(message);
    $("#comment-view").text(message);
})