<?php
/*
Plugin Name:  Albus Admin
Plugin URI:   kreislinie.com/albus
Description:  Backend theme based on the light and clean Gutenberg style.
Version:      v0.0.2
Author:       Kreislinie - Simon Mettler
Author URI:   kreislinie.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  albus-admin
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/* ------------------------------------------------------------
  1.0 - Load admin styles
------------------------------------------------------------ */

function load_custom_wp_admin_style() {

  wp_register_style( 'albus_style', plugin_dir_url( __FILE__ ) . 'albus-style.css', false, '0.0.2' );
  wp_enqueue_style( 'albus_style' );

  wp_enqueue_script('albus_script', plugin_dir_url( __FILE__ ) . 'js/custom.min.js', [], '0.0.2', true);

}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style'); // backend
add_action('admin_bar_init', 'load_custom_wp_admin_style'); // frontend (admin bar)


/* ------------------------------------------------------------
  2.0 - Add update functionality
------------------------------------------------------------ */

require 'vendors/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/Kreislinie/Albus/',
	__FILE__,
	'albus-admin'
);

$myUpdateChecker->getVcsApi()->enableReleaseAssets();

?>