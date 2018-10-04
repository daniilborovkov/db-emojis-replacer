<?php
/**
 * Register scripts worjing on frontend
 * @package         Db_Emojis_Auto_Replacer
 */

function db_emojis_auto_replacer_register_scripts()
{
    wp_enqueue_script('db_emojis_auto_replacer_script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'));
}

add_action('init', 'db_emojis_auto_replacer_register_scripts');
