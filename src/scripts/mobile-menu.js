import { disableScroll, enableScroll } from './utils'

export function initMobileMenu() {
  const stateNode = document.querySelector('[data-mobile-menu-state]')
  const closeNodes = document.querySelectorAll('[data-mobile-menu-close]') || []
  const openNodes = document.querySelectorAll('[data-mobile-menu-open]') || []
  const containerNode = document.querySelector('[data-mobile-menu]')
  const menuItemNodes = containerNode.querySelectorAll('.menu-item-has-children') || []

  openNodes.forEach((openNode) =>
    openNode.addEventListener('click', (e) => {
      e.preventDefault()
      stateNode.dataset.mobileMenuState = 'opened'
      disableScroll()
    })
  )

  closeNodes.forEach((closeNode) =>
    closeNode.addEventListener('click', (e) => {
      e.preventDefault()
      stateNode.dataset.mobileMenuState = 'closed'
      enableScroll()
    })
  )

  menuItemNodes.forEach((menuItemNode) => {
    let timer = null
    const close = () => {
      menuItemNode.classList.remove('menu-item-opened')
    }
    const open = () => {
      menuItemNode.classList.add('menu-item-opened')
    }
    const toggle = () => {
      if (menuItemNode.classList.contains('menu-item-opened')) {
        close()
      } else {
        open()
      }
    }

    const link = menuItemNode.querySelector('a')
    const handler = document.createElement('span')
    handler.classList.add('menu-toggle')
    link.appendChild(handler)

    handler.addEventListener('click', (e) => {
      e.preventDefault()
      e.stopPropagation()
      toggle()
    })

    link.addEventListener('click', (e) => {
      if (window.matchMedia('(min-width: 1280px)').matches) return
      if (!menuItemNode.classList.contains('menu-item-opened')) {
        e.preventDefault()
        open()
      }
    })

    menuItemNode.addEventListener('mouseenter', () => {
      if (!window.matchMedia('(min-width: 1280px)').matches) return
      clearTimeout(timer)
      timer = setTimeout(open, 200)
    })
    menuItemNode.addEventListener('mouseleave', () => {
      if (!window.matchMedia('(min-width: 1280px)').matches) return
      clearTimeout(timer)
      timer = setTimeout(close, 200)
    })
  })
}
