<?php
add_action('init', 'register_post_types');

function register_post_types()
{
  register_post_type('minister', [
    'label' => null,
    'labels' => [
      'name' => 'Cлужитель', // основное название для типа записи
      'singular_name' => 'Cлужитель', // название для одной записи этого типа
      'add_new' => 'Добавить служителя', // для добавления новой записи
      'add_new_item' => 'Добавить служителя', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать служителя', // для редактирования типа записи
      'new_item' => 'Новый служитель', // текст новой записи
      'view_item' => 'Смотреть служителя', // для просмотра записи этого типа.
      'search_items' => 'Искать служителя', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Cлужители', // название меню
    ],
    'description' => '',
    'public' => true,
    'show_in_menu' => null, // показывать ли в меню админки
    'show_in_rest' => null, // добавить в REST API. C WP 4.7
    'rest_base' => null, // $post_type. C WP 4.7
    'menu_position' => null,
    'menu_icon' => 'dashicons-media-document',
    'hierarchical' => false,
    'supports' => ['title', 'editor', 'thumbnail'], // 'title','editor','author','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => [],
    'has_archive' => false,
    'rewrite' => true,
    'query_var' => true,
  ]);

  register_post_type('preaching', [
    'label' => null,
    'labels' => [
      'name' => 'Проповедь', // основное название для типа записи
      'singular_name' => 'Проповедь', // название для одной записи этого типа
      'add_new' => 'Добавить проповедь', // для добавления новой записи
      'add_new_item' => 'Добавить проповедь', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать проповедь', // для редактирования типа записи
      'new_item' => 'Новая проповедь', // текст новой записи
      'view_item' => 'Смотреть проповедь', // для просмотра записи этого типа.
      'search_items' => 'Искать проповедь', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Проповеди', // название меню
    ],
    'description' => '',
    'public' => true,
    'show_in_menu' => null, // показывать ли в меню админки
    'show_in_rest' => null, // добавить в REST API. C WP 4.7
    'rest_base' => null, // $post_type. C WP 4.7
    'menu_position' => null,
    'menu_icon' => 'dashicons-media-document',
    'hierarchical' => false,
    'supports' => ['title', 'thumbnail'], // 'title','editor','author','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => [],
    'has_archive' => false,
    'rewrite' => true,
    'query_var' => true,
  ]);

  register_post_type('photoalbum', [
    'label' => null,
    'labels' => [
      'name' => 'Фотоальбом', // основное название для типа записи
      'singular_name' => 'Фотоальбом', // название для одной записи этого типа
      'add_new' => 'Добавить фотоальбом', // для добавления новой записи
      'add_new_item' => 'Добавить фотоальбом', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item' => 'Редактировать фотоальбом', // для редактирования типа записи
      'new_item' => 'Новая фотоальбом', // текст новой записи
      'view_item' => 'Смотреть фотографии', // для просмотра записи этого типа.
      'search_items' => 'Искать фотоальбом', // для поиска по этим типам записи
      'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon' => '', // для родителей (у древовидных типов)
      'menu_name' => 'Фотогалерея', // название меню
    ],
    'description' => '',
    'public' => true,
    'show_in_menu' => null, // показывать ли в меню админки
    'show_in_rest' => null, // добавить в REST API. C WP 4.7
    'rest_base' => null, // $post_type. C WP 4.7
    'menu_position' => null,
    'menu_icon' => 'dashicons-media-document',
    'hierarchical' => false,
    'supports' => ['title', 'thumbnail'], // 'title','editor','author','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => [],
    'has_archive' => false,
    'rewrite' => true,
    'query_var' => true,
  ]);
}
