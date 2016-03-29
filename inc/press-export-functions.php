<?php

/**
 * Basic functions to be used outside of plugin objects
 *
 * @author	Tyler Bailey
 * @since   1.0.0
 * @package Press Export
 */
 
function get_document_url($file) {
	return Press_Export_Base::get_instance()->get_document_url($file);
}