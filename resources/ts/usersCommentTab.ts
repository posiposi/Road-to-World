import { toggleNavTab } from './modules/comment/toggleNavTab';

const navButtons: NodeListOf<HTMLButtonElement> = document.querySelectorAll('.nav-item');

navButtons.forEach((navButton: HTMLButtonElement) => {
  navButton.addEventListener('click', (event: MouseEvent) => {
    const targetEvent = event.currentTarget as HTMLElement;
    const targetNavButton = targetEvent.querySelector('button');
    const dataTabValue = targetNavButton?.getAttribute('data-tab');

    if (dataTabValue) {
      const targetPanel = document.getElementById(dataTabValue);
      const allPanel = document.querySelectorAll('.tab-pane');
      const otherTabContents = Array.from(allPanel).filter((panel) => panel !== targetPanel);

      targetPanel?.classList.add('show', 'active');
      otherTabContents.forEach((tabItem) => {
        if (tabItem) {
          tabItem.classList.remove('show', 'active');
        }
      })
    }

    toggleNavTab(targetNavButton);
  })
})
