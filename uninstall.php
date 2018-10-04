<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
// 1. delete table with all emojis
global $wpdb;
$table_name = $wpdb->prefix . 'db_emojis_database';
$wpdb->query("DROP TABLE IF EXISTS $table_name");
