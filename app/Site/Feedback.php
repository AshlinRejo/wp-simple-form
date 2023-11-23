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
