(() => {
  const $carousels = document.querySelectorAll('[data-carousel]')

  $carousels.forEach($carousel => {
    const $carouselControls = $carousel.querySelectorAll('[data-carousel-control]')

    $carouselControls.forEach($control => {
      $control.addEventListener('click', () => {
        const $carouselItems = $carousel.querySelectorAll('[data-carousel-item]')
        // Get the active item.
        const $activeItem = $carousel.querySelector('[data-carousel-item][data-active="true"]')
        const $activeItemIndex = Array.from($carouselItems).indexOf($activeItem)
        // Get the next active item based on direction. If previous and first item, go to last item, if next and last item, go to first item.
        const $nextActiveItem = $control.dataset.carouselControl === 'previous' ? $carouselItems[$activeItemIndex - 1] || $carouselItems[$carouselItems.length - 1] : $carouselItems[$activeItemIndex + 1] || $carouselItems[0]
        // Remove the toggle class from the active item and add it to the next active item.
        $activeItem.dataset.active = false
        $activeItem.classList.add(...$activeItem.dataset.toggleClasses.split(' '))
        $nextActiveItem.dataset.active = true
        $nextActiveItem.classList.remove(...$nextActiveItem.dataset.toggleClasses.split(' '))
      })
    })
  })
})()
