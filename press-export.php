<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://tylerb.me
 * @since             1.0.0
 * @package           Press Export
 *
 * @wordpress-plugin
 * Plugin Name:       Press Export
 * Plugin URI:        http://tylerb.me
 * Description:       A plugin to automatically generate DOCX, PDF, RTF and HTML files on publish of any post
 * Version:           1.0.0
 * Author:            Tyler Bailey
 * Author URI:        http://tylerb.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       press-export
 */



// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die("Sneaky sneaky...");
}

// Define constants
define('PE_VERSION', '1.0.0');
define('PE_GLOBAL_DIR', plugin_dir_path( __FILE__ ));
define('PE_GLOBAL_URL', plugin_dir_url( __FILE__ ));
define('PE_REQUIRED_PHP_VERSION', '5.3');
define('PE_REQUIRED_WP_VERSION',  '3.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-exporter-activator.php
 */
function activate_press_export() {
	require_once PE_GLOBAL_DIR . 'inc/class-press-export-activator.php';
	Press_Export_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-exporter-deactivator.php
 */
function deactivate_press_export() {
	require_once PE_GLOBAL_DIR . 'inc/class-press-export-deactivator.php';
	Press_Export_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_press_export' );
register_deactivation_hook( __FILE__, 'deactivate_press_export' );


/**
 * The core plugin classes that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require PE_GLOBAL_DIR .  'inc/class-press-export.php';

/**
 * Global Press Export functions for use outside of plugin objects
 */
require PE_GLOBAL_DIR . 'inc/press-export-functions.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
if(!function_exists('press_export_init')) {
	function press_export_init() {
		new Press_Export();
	}
}
add_action('init', 'press_export_init');