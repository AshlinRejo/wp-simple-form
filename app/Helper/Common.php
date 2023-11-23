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
	 * Class instance.
	 *
	 * @var Common $instance
	 * */
	protected static $instance = null;

	/**
	 * Get class instance.
	 *
	 * @return Common
	 */
	public static function instance() {
		if ( ! static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Check current user has administrator privilege
	 *
	 * @return boolean
	 * */
	public static function is_administrator() {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Get current MySQL date and time in UTC
	 *
	 * @return string
	 * */
	public function get_current_utc_date_and_time() {
		return current_time( 'mysql', 1 );
	}
}
