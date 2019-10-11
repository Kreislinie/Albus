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
	add_options_page( 'Albus Admin Options', 'Albus Admin', 'manage_options', 'albus-admin', 'albus_options' );
}

add_action( 'admin_menu', 'albus_options_menu' );

// Options page content.
function albus_options() {

  // Checks permissions.
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }
  
  // Page content
  echo '<div class="wrap"><h1>Albus Admin Settings</h1></div>';

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