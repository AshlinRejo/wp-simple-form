<?php
/**
 * Model Feedback
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm\Model;

use WPSimpleForm\Helper\Common;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Feedback
 */
class Feedback {

	/**
	 * Class instance.
	 *
	 * @var Feedback $instance
	 * */
	protected static $instance = null;

	/**
	 * Get class instance.
	 *
	 * @return Feedback
	 */
	public static function instance() {
		if ( ! static::$instance ) {
			static::$instance = new static();
		}
		return static::$instance;
	}

	/**
	 * Get table name
	 *
	 * @return string identifier
	 * */
	public static function get_table_name() {
		global $wpdb;
		return $wpdb->prefix . 'wpsf_feedback';
	}

	/**
	 * Add to DB
	 *
	 * @param array $data column to add.
	 * @return boolean|integer
	 * */
	public function add( $data ) {
		if ( empty( $data['name'] ) || empty( $data['feedback'] ) ) {
			return false;
		}
		global $wpdb;
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$wpdb->hide_errors();
		$created_at = Common::instance()->get_current_utc_date_and_time();
		$values     = array(
			'name'       => $data['name'],
			'feedback'   => $data['feedback'],
			'created_at' => $created_at,
		);

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
		$result = $wpdb->insert( self::get_table_name(), $values );
		if ( false === $result ) {
			return false;
		}
		// Returns the last inserted ID.
		return $wpdb->insert_id;
	}

	/**
	 * Get items
	 *
	 * @param string $search Name for search.
	 * @return mixed
	 * */
	public function get_items( $search = '' ) {
		global $wpdb;
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$wpdb->hide_errors();
		$table_name = self::get_table_name();
		$items      = wp_cache_get( 'wp_simple_feedback_items_' . $search );
		if ( ! $items ) {
			if ( empty( $search ) ) {
                // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$items = $wpdb->get_results( "SELECT * FROM `$table_name` ORDER BY `created_at` DESC" );
			} else {
                // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.PreparedSQL.InterpolatedNotPrepared
				$items = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `$table_name` WHERE `name` like %s ORDER BY `created_at` DESC", '%' . $wpdb->esc_like( $search ) . '%' ), OBJECT );
			}
			wp_cache_set( 'wp_simple_feedback_items_' . $search, $items );
		}

		return $items;
	}
}
