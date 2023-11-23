<?php
/**
 * API Routes for Feedback
 *
 * @package wp-simple-form
 */

namespace WPSimpleForm\API;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * API Routes
 */
class Feedback extends \WP_REST_Controller {

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version   = '1';
		$namespace = 'wp-simple-form/v' . $version;
		$base      = 'feedback';
		register_rest_route(
			$namespace,
			'/' . $base,
			array(
				array(
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_items' ),
					'permission_callback' => '__return_true',
				),
				array(
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'add_item' ),
					'permission_callback' => '__return_true',
					'args'                => $this->get_schema_for_adding_item(),
				),
			)
		);
	}

	/**
	 * Get arguments for adding item
	 * */
	private function get_schema_for_adding_item() {
		return array(
			'name'     => array(
				'description'       => esc_html__( 'Name', 'wp-simple-form' ),
				'type'              => 'string',
				'validate_callback' => array( $this, 'validate_string' ),
				'sanitize_callback' => 'sanitize_text_field',
				'required'          => true,
			),
			'feedback' => array(
				'description'       => esc_html__( 'Feedback', 'wp-simple-form' ),
				'type'              => 'string',
				'validate_callback' => array( $this, 'validate_string' ),
				'sanitize_callback' => 'sanitize_textarea_field',
				'required'          => true,
			),
		);
	}

	/**
	 * Validate string
	 *
	 * @param mixed            $value   Value of the parameter.
	 * @param \WP_REST_Request $request Current request object.
	 * @param string           $param   The name of the parameter.
	 * @return true|\WP_Error
	 */
	public function validate_string( $value, $request, $param ) {
		$attributes = $request->get_attributes();
		$argument   = $attributes['args'][ $param ];
		if ( 'string' === $argument['type'] && ! is_string( $value ) ) {
			/* translators: %1$s: Field name. %2$s: Field type. */
			return new \WP_Error( 'rest_invalid_param', sprintf( esc_html__( '%1$s is not of type %2$s', 'wp-simple-form' ), $param, 'string' ), array( 'status' => 400 ) );
		}
	}

	/**
	 * Retrieves a collection of items.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 */
	public function get_items( $request ) {
		$search = $request->get_param( 'search' );
		$search = sanitize_text_field( wp_unslash( $search ) );
		$result = ( new \WPSimpleForm\Site\Feedback() )->load_feedback_list_table( $search );
		wp_send_json_success( $result, 200 );
	}

	/**
	 * Add an item.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return \WP_Error| void Response object on success, or WP_Error object on failure.
	 */
	public function add_item( $request ) {
		$data['name']     = $request->get_param( 'name' );
		$data['feedback'] = $request->get_param( 'feedback' );
		$result           = \WPSimpleForm\Model\Feedback::instance()->add( $data );
		if ( false !== $result ) {
			wp_send_json_success( esc_html__( 'Added successfully.', 'wp-simple-form' ), 200 );
		} else {
			return new \WP_Error(
				'failed-to-add',
				esc_html__( 'Failed to add.', 'wp-simple-form' ),
				array( 'status' => 409 )
			);
		}
	}
}
