export function applyNotesForm(form) {
  const submit = form.querySelector('[type="submit"]')
  const messages = form.querySelector('[data-notes-form-messages]')
  const itemsNode = form.querySelector('.notes-form-list__items')
  const itemsAddNode = form.querySelector('.notes-form-list__add-button')
  const headlineNode = form.querySelector('.notes-form-list__headline')
  const typeSelectNode = form.querySelector('[name="type"]')

  itemsAddNode.addEventListener('click', () => {
    const item = document.createElement('div')
    item.classList.add('notes-form-list__item')
    item.innerHTML = `
      <input type="text" name="names[]" class="notes-form-list__input" placeholder="Введите здесь имя поминаемого">
    `
    itemsNode.appendChild(item)
  })

  typeSelectNode.addEventListener('change', (e) => {
    headlineNode.innerHTML = e.target.value
  })
  headlineNode.innerHTML = typeSelectNode.value

  form.addEventListener('submit', (e) => {
    e.preventDefault()

    messages.innerHTML = ''
    form.setAttribute('data-notes-form-status', 'loading')
    submit.setAttribute('disabled', '')

    const formData = new FormData(e.target)
    formData.append('action', 'notes_action')

    fetch(e.target.action, {
      method: 'post',
      body: formData
    })
      .then((response) => response.json())
      .then((result) => {
        if (!result.success) {
          messages.innerHTML = Object.values(result.data).join('<br>')
          form.setAttribute('data-notes-form-status', 'failure')
        } else {
          form.setAttribute('data-notes-form-status', 'success')
          form.reset()
          messages.innerHTML = result.data

          if (form.dataset.feedackFormGoal && typeof ym !== 'undefined') {
            const elYmId = document.querySelector('[data-ym-id]')
            if (elYmId && elYmId.dataset.ymId) {
              ym(elYmId.dataset.ymId, 'reachGoal', form.dataset.feedackFormGoal)
              console.log('goal', elYmId.dataset.ymId, form.dataset.feedackFormGoal)
            }
          }

          setTimeout(() => {
            form.removeAttribute('data-notes-form-status')
            messages.innerHTML = ''
          }, 4000)
        }

        submit.removeAttribute('disabled', '')
      })
      .catch((error) => console.error(error))
  })
}

export function initNotesForm() {
  const items = document.querySelectorAll('[data-notes-form]') || []

  Array.from(items).forEach(applyNotesForm)
}
