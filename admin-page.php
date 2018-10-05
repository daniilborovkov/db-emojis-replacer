<?php

add_action('admin_menu', 'add_admin_menu_page', $priority = 10, $accepted_args = 1);

function add_admin_menu_page()
{
    //create new top-level menu
    add_menu_page('Contact Form 7 telegram settings', 'CF7 Tg', 'administrator', __FILE__, 'db_settings_page', plugins_url('/icon.png', __FILE__));
}

function custom_logs($message)
{
    $log_folder =  wp_upload_dir()['basedir'] . '_emojis_log';
    if (is_array($message)) {
        $message = json_encode($message);
    }
    $now = date('Y-m-d');
    $file = fopen($log_folder . "/custom_logs_$now.log", "a");
    echo fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message);
    fclose($file);
}

function db_settings_page()
{
    ?>
    <h1>Hello!</h1>

  <?php
custom_logs("Hello!");
    ?>
  <?php
}
