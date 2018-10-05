<?php

add_action('admin_menu', 'add_admin_menu_page', $priority = 10, $accepted_args = 1);

function add_admin_menu_page()
{
    //create new top-level menu
    add_menu_page('Contact Form 7 telegram settings', 'CF7 Tg', 'administrator', __FILE__, 'db_settings_page', plugins_url('/icon.png', __FILE__));
}

function db_settings_page()
{
    ?>
    <h1>Hello!</h1>

  <?php
global $wpdb;
    $table_name            = $wpdb->prefix . 'db_emojis_database';
    $search_emojis         = "SELECT emoji FROM $table_name";
    $search_replacment     = "SELECT replacement FROM $table_name";
    $search_results_emojis = $wpdb->get_results($search_emojis, ARRAY_N);
    $emojis                = array_map('filter_db_output', $search_results_emojis);

    $search_results_replacment = $wpdb->get_results($search_replacment, ARRAY_N);
    $replacements              = array_map('filter_db_output', $search_results_replacment);
    $data_to_be_passed         = array(
        'emojis'       => $emojis,
        'replacements' => $replacements,
    );

    print_r($data_to_be_passed);
    ?>
  <?php
}

function filter_db_outpuat($item)
{
    return $item[0];
}
