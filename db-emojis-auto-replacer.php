<?php
/**
 * Plugin Name:     Db Emojis Auto Replacer
 * Plugin URI:      daniilborovkov.github.io/db-emojis-autoreplacer
 * Description:     Small shortcoded plugin for autoreplacer
 * Author:          Daniil Borovkov
 * Author URI:      daniilborovkov.github.io
 * Text Domain:     db-emojis-auto-replacer
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Db_Emojis_Auto_Replacer
 */

require plugin_dir_path(__FILE__) . 'shortcode.php';
require plugin_dir_path(__FILE__) . 'scripts.php';
require plugin_dir_path(__FILE__) . 'admin-page.php';

register_activation_hook(__FILE__, 'db_emojis_auto_replacer_activator');

/**
 * Activator or plugin
 * @return [type] [description]
 */
function db_emojis_auto_replacer_activator()
{
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
}
