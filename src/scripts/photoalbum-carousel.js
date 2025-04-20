import EmblaCarousel from 'embla-carousel'
import { addThumbBtnsClickHandlers, addToggleThumbBtnsActive } from './EmblaCarouselThumbsButton'
import { addPrevNextBtnsClickHandlers } from './EmblaCarouselArrowButtons'

const OPTIONS_MAIN = {}
const OPTIONS_THUMBS = {
  containScroll: 'keepSnaps',
  dragFree: true
}

export function initPhotoalbumCarousel() {
  const viewportNodeMainCarousel = document.querySelector('[data-photoalbum-main]')
  const viewportNodeThumbCarousel = document.querySelector('[data-photoalbum-thumbs]')
  const prevBtnNode = document.querySelector('[data-photoalbum-main-prev]')
  const nextBtnNode = document.querySelector('[data-photoalbum-main-next]')

  if (!viewportNodeMainCarousel || !viewportNodeThumbCarousel || !prevBtnNode || !nextBtnNode) return

  const emblaApiMain = EmblaCarousel(viewportNodeMainCarousel, OPTIONS_MAIN)
  const emblaApiThumb = EmblaCarousel(viewportNodeThumbCarousel, OPTIONS_THUMBS)

  const removePrevNextBtnsClickHandlers = addPrevNextBtnsClickHandlers(
    emblaApiMain,
    prevBtnNode,
    nextBtnNode
  )

  const removeThumbBtnsClickHandlers = addThumbBtnsClickHandlers(
    emblaApiMain,
    emblaApiThumb
  )
  const removeToggleThumbBtnsActive = addToggleThumbBtnsActive(
    emblaApiMain,
    emblaApiThumb
  )

  emblaApiMain
    .on('destroy', removeThumbBtnsClickHandlers)
    .on('destroy', removeToggleThumbBtnsActive)

  emblaApiThumb
    .on('destroy', removeThumbBtnsClickHandlers)
    .on('destroy', removeToggleThumbBtnsActive)
}
