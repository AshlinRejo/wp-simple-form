<?php
/**
 * Feedback controller
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm\Site;

use WPSimpleForm\Controller;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Feedback Form
 */
class Feedback extends Controller {

	/**
	 * Register the event
	 * */
	public function hooks() {
		add_shortcode( 'wp_simple_feedback_form', array( $this, 'load_form' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	/**
	 * Load frontend CSS and Javascript script files,
	 * */
	public function load_scripts() {
		wp_enqueue_style( 'wp-simple-form-frontend-css', WP_SIMPLE_FORM_URL . 'assets/css/wp-simple-form.css', array(), WP_SIMPLE_FORM_VERSION );
		wp_enqueue_script( 'wp-simple-form-frontend-js', WP_SIMPLE_FORM_URL . 'assets/js/wp-simple-form.js', array( 'jquery' ), WP_SIMPLE_FORM_VERSION, true );
		$localize_script = $this->get_localize_script_data();
		wp_localize_script( 'wp-simple-form-frontend-js', 'wpSimpleForm', $localize_script );
	}

	/**
	 * To get localize data for javascript.
	 * */
	private function get_localize_script_data() {
		return array(
			'_ajax_nonce' => wp_create_nonce( 'wp-simple-form-ajax-nonce' ),
			'_ajax_url'   => admin_url( 'admin-ajax.php' ),
		);
	}

	/**
	 * Load form through shortcode.
	 * */
	public function load_form() {
		$filepath = WP_SIMPLE_FORM_PATH . 'app/Site/templates/form.php';
		$data     = array();
		return $this->get_content( $filepath, $data );
	}
}
