<?php
/**
 * Plugin main file
 *
 * @package wp-simple-form
 */

/**
 * Plugin name: WP Simple Form
 * Description: A WordPress plugin to display a form and listing using shortcode.
 * Author: Ashlin
 * Author URI: https://github.com/AshlinRejo
 * Version: 1.0
 * Slug: wp-simple-form
 * Text Domain: wp-simple-form
 * Domain Path: languages
 * Requires at least: 5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WP_SIMPLE_FORM_PATH', realpath( plugin_dir_path( __FILE__ ) ) . '/' );
define( 'WP_SIMPLE_FORM_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_SIMPLE_FORM_PHP_VERSION', '7.2' );
define( 'WP_SIMPLE_FORM_WP_VERSION', '5.0' );
define( 'WP_SIMPLE_FORM_VERSION', '1.0.0' );

require WP_SIMPLE_FORM_PATH . 'inc/wp-simple-form-requirement-checks.php';

// Checks plugin requirement.
if ( ( new WP_Simple_Form_Requirement_Checks() )->check() ) {
	// Composer autoload.
	if ( file_exists( WP_SIMPLE_FORM_PATH . 'vendor/autoload.php' ) ) {
		require WP_SIMPLE_FORM_PATH . 'vendor/autoload.php';
	}

	// while activate plugin.
	register_activation_hook( __FILE__, array( WPSimpleForm\Plugin::instance(), 'plugin_activated' ) );

	add_action( 'plugins_loaded', array( WPSimpleForm\Plugin::instance(), 'load' ) );
}
