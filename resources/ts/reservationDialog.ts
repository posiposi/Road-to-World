const modal = document.getElementById('reservationModal') as HTMLDivElement | null;
const modalBtn = document.getElementById('reservationModalOpenBtn');
const closeBtn = document.getElementById('modal-close-btn');

const switchDialogShow = (target: HTMLDivElement | null) => {
  if (target) {
    target.classList.toggle('active');
  }
  else {
    alert('モーダルを表示できません。');
  }
}

modalBtn?.addEventListener('click', () => {
  switchDialogShow(modal);
}, false);

closeBtn?.addEventListener('click', () => {
  modal?.classList.remove('active');
});
