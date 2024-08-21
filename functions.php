<?php

add_theme_support('post-thumbnails');


/**
 * show_admin_bar
 * 
 * Eszköztár tiltása
 */
if (!current_user_can('administrator')) {
  add_filter('show_admin_bar', '__return_false');
}


/**
 * add_custom_navigations()
 * 
 * Wordpress navigációk felvétele
 */
add_action('init', 'add_custom_navigations');
function add_custom_navigations()
{
  register_nav_menu('header-menu-left', __('Fejléc menü (bal)'));
  register_nav_menu('header-menu-right', __('Fejléc menü (jobb)'));
  register_nav_menu('header-usermenu', __('Fejléc felhasználói menü'));
}


/**
 * wp_register_widgets()
 * 
 * Wordpress widgetek felvétele
 */
add_action('widgets_init', 'wp_register_widgets');
function wp_register_widgets()
{
  if (function_exists('register_sidebar')) {
    register_sidebar(
      array(
        'name' => 'Widget area',
        'id' => 'widget-area',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span class="hidden">',
        'after_title' => '</span>',
      )
    );
  }
}


/**
 * add_custom_dashboard_pages()
 * 
 * Egyéni admin oldalak felvétele
 */
add_action('admin_menu', 'add_custom_dashboard_pages');
function add_custom_dashboard_pages()
{
  /* Felhasználói lista */
  add_menu_page(
    'Felhasználók',
    'Felhasználók',
    'edit_posts',
    'list_users',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/list_users.php');
      }
    },
    'dashicons-groups'
  );

  /* Új kategória */
  add_menu_page(
    'Új kategória',
    'Új kategória',
    'edit_posts',
    'add_category',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/add_category.php');
      }
    },
    'dashicons-plus'
  );

  /* Kategória lista */
  add_menu_page(
    'Kategóriák',
    'Kategóriák',
    'edit_posts',
    'list_categories',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/list_categories.php');
      }
    },
    'dashicons-category'
  );

  /* Kategória szerkesztő */
  add_submenu_page(
    'wpa/list_categories.php',
    'Kategória szerkesztése',
    'Kategória szerkesztése',
    'edit_posts',
    'edit_category',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/edit_category.php');
      }
    },
    1,
    'dashicons-category'
  );

  /* Új rejtvény */
  add_menu_page(
    'Új rejtvény',
    'Új rejtvény',
    'edit_posts',
    'add_riddle',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/add_riddle.php');
      }
    },
    'dashicons-plus'
  );

  /* Rejtvény lista */
  add_menu_page(
    'Rejtvények',
    'Rejtvények',
    'edit_posts',
    'list_riddles',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/list_riddles.php');
      }
    },
    'dashicons-category'
  );

  /* Rejtvény szerkesztő */
  add_submenu_page(
    'wpa/list_riddles.php',
    'Rejtvény szerkesztése',
    'Rejtvény szerkesztése',
    'edit_posts',
    'edit_riddle',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/edit_riddle.php');
      }
    },
    1,
    'dashicons-category'
  );

  /* Konfiguráció szereksztő */
  add_menu_page(
    'Konfiguráció',
    'Konfiguráció',
    'edit_posts',
    'edit_configuration',
    function () {
      if (!current_user_can('manage_options')) {
        wp_die('Nincs jogosultságod az oldal megtekintéséhez');
      } else {
        include_once('wpa/edit_configuration.php');
      }
    },
    'dashicons-database'
  );
}
