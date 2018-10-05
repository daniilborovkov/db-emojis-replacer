<?php
/**
 * @package         Db_Emojis_Auto_Replacer
 */

add_shortcode( 'emoji-auto-replacer', 'db_emojis_auto_replacer_register_shortcode' );

function db_emojis_auto_replacer_register_shortcode() {
  ?>
    <style>
      @keyframes fadeOutUp {
        0% {
          opacity: 1;
        }
        100% {
          opacity: 0;
          transform: translate3d(0,-200%,0);
        }
      }
      .btn-to-clipboard {
        border: none;
        outline: none;
        border-radius: 0px;
        padding: 10px;
        font-weight: bold;
        text-transform: uppercase;
        color: #fff;
        background-color: black;
        margin: 30px auto;
        /*margin-bottom: 0px;*/
        text-align: center;
      }
      .btn-wrapper {
        display: flex;
        flex-direction: row;
        justify-content: center;
        position: relative;
      }
      span.copy {
        position: absolute;
        color: white;
        background: rgba(0,0,0,.9);
        padding: 5px;
        top: 0;
        left: 154px;
        font-size: 1rem;
        animation-duration: 1s;
        animation-fill-mode: both;
        animation-name: fadeOutUp;
      }
      .copy-blob {
        display: none;
      }

      
    </style>
    <label for="typed_text"><?php echo __('Type in some text', 'db-emojis-autoreplacer'); ?></label>
    <textarea name="typed_text" id="typed_text" cols="30" rows="10"></textarea>
    <br>
    <label for="output_text"><?php echo __('Result', 'db-emojis-autoreplacer'); ?>:</label>
    <textarea name="output_text" id="output_text" cols="30" rows="10" readonly="true"></textarea>
    <div class="btn-wrapper"> 
      <!-- <span class="copy"><?php echo __('Copied', 'db-emojis-autoreplacer'); ?></span> -->
      <button class="btn-to-clipboard" id="btn-to-clipboard"><?php echo __('COPY', 'db-emojis-autoreplacer'); ?></button>
    </div>
  <?php
}