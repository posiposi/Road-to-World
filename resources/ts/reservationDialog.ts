import { reservationConfirmDialog } from './reservationConfirmDialog';

const modal: HTMLElement = document.getElementById('reservationModal')!;
const reservationModalBtn: HTMLElement = document.getElementById('reservationModalOpenBtn')!;
const modalCloseBtn: HTMLElement = document.getElementById('modal-close-btn')!;
const modalErrorMessage: string = 'モーダルを表示できません。'

const switchDialogShow = (target: HTMLElement) => {
  if (target) {
    toggleActiveClass(target);
  }
  else {
    alert(modalErrorMessage);
  }
}

const toggleActiveClass = (element: HTMLElement) => {
  element.classList.toggle('active');
}

const removeActiveClass = (element: HTMLElement) => {
  element.classList.remove('active');
}

reservationModalBtn.addEventListener('click', () => {
  switchDialogShow(modal);
});

modalCloseBtn.addEventListener('click', () => {
  toggleActiveClass(modal);
});

document.addEventListener('keydown', (event: KeyboardEvent) => {
  if (event.key === 'Escape') {
    removeActiveClass(modal);
  }
})

const dialog: reservationConfirmDialog = new reservationConfirmDialog();
document.querySelectorAll('.reservation-form').forEach((button) => {
  button.addEventListener('submit', dialog.showConfirmDialog);
});
