import { toggleNavTab } from './modules/comment/toggleNavTab';
import { toggleNavTabItem } from './modules/comment/toggleNavTavItem';

const navButtons: NodeListOf<HTMLButtonElement> = document.querySelectorAll('.nav-item');

navButtons.forEach((navButton: HTMLButtonElement) => {
  navButton.addEventListener('click', (event: MouseEvent) => {
    const targetEvent = event.currentTarget as HTMLElement;
    const targetNavButton = targetEvent.querySelector('button');
    const dataTabValue = targetNavButton?.getAttribute('data-tab');

    toggleNavTab(targetNavButton);
    toggleNavTabItem(dataTabValue);
  })
})
