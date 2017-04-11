<?php

/**
 * The base class for the Press Export plugin
 *
 * @author 	Tyler Bailey
 * @version 1.0.0
 * @package Press-Export
 * @subpackage press-export/inc
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('Press_Export_Base')) :

	class Press_Export_Base {

		/**
	     * Plugin slug
	     *
	     * @since 1.0.0
	     *
	     * @type string
	     */
		public $plugin_slug;

		/**
	     * Class instance variable
	     *
	     * @since 1.0.0
	     *
	     * @type object ::self
	     */
		public static $instance;

		/**
	     * URL of exported files
	     *
	     * @since 1.0.0
	     *
	     * @type string
	     */
		public $export_url;

		/**
	     * Dirtectory to save exported files
	     *
	     * @since 1.0.0
	     *
	     * @type string
	     */
		protected $export_dir;

		/**
		 * Define class & plugin variables
		 *
		 * @return 	null
		 * @since   1.0.0
		 */
		public function __construct() {
			// Get self instance
			self::$instance = $this;

			$this->plugin_slug = 'press-export';

			// Export directory/url
			$wp_upload_dir = wp_upload_dir();
			$this->export_url = $wp_upload_dir['baseurl'] . '/' . $this->plugin_slug;
			$this->export_dir = $wp_upload_dir['basedir'] . '/' . $this->plugin_slug . '/';
		}

		/**
		 * Return instance of base class
		 *
		 * @return 	null
		 * @since   1.0.0
		 */
		public static function get_instance() {
			if(self::$instance === null) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Return the url of the supplied document
		 *
		 * @param	string $file
		 * @return 	string
		 * @since   1.0.0
		 */
		public function get_document_url($file) {
			return $this->export_url . '/' . $file;
		}
	}

endif;
