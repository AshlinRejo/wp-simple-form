<?php
/**
 * Feedback form template
 *
 * @package wp-simple-form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wpsf-form-container">
	<form id="wpsf-form" method="post">
		<div class="wpsf-form-title-block">
			<h3><?php esc_html_e( 'Feedback form', 'wp-simple-form' ); ?></h3>
		</div>
		<div class="wpsf-form-success-message-block"></div>
		<div class="wpsf-form-block">
			<div class="wpsf-form-block-label">
				<label for="wpsf-name"><?php esc_html_e( 'Name', 'wp-simple-form' ); ?> <span class="required">*</span></label>
			</div>
			<div class="wpsf-form-block-field">
				<input name="name" id="wpsf-name" placeholder="<?php esc_attr_e( 'Enter your name', 'wp-simple-form' ); ?>" value=""/>
			</div>
		</div>
		<div class="wpsf-form-block">
			<div class="wpsf-form-block-label">
				<label for="wpsf-feedback"><?php esc_html_e( 'Feedback', 'wp-simple-form' ); ?> <span class="required">*</span></label>
			</div>
			<div class="wpsf-form-block-field">
				<textarea name="feedback" id="wpsf-feedback" placeholder="<?php esc_attr_e( 'Enter your feedback', 'wp-simple-form' ); ?>"></textarea>
			</div>
		</div>
		<div class="wpsf-form-block">
			<div class="wpsf-form-button">
				<button type="submit"><?php esc_html_e( 'Add', 'wp-simple-form' ); ?></button>
			</div>
		</div>
	</form>
</div>
