export function initFaq() {
  const listNode = document.querySelector('.answers-list')

  if (!listNode) return

  const itemNodes = listNode.querySelectorAll('.answers-item') || []

  itemNodes.forEach((itemNode) => {
    const headNode = itemNode.querySelector('.answers-item__headline')
    const innerNode = itemNode.querySelector('.answers-item__inner')
    const { height } = innerNode.getBoundingClientRect()
    itemNode.style.setProperty('--max-height', `${height}px`)
    headNode.addEventListener('click', () => {
      itemNodes.forEach((el) => {
        console.log(el == itemNode, el, itemNode)
        if (el == itemNode) {
          el.classList.toggle('answers-item_opened')
        } else {
          el.classList.remove('answers-item_opened')
        }
      })
    })
  })
}
