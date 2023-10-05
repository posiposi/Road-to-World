// TODO 下記クラス定義でなく、モジュールファンクションでも良いかも？
export class reservationConfirmDialog {
  confirmationMessage: string = '予約してもよろしいですか？';

  showConfirmDialog = (event: Event) => {
    if (window.confirm(this.confirmationMessage)) {
      return true;
    } else {
      event.stopPropagation();
      event.preventDefault();
    }
  };
}
