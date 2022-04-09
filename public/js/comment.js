/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/comment.js ***!
  \*********************************/
//イベント発火
$("#comment-button").on("click", function () {
  //テキスト入力フォームの値を取得
  var message = $("#comment-form").val();
  console.log(message);
  $("#comment-view").text(message);
});
/******/ })()
;