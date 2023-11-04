export const toggleNavTab = (clickedButton: HTMLButtonElement | null) => {
  const allNavItems: NodeListOf<HTMLButtonElement> = document.querySelectorAll('.nav-link');
  const othersNavItems = Array.from(allNavItems).filter((item) => item !== clickedButton);

  if (clickedButton) {
    clickedButton.classList.add('active');
  }

  othersNavItems.forEach((navItem) => {
    const navButton: HTMLButtonElement | null = navItem.querySelector('button');
    if (navButton) {
      navButton.classList.remove('active');
    }
  });
}