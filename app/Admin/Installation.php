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
		global $wpdb;
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$wpdb->hide_errors();
		$charset_collate = $wpdb->get_charset_collate();
		$table_name      = $wpdb->prefix . 'wpsf_feedback';
		$query           = "CREATE TABLE $table_name (
                                  `id` bigint NOT NULL AUTO_INCREMENT,
                                  `name` varchar(255) NOT NULL,
                                  `feedback` text NOT NULL,
                                  `created_at` timestamp NOT NULL,
                                 PRIMARY KEY (`id`)
                            ) $charset_collate;";

        // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		if ( strtolower( $wpdb->get_var( 'show tables like ' . esc_sql( $table_name ) ) ) !== strtolower( $table_name ) ) {
			dbDelta( $query );
		}
	}
}
