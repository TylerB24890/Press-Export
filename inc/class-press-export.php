<?php

/**
 * Press Export Plugin Bootstrap File
 *
 * @author 	Tyler Bailey
 * @version 1.0
 * @package Press Export
 * @subpackage Press Export/includes
 */

class Press_Export {

	/**
	 * Plugin initialization functions
	 *
	 * @return 	null
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->load_dependencies();
	}


	/**
	 * Loads all required plugin files and istantiates classes
	 *
	 * @return 	null
	 * @since   1.0.0
	 */
	protected function load_dependencies() {
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-base.php';
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-generate.php';

		new Press_Export_Generate();
	}
}
