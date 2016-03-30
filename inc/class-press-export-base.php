<?php

/**
 * The base class for the Press Export plugin
 *
 * @author 	Tyler Bailey
 * @version 1.0.0
 * @package Press Export
 * @subpackage Press Export/includes
 */

class Press_Export_Base {

	public static $instance;

	public $export_url;
	protected $export_dir;

	/**
	 * __construct()
	 *
	 * @return 	null
	 * @author  Tyler Bailey
	 * @since    1.0.0
	 */
	public function __construct() {
		// Get self instance
		self::$instance = $this;

		// Export directory/url
		$wp_upload_dir = wp_upload_dir();
		$this->export_url = $wp_upload_dir['baseurl'] . '/press-export';
		$this->export_dir = $wp_upload_dir['basedir'] . '/press-export/';
	}

	/**
	 * get_instance()
	 *
	 * Return instance of base class
	 *
	 * @return 	null
	 * @author  Tyler Bailey
	 * @since    1.0.0
	 */
	public static function get_instance() {
		if(self::$instance === null) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * get_document_url($file)
	 *
	 * Return the url of the generated document
	 *
	 * @param	string $file
	 * @return 	string
	 * @author  Tyler Bailey
	 * @since    1.0.0
	 */
	public function get_document_url($file) {
		return $this->export_url . '/' . $file;
	}
}
