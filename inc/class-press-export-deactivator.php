<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to decativate the plugin
 *
 * @author 	Tyler Bailey
 * @version 1.0.0
 * @package Press-Export
 * @subpackage press-export/inc
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('Press_Export_Deactivator')) :

	class Press_Export_Deactivator {

		/**
		 * Fired on plugin deactivation
		 *
		 * @since    1.0.0
		 */
		public static function deactivate() {
			// nothing here yet
		}
	}
	
endif;
