<?php
/*
Plugin Name:  Albus Admin
Plugin URI:   kreislinie.com/albus
Description:  -
Version:      0.0.1
Author:       Simon Mettler
Author URI:   kreislinie.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/* ------------------------------------------------------------
  1.0 - Load admin styles
------------------------------------------------------------ */

function load_custom_wp_admin_style() {

  wp_register_style( 'albus_style', plugin_dir_url( __FILE__ ) . 'albus-style.css', false, '1.0.0' );
  wp_enqueue_style( 'albus_style' );

  wp_enqueue_script('albus_script', plugin_dir_url( __FILE__ ) . 'js/albus-script.min.js', [], '1.0.0', true);

}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style'); // backend
add_action('admin_bar_init', 'load_custom_wp_admin_style'); // frontend (admin bar)


?>