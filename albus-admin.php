<?php
/*
Plugin Name:  Albus Admin 
Plugin URI:   https://github.com/Kreislinie/albus-admin 
Description:  Light and clean WordPress backend theme. 
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
  1.0 - Load admin styles
------------------------------------------------------------ */

function load_custom_wp_admin_style() {

  wp_register_style( 'albus_style', plugin_dir_url( __FILE__ ) . 'albus-style.css', false, '0.1.0' );
  wp_enqueue_style( 'albus_style' );

  wp_enqueue_script('albus_script', plugin_dir_url( __FILE__ ) . 'js/custom.min.js', [], '0.1.0', true);

}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style'); // backend
add_action('admin_bar_init', 'load_custom_wp_admin_style'); // frontend (admin bar)


//fired before left side footer text is echoed.
add_filter('admin_footer_text', 'my_footer_text');
//fired before right side footer text is echoed. Third parameter is just a indication of a version number, its values doesn't make any other sense.
add_filter('update_footer', 'my_footer_version', 11);
 
//$default represents the existing text in the left side
function my_footer_text($default) {
    //return the new footer text
    return '<a target="_blank" href="https://de.wordpress.com/">WordPress</a> & <a target="_blank" href="https://github.com/Kreislinie/albus-admin">Albus Admin</a>';
}

//$default represents the exisiting text in the right side
function my_footer_version($default) {
    //return the new footer text
    return $default;
}

/* ------------------------------------------------------------
  2.0 - Add update functionality
------------------------------------------------------------ */

require 'vendors/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/Kreislinie/albus-admin/',
	__FILE__,
	'albus-admin'
);

?>