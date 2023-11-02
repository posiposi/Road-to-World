const navButtons: NodeListOf<HTMLButtonElement> = document.querySelectorAll('.nav-item');

const toggleClickedTab = (): void => {
}

navButtons.forEach((navButton) => {
  navButton.addEventListener('click', (event) => {
    const targetEvent = event.currentTarget as HTMLElement;
    const allNavItems = document.querySelectorAll('.nav-item');
    const othersNavItems = Array.from(allNavItems).filter((item) => item !== targetEvent);

    const targetButton: HTMLButtonElement | null = targetEvent.querySelector('button');

    if (targetButton != null) {
      targetButton.classList.add('active');
    }

    othersNavItems.forEach((navItem) => {
      const navButton: HTMLButtonElement | null = navItem.querySelector('button');
      if (navButton) {
        navButton.classList.remove('active');
      }
    });
  })
})