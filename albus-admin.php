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

function load_custom_wp_admin_style() {

  wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'albus-style.css', false, '1.0.0' );
  wp_enqueue_style( 'custom_wp_admin_css' );

}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');


?>