import EmblaCarousel from 'embla-carousel'
import { addPrevNextBtnsClickHandlers } from './EmblaCarouselArrowButtons'

export function initHomePreachingCarousel() {
  const emblaNode = document.querySelector('[data-home-preaching-carousel]')
  const prevBtnNode = document.querySelector('[data-home-preaching-carousel-prev]')
  const nextBtnNode = document.querySelector('[data-home-preaching-carousel-next]')

  if (!emblaNode || !prevBtnNode || !nextBtnNode) return

  const options = { loop: false, slidesToScroll: 'auto' }
  const emblaApi = EmblaCarousel(emblaNode, options)

  const removePrevNextBtnsClickHandlers = addPrevNextBtnsClickHandlers(
    emblaApi,
    prevBtnNode,
    nextBtnNode
  )

  emblaApi.on('destroy', removePrevNextBtnsClickHandlers)
}
