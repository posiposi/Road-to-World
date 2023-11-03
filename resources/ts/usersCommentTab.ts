const navButtons: NodeListOf<HTMLButtonElement> = document.querySelectorAll('.nav-item');

navButtons.forEach((navButton: HTMLButtonElement) => {
  navButton.addEventListener('click', (event: MouseEvent) => {
    const targetEvent = event.currentTarget as HTMLElement;
    const targetNavButton = targetEvent.querySelector('button');
    // タブと連動しているパネルを取得するためにdatasetを取得する
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

    toggleNavTab(targetNavButton, targetEvent);
  })
})

// TODO 別ファイルへコンポーネントとして切り出し
const toggleNavTab = (clickedButton: HTMLButtonElement | null, targetEvent: HTMLElement) => {
  const allNavItems: NodeListOf<HTMLLIElement> = document.querySelectorAll('.nav-item');
  const othersNavItems = Array.from(allNavItems).filter((item) => item !== targetEvent);

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