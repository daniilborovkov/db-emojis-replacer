<?php

/**
 * Write to text log
 * @param  [type] $message [description]
 * @return [type]          [description]
 */
function custom_logs($message)
{
    $log_folder = wp_upload_dir()['basedir'] . '_emojis_log';
    if (is_array($message)) {
        $message = json_encode($message);
    }
    $now  = date('Y-m-d');
    $file = fopen($log_folder . "/custom_logs_$now.log", "a");
    fwrite($file, "\n" . date('Y-m-d h:i:s') . " :: " . $message);
    fclose($file);
}

add_action('rest_api_init', function () {
    register_rest_route('db-dmoji-replace/v1', 'log', array(
      'methods' => 'GET',
      'callback' => 'db_emojis_auto_replacer_log'
    ));
});

function db_emojis_auto_replacer_log($data) {
  $message = $data['log'];
  custom_logs($message);
}
