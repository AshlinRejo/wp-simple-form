<?php
/**
 * Feedback layout
 *
 * @package wp-simple-form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wpsf-feedback-container">
	<div class="wpsf-feedback-title-block">
		<h3><?php esc_html_e( 'Feedbacks', 'wp-simple-form' ); ?></h3>
	</div>
	<div class="wpsf-feedback-filters">
		<input type="text" class="wpsf-search" id="wpsf-search" placeholder="<?php esc_html_e( 'Search by name', 'wp-simple-form' ); ?>" />
		<button id="wpsf-feedback-filter-btn" type="button"><?php esc_html_e( 'Go', 'wp-simple-form' ); ?></button>
	</div>
	<div class="wpsf-feedback-list-container">
		<?php require 'feedback-list.php'; ?>
	</div>
</div>
