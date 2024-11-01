<?php
/**
 * Plugin Name: Twami
 * Plugin URI:  
 * Description: Setting up Twami
 * Version:     1.0.0
 * Author:      Martin Hjort
 * Author URI:  http://spicyweb.dk
 */

global $wp_version;

if(!version_compare($wp_version, '3.0', '>='))
{
   die('Plugin needs at least WordPress version 3.5 or higher');
}

if ( !defined( 'TWAMI_DIR' ) ) {
	define( 'TWAMI_DIR', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'TWAMI_URL' ) ) {
	define( 'TWAMI_URL', plugin_dir_url( __FILE__ ) );
}

include_once TWAMI_DIR .'inc/twami.php';

function twami_plugin_activate() {}

register_activation_hook( __FILE__, 'twami_plugin_activate' );

/* Deactivate plugin */
function twami_plugin_deactivate() {}

register_deactivation_hook( __FILE__, 'twami_plugin_deactivate' );

?>
