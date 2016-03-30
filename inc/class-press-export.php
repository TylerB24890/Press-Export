<?php

/**
 * Press Export Plugin Bootstrap File
 *
 * @author 	Tyler Bailey
 * @version 1.0
 * @package Press-Export
 * @subpackage Press-Export/includes
 */

class Press_Export {

	/**
     * Plugin slug
     *
     * @since 1.0.0
     *
     * @type string
     */
	public $plugin_slug;

	/**
     * Plugin version
     *
     * @since 1.0.0
     *
     * @type string
     */
	private $version;

	/**
	 * Plugin initialization functions
	 *
	 * @return 	null
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_slug = 'press-export';
		$this->version = '1.0.0';

		$this->set_locale();
		$this->load_dependencies();
	}


	/**
	 * Loads all required plugin files and istantiates classes
	 *
	 * @return 	null
	 * @since   1.0.0
	 */
	private function load_dependencies() {
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-base.php';
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-generate.php';

		new Press_Export_Generate();
	}

	/**
	 * Loads the plugin text-domain for internationalization
	 *
	 * @return 	null
	 * @since   1.0.0
	 */
	private function set_locale() {
		load_plugin_textdomain( $this->plugin_slug, false, PE_GLOBAL_DIR . 'language' );
    }

}
