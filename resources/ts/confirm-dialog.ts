/**
 * 予約確認ダイアログを表示する
 */
const showConfirmDialog = (event: Event) => {
    if (window.confirm('予約してもよろしいですか？')) {
        return true;
    } else {
        event.stopPropagation();
        event.preventDefault();
    }
};

// 複数の要素に同時にイベント登録はできないため、繰り返し処理でイベントを登録する。
document.querySelectorAll('.reservation-form').forEach((button) => {
    button.addEventListener('submit', showConfirmDialog);
});