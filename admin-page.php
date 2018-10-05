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
    $charset_collate = $wpdb->get_charset_collate();

    // 1. create database tabled
    $table_name = $wpdb->prefix . 'db_emojis_database';
    $sql        = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      emoji varchar(120) NOT NULL,
      replacement varchar(120) NOT NULL,
      PRIMARY KEY (id)
    ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
    // 2. seed from csv file
    // 2. seed from csv file
    $file_name = dirname(__FILE__) . '/emojis.csv';
    ini_set('auto_detect_line_endings', true);
    $handle = fopen($file_name, 'r');
    // $data   = fgetcsv($handle);
    $row                 = 1;
    $emojis_insert_query = "INSERT INTO " . $table_name . "(emoji, replacement) VALUES ";
    $values = array();
    $place_holders = array();
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $replacement = strtolower($data[1]);
        $replacement = addslashes($replacement);

        $search         = "SELECT * FROM $table_name WHERE replacement = '$replacement'";
        $search_results = $wpdb->get_results($search);

        if (count($search_results) === 0) {
            // $insert  = "INSERT INTO " . $table_name . "(emoji, replacement) VALUES ('" . $data[0] . "', '" . $replacement . "')";
            // $emojis_insert_query .= "('" . $data[0] . "', '" . $replacement . "')";
            array_push($values, $data[0], $replacement);
            $place_holders[] = "('%s', '%s')";
        }

        $row++;
    }

    $emojis_insert_query .= implode(', ', $place_holders);

    $results = $wpdb->query($wpdb->prepare("$emojis_insert_query ", $values));
    fclose($handle);
    create_folder($table_name);
    ?>
  <?php
}

function filter_db_outpuat($item)
{
    return $item[0];
}
