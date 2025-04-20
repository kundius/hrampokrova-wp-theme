export function applyQuestionForm(form) {
  const submit = form.querySelector('[type="submit"]')
  const messages = form.querySelector('[data-question-form-messages]')

  form.addEventListener('submit', (e) => {
    e.preventDefault()

    messages.innerHTML = ''
    form.setAttribute('data-question-form-status', 'loading')
    submit.setAttribute('disabled', '')

    const formData = new FormData(e.target)
    formData.append('action', 'question_action')

    fetch(e.target.action, {
      method: 'post',
      body: formData
    })
      .then((response) => response.json())
      .then((result) => {
        if (!result.success) {
          messages.innerHTML = Object.values(result.data).join('<br>')
          form.setAttribute('data-question-form-status', 'failure')
        } else {
          form.setAttribute('data-question-form-status', 'success')
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
            form.removeAttribute('data-question-form-status')
            messages.innerHTML = ''
          }, 4000)
        }

        submit.removeAttribute('disabled', '')
      })
      .catch((error) => console.error(error))
  })
}

export function initQuestionForm() {
  const items = document.querySelectorAll('[data-question-form]') || []

  Array.from(items).forEach(applyQuestionForm)
}
