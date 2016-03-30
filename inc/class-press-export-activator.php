<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @author 	Tyler Bailey
 * @version 1.0.0
 * @package Press Export
 * @subpackage Press Export/includes
 */
class Press_Export_Activator {

	/**
	 * Fired upon plugin activation
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		self::pe_system_requirements_met();
		self::pe_create_directory();
	}


	/**
	 * Creates the 'press-export' directory in the '/uploads/' directory
	 *
	 * @since	1.0.0
	 * @return 	null | string
	 */
	private function pe_create_directory() {
		$wp_upload = wp_upload_dir();
		$wp_upload_dir = $wp_upload['basedir'];
		$pe_upload_dir = $wp_upload_dir . '/press-export';

		if(!is_dir($pe_upload_dir)) {
			wp_mkdir_p($pe_upload_dir);
		}
	}


	/**
	 * Checks if the system requirements are met
	 *
	 * @since	1.0.0
	 * @return 	bool True if system requirements are met, die() message if not
	 */
	private function pe_system_requirements_met() {
		global $wp_version;

		if ( version_compare( PHP_VERSION, PE_REQUIRED_PHP_VERSION, '<' ) ) {
			wp_die(__("PHP 5.3 is required to run this plugin.", 'press-export'), __('Incompatible PHP Version', 'press-export'));
		}
		if ( version_compare( $wp_version, PE_REQUIRED_WP_VERSION, '<' ) ) {
			wp_die(__("You must be running at least WordPress 3.5 for this plugin to function properly.", 'press-export'), __('Incompatible WordPress Version.', 'press-export'));
		}

		return true;
	}
}
