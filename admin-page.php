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
    $table_name = $wpdb->prefix . 'db_emojis_database';
    $file_name = dirname(__FILE__) . '/emojis.csv';
    ini_set('auto_detect_line_endings', true);
    $handle = fopen($file_name, 'r');
    // $data   = fgetcsv($handle);
    $row = 1;
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $replacement = strtolower($data[1]);

        $search         = "SELECT * FROM $table_name WHERE replacement = '$replacement'";
        $search_results = $wpdb->get_results($search);

        if (count($search_results) === 0) {
            $insert  = "INSERT INTO " . $table_name . "(emoji, replacement) VALUES ('" . $data[0] . "', '" . $replacement . "')";
            $results = $wpdb->query($insert);
        }

        $row++;
    }
    fclose($handle);
    ?>
  <?php
}
