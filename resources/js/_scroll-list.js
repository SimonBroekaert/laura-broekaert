const updateScrollListControls = ($scrollList) => {
  // Get the controls
  const $controls = document.querySelectorAll(`[data-scroll-list-control="${$scrollList.dataset.scrollList}"]`)

  // Get the items that are visible in the overflow hidden container
  const $items = $scrollList.querySelectorAll('[data-scroll-list-item]')
  const $visibleItems = Array.from($items).filter($item => {
    const itemRect = $item.getBoundingClientRect()
    const scrollListRect = $scrollList.getBoundingClientRect()

    return Math.round(itemRect.left) >= Math.round(scrollListRect.left) && Math.round(itemRect.right) <= Math.round(scrollListRect.right)
  })

  // Get the first and last visible item
  const $firstVisibleItem = $visibleItems[0]
  const $lastVisibleItem = $visibleItems[$visibleItems.length - 1]

  // Get the next and previous item
  const $nextItem = $lastVisibleItem.nextElementSibling
  const $previousItem = $firstVisibleItem.previousElementSibling

  // Update the controls
  $controls.forEach(($control) => {
    const disabledClass = $control.dataset.disabledClass ?? 'is-disabled'

    if ($control.dataset.direction === 'left') {
      $control.disabled = !$previousItem
      if (!$previousItem) {
        $control.classList.add(disabledClass)
      } else {
        $control.classList.remove(disabledClass)
      }
    }

    if ($control.dataset.direction === 'right') {
      $control.disabled = !$nextItem
      if (!$nextItem) {
        $control.classList.add(disabledClass)
      } else {
        $control.classList.remove(disabledClass)
      }
    }
  })
}

(() => {
  const $scrollListControls = document.querySelectorAll('[data-scroll-list-control]')
  const $scrollLists = document.querySelectorAll('[data-scroll-list]')

  $scrollLists.forEach($scrollList => {
    let scrollListTimeout = null
    $scrollList.addEventListener('scroll', () => {
      clearTimeout(scrollListTimeout)
      scrollListTimeout = setTimeout(() => {
        $scrollLists.forEach($scrollList => {
          updateScrollListControls($scrollList)
        })
      }, 10)
    })

    updateScrollListControls($scrollList)
  })

  let resizeTimeout = null
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout)
    resizeTimeout = setTimeout(() => {
      $scrollLists.forEach($scrollList => {
        updateScrollListControls($scrollList)
      })
    }, 250)
  })

  $scrollListControls.forEach($control => {
    $control.addEventListener('click', () => {
      const direction = $control.dataset.direction
      const $scrollList = document.querySelector(`[data-scroll-list="${$control.dataset.scrollListControl}"]`)

      if (!$scrollList) {
        return
      }

      const $items = $scrollList.querySelectorAll('[data-scroll-list-item]')

      // Get the items that are visible in the overflow hidden container
      const $visibleItems = Array.from($items).filter($item => {
        const itemRect = $item.getBoundingClientRect()
        const scrollListRect = $scrollList.getBoundingClientRect()

        return Math.round(itemRect.left) >= Math.round(scrollListRect.left) && Math.round(itemRect.right) <= Math.round(scrollListRect.right)
      })

      // Get the first and last visible item
      const $firstVisibleItem = $visibleItems[0]
      const $lastVisibleItem = $visibleItems[$visibleItems.length - 1]

      // Get the next and previous item
      const $nextItem = $lastVisibleItem.nextElementSibling
      const $previousItem = $firstVisibleItem.previousElementSibling

      if (direction === 'right' && $nextItem) {
        $nextItem.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' })
      }

      if (direction === 'left' && $previousItem) {
        $previousItem.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'nearest' })
      }
    })
  })
})();
