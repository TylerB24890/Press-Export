<?php

/**
 * Press Export Plugin Bootstrap File
 *
 * @author 	Tyler Bailey
 * @version 1.0
 * @package Press Export
 */

class Press_Export {
	
	/**
	 * __construct()
	 *
	 * Plugin initialization functions
	 * 
	 * @return 	null
	 * @author  Tyler Bailey
	 * @since    1.0.0
	 */
	public function __construct() {
		
		$this->load_dependencies();
	}
	
	
	/**
	 * load_dependencies()
	 *
	 * Loads all required plugin files and istantiates classes
	 * 
	 * @return 	null
	 * @author  Tyler Bailey
	 * @since   1.0.0
	 */
	protected function load_dependencies() {
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-base.php';
		require_once PE_GLOBAL_DIR . 'inc/class-press-export-generate.php';
		
		new Press_Export_Generate();
	}
}
