<?php
/**
 * Helper common
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Common
 */
class Common {

	/**
	 * Check current user has administrator privilege
	 *
	 * @return boolean
	 * */
	public static function is_administrator() {
		return current_user_can( 'manage_options' );
	}
}
