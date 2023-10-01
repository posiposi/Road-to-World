const modal = document.getElementById('reservationModal')!;
const reservationModalBtn = document.getElementById('reservationModalOpenBtn')!;
const modalCloseBtn = document.getElementById('modal-close-btn')!;

const switchDialogShow = (target: HTMLElement) => {
  if (target) {
    toggleActiveClass(target);
  }
  else {
    alert('モーダルを表示できません。');
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
