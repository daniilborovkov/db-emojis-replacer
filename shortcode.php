<?php
/**
 * @package         Db_Emojis_Auto_Replacer
 */

add_shortcode( 'emoji-auto-replacer', 'db_emojis_auto_replacer_register_shortcode' );

function db_emojis_auto_replacer_register_shortcode() {
  ?>
    <label for="typed_text"><?php echo __('Type in some text', 'db-emojis-autoreplacer'); ?></label>
    <textarea name="typed_text" id="typed_text" cols="30" rows="10"></textarea>
    <br>
    <label for="output_text"><?php echo __('Result', 'db-emojis-autoreplacer'); ?>:</label>
    <textarea name="output_text" id="output_text" cols="30" rows="10" readonly="true"></textarea>
  <?php
}