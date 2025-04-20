<?php

add_action('wp_enqueue_scripts', 'ajax_data', 99);

function ajax_data()
{
  wp_localize_script('scripts', 'theme_ajax', [
    'url' => admin_url('admin-ajax.php'),
  ]);
}
