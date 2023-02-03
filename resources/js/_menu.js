(() => {
  const $menuStateHolders = document.querySelectorAll('[data-menu-state]')
  const $menuToggles = document.querySelectorAll('[data-menu-toggle]')

  console.log($menuStateHolders)
  console.log($menuToggles)

  $menuToggles.forEach($toggle => {
    $toggle.addEventListener('click', () => {
      $menuStateHolders.forEach($holder => {
        $holder.dataset.menuState = $holder.dataset.menuState === 'opened' ? 'closed' : 'opened'
      })
    })
  })
})()
