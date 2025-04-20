<?php

add_action('wp_ajax_notes_action', 'ajax_action_notes');
add_action('wp_ajax_nopriv_notes_action', 'ajax_action_notes');

function ajax_action_notes()
{
  $errors = [];

  if (!wp_verify_nonce($_POST['nonce'], 'notes-nonce')) {
    wp_die('Данные отправлены с неподдерживаемого адреса');
  }

  if (!empty($_POST['submitted'])) {
    $errors['submitted'] = 'Что?';
  }

  // if (empty($_POST['approve'])) {
  //   $errors['approve'] = 'Вы должны согаситься с правилами.';
  // }

  if (empty($_POST['type'])) {
    $errors['type'] = 'Выберите тип помина.';
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
      $rows[] = 'Имя просящего: ' . sanitize_text_field($_POST['client']);
    }
    if (!empty($_POST['type'])) {
      $rows[] = 'Тип помина: ' . sanitize_text_field($_POST['type']);
    }
    if (!empty($_POST['names'])) {
      $rows[] = '';
      $rows[] = 'Имена поминаемых:';
      foreach ($_POST['names'] as $name) {
        if (!empty($name)) {
          $rows[] = $name;
        }
      }
    }
    $body = implode("\n", $rows);

    $subject = 'Записки онлайн';

    wp_mail($email_to, $subject, $body);

    $message_success = 'Собщение отправлено.';

    wp_send_json_success($message_success);
  }

  wp_die();
}
