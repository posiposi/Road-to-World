const confirmationMessage: string = '予約してもよろしいですか？';

export const showConfirmDialog = (event: Event): boolean | void => {
  if (window.confirm(confirmationMessage)) {
    return true;
  } else {
    event.stopPropagation();
    event.preventDefault();
  }
};
