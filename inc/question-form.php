<?php

add_action('wp_ajax_question_action', 'ajax_action_question');
add_action('wp_ajax_nopriv_question_action', 'ajax_action_question');

function ajax_action_question()
{
  $errors = [];

  if (!wp_verify_nonce($_POST['nonce'], 'question-nonce')) {
    wp_die('Данные отправлены с неподдерживаемого адреса');
  }

  if (!empty($_POST['submitted'])) {
    $errors['submitted'] = 'Что?';
  }

  // if (empty($_POST['approve'])) {
  //   $errors['approve'] = 'Вы должны согаситься с правилами.';
  // }

  if (empty($_POST['question'])) {
    $errors['question'] = 'Задайте Ваш вопрос.';
  }

  if (empty($_POST['email'])) {
    $errors['email'] = 'Укажите Ваш e-mail.';
  }

  if ($errors) {
    wp_send_json_error($errors);
  } else {
    $email_to = '';

    if (!$email_to) {
      $email_to = get_option('admin_email');
    }

    $rows = [];
    if (!empty($_POST['client'])) {
      $rows[] = 'Имя: ' . sanitize_text_field($_POST['client']);
    }
    if (!empty($_POST['email'])) {
      $rows[] = 'Отправитель: ' . sanitize_text_field($_POST['email']);
    }
    if (!empty($_POST['question'])) {
      $rows[] = 'Вопрос: ' . sanitize_text_field($_POST['question']);
    }
    $body = implode("\n", $rows);

    $subject = 'Вопрос к Священнику';

    wp_mail($email_to, $subject, $body);

    $message_success = 'Собщение отправлено.';

    wp_send_json_success($message_success);
  }

  wp_die();
}
