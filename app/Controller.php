<?php
/**
 * Base Controller
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base controller for register and initialise the event
 */
abstract class Controller {

	/**
	 * Protected variable
	 *
	 * @var string
	 * */
	protected $path = '';

	/**
	 * Protected variable
	 *
	 * @var array
	 * */
	protected $data = array();

	/**
	 * Initialise the event
	 * */
	public function init() {
		$this->hooks();
	}

	/**
	 * To render content from a file
	 *
	 * @param string $path Path to template file.
	 * @param array  $data Available variables in template file.
	 * */
	public function render( $path, $data = array() ) {
		$this->set_path( $path )->set_data( $data )->display();
	}

	/**
	 * Get HTML content
	 *
	 * @param string $path Path to template file.
	 * @param array  $data Available variables in template file.
	 * @return string
	 * */
	public function get_content( $path, $data = array() ) {
		return $this->set_path( $path )->set_data( $data )->return_content();
	}

	/**
	 * Set the file path
	 *
	 * @param string $path Path to template file.
	 * @return object   $this Current object.
	 */
	protected function set_path( $path ) {
		$this->path = $path;
		return $this;
	}

	/**
	 * Set data for template
	 *
	 * @param array $data Available variables in template file.
	 * @return object   $this Current object.
	 */
	protected function set_data( $data ) {
		$this->data = $data;
		return $this;
	}

	/**
	 * Load template contents
	 */
	protected function display() {
		ob_start();
		if ( file_exists( $this->path ) ) {
			$vars = $this->data;
			include $this->path;
		}
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput
	}

	/**
	 * Return template contents
	 */
	protected function return_content() {
		ob_start();
		if ( file_exists( $this->path ) ) {
			$vars = $this->data;
			include $this->path;
		}
		return ob_get_clean();
	}

	/**
	 * Method to register hooks/events
	 * */
	abstract public function hooks();
}
