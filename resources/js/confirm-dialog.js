/**
 * 予約確認ダイアログを表示する
 * @param {Object} e イベントオブジェクト
 * @returns {boolean} true:OKボタン押下、false:イベントキャンセル
 */
const showConfirmDialog = (e) => {
    if(window.confirm('この内容で予約してもよろしいですか？')) {
        return true;
    } else {
        e.stopPropagation();
        e.preventDefault();
    }
};

// 複数の要素に同時にイベント登録はできないため、繰り返し処理でイベントを登録する。
document.querySelectorAll('.reservation-form').forEach((button) => {
    button.addEventListener('submit', showConfirmDialog);
});