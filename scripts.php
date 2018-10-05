<?php
/**
 * Register scripts worjing on frontend
 * @package         Db_Emojis_Auto_Replacer
 */

function db_emojis_auto_replacer_register_scripts()
{
    wp_enqueue_script('db_emojis_auto_replacer_script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'));
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

    // 2. localize script with emojis
    wp_localize_script('db_emojis_auto_replacer_script', 'php_vars', $data_to_be_passed);
}

add_action('init', 'db_emojis_auto_replacer_register_scripts');

/**
 * Filter output in database
 * @param  [type] $item [description]
 * @return [type]       [description]
 */
function filter_db_output($item)
{
    return $item[0];
}
