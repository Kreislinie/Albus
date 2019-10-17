<?php
/*
Plugin Name:  Albus Admin 
Plugin URI:   https://github.com/Kreislinie/albus-admin 
Description:  Light WordPress backend theme. 
Version:      v0.1.0 
Author:       Kreislinie - Simon Mettler 
Author URI:   kreislinie.com 
License:      GPLv3 
License URI:  https://www.gnu.org/licenses/gpl-3.0.html 
Text Domain:  albus-admin
*/

if ( ! defined( 'ABSPATH' ) )
  exit;
  
/* ------------------------------------------------------------
  1.0 - Syles and scripts
------------------------------------------------------------ */

function load_custom_wp_admin_style() {

  wp_register_style( 'albus_style', plugin_dir_url( __FILE__ ) . 'albus-style.css', false, '0.1.0' );
  wp_enqueue_style( 'albus_style' );

  wp_enqueue_script('albus_script', plugin_dir_url( __FILE__ ) . 'js/custom.min.js', [], '0.1.0', true);

      // WordPress library
      wp_enqueue_media();

}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style'); // backend
add_action('admin_bar_init', 'load_custom_wp_admin_style'); // frontend (admin bar)


/* ------------------------------------------------------------
  2.0 - Footer text
------------------------------------------------------------ */
 
// New footer text.
function albus_footer_text() {
  return '<a target="_blank" href="https://de.wordpress.com/">WordPress</a> & <a target="_blank" href="https://github.com/Kreislinie/albus-admin">Albus Admin</a>';
}

// Fired before left side footer text is echoed.
add_filter('admin_footer_text', 'albus_footer_text');


/* ------------------------------------------------------------
  3.0 - Option
------------------------------------------------------------ */

// Adds option page.
function albus_options_menu() {
	add_options_page( 'Albus Admin', 'Albus Admin', 'manage_options', 'albus-options-page', 'albus_options_page' );
}

add_action( 'admin_menu', 'albus_options_menu' );


function albus_options_settings_init() {

  register_setting( 'albus-options', 'albus_options' );

  add_settings_section( 
    'albus_settings_section', 
    __( 'Custom Logo', 'albus-admin' ), 
    'albus_settings_section_callback', 
    'albus-options' 
  );

  add_settings_field( 
    'albus_settings_field_logo', 
    __( 'Logo', 'albus-admin' ), 
    'albus_settings_field_logo_render', 
    'albus-options', 
    'albus_settings_section' 
  );

}

add_action( 'admin_init', 'albus_options_settings_init' );


function albus_settings_field_logo_render() {

  $albus_options = get_option( 'albus_options' );
  
  $default_image = plugins_url('img/albus-admin-default-logo.jpg', __FILE__);
  $name="albus_custom_logo";

  if ( !empty( $albus_options[$name] ) ) {

    $image_attributes = wp_get_attachment_image_src( $albus_options[$name] );
    $src = $image_attributes[0];
    $value = $albus_options[$name];

  } else {
      
    $src = $default_image;
    $value = '';

  }
  $text = __( 'Upload', 'albus-admin' );

  ?>

  <div class="upload">
    <img data-src="<?php echo $default_image?>" src="<?php echo $src?>" width="176px" height="auto" />

    <div>

      <input type="hidden" name="albus_options[<?php echo $name ?>]" id="albus_options[<?php echo $name ?>]" value="<?php echo $value ?>" />
      <button type="submit" class="upload_image_button button"><?php echo $text ?></button>
      
      <?php
      if ( !empty( $albus_options[$name] ) ) {
        echo '<button type="submit" class="remove_image_button button">Clear</button>';
      }
      ?>
      
    </div>

  </diV>
  
  <?php

}

function albus_settings_section_callback() {
  echo __( '(ToDo) Description', 'albus-admin' );
}

function albus_options_page(  ) {
  ?>

  <div class="wrap">

    <form action='options.php' method='post'>
      <h1><?php esc_html_e( 'Albus Admin Settings', 'albus-admin')?></h1>

      <?php
        settings_fields( 'albus-options' );
        do_settings_sections( 'albus-options' );
        submit_button();
      ?>
  
    </form>

  </div>

  <?php 
}


/* ------------------------------------------------------------
  4.0 - Update functionality
------------------------------------------------------------ */

require 'vendors/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/Kreislinie/albus-admin/',
	__FILE__,
	'albus-admin'
);

?>