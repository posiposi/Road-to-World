import { showConfirmDialog } from './reservationConfirmDialog';

const modal: HTMLElement = document.getElementById('reservationModal')!;
const reservationModalBtn: HTMLElement = document.getElementById('reservationModalOpenBtn')!;
const modalCloseBtn: HTMLElement = document.getElementById('modal-close-btn')!;
const modalErrorMessage: string = 'モーダルを表示できません。';
const reservationBtn: HTMLElement = document.getElementById('reservation-btn')!;

const switchDialogShow = (target: HTMLElement): void => {
  if (target) {
    toggleActiveClass(target);
  }
  else {
    alert(modalErrorMessage);
  }
}

const toggleActiveClass = (element: HTMLElement): void => {
  element.classList.toggle('active');
}

const removeActiveClass = (element: HTMLElement): void => {
  element.classList.remove('active');
}

reservationModalBtn.addEventListener('click', (): void => {
  switchDialogShow(modal);
});

modalCloseBtn.addEventListener('click', (): void => {
  toggleActiveClass(modal);
});

document.addEventListener('keydown', (event: KeyboardEvent): void => {
  if (event.key === 'Escape') {
    removeActiveClass(modal);
  }
});

reservationBtn.addEventListener('click', showConfirmDialog);
