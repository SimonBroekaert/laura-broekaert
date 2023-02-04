(() => {
  const animateOnSCrollOptions = {
    once: true,
    delay: 200,
    duration: 600,
  }

  const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const $element = entry.target
      const delay = $element.dataset.aosDelay || animateOnSCrollOptions.delay
      const duration = $element.dataset.aosDuration || animateOnSCrollOptions.duration

      if (entry.isIntersecting) {
        // Wait for the delay
        setTimeout(() => {
          // Set the css transition duration
          $element.style.transitionDuration = `${duration}ms`
          $element.dataset.aosState = 'visible'
          setTimeout(() => {
            // Remove the css transition duration
            $element.style.transitionDuration = ''
          }, duration)
        }, delay)
      }
      if (!entry.isIntersecting && !animateOnSCrollOptions.once) {
        // Set the css transition duration
        $element.style.transitionDuration = `${duration}ms`
        $element.dataset.aosState = 'hidden'
        setTimeout(() => {
          // Remove the css transition duration
          $element.style.transitionDuration = ''
        }, duration)
      }
    })
  })

  const $animateOnScrollElements = document.querySelectorAll('[data-aos]')

  $animateOnScrollElements.forEach(($element) => {
    scrollObserver.observe($element)
  })
})()
