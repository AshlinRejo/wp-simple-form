<?php
/**
 * Admin Installation controller
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm\Admin;

use WPSimpleForm\Helper\Common;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin Plugin installation
 */
class Installation {

	/**
	 * Process plugin installation
	 * */
	public function process_plugin_installation() {
		if ( ! Common::is_administrator() ) {
			return;
		}
		$this->add_db_tables();
	}

	/**
	 * Add tables if required
	 * */
	private function add_db_tables() {
	}
}
