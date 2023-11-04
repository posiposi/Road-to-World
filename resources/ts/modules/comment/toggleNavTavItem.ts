export const toggleNavTabItem = (dataTabValue: string | null | undefined) => {
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
}