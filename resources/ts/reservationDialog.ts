const modal = document.getElementById('reservationModal')!;
const modalBtn = document.getElementById('reservationModalOpenBtn')!;
const closeBtn = document.getElementById('modal-close-btn')!;

const switchDialogShow = (target: HTMLElement) => {
  if (target) {
    target.classList.toggle('active');
  }
  else {
    alert('モーダルを表示できません。');
  }
}

modalBtn.addEventListener('click', () => {
  switchDialogShow(modal);
}, false);

closeBtn.addEventListener('click', () => {
  modal.classList.remove('active');
});

document.addEventListener('keydown', (event: KeyboardEvent) => {
  if (event.key === 'Escape') {
    modal.classList.remove('active');
  }
})
