<?php
/**
 * Feedback list template
 *
 * @package wp-simple-form
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( empty( $vars ) ) {
	return;
}
?>
<div class="wpsf-feedback-list">
	<?php
	if ( empty( $vars['items'] ) ) {
		esc_html_e( 'No feedbacks available.', 'wp-simple-form' );
	} else {
		?>
		<table>
			<thead>
			<tr>
				<th><?php esc_html_e( 'Name', 'wp-simple-form' ); ?></th>
				<th><?php esc_html_e( 'Feedback', 'wp-simple-form' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ( $vars['items'] as $key => $item ) { ?>
				<tr>
					<td><?php echo esc_html( $item->name ); ?></td>
					<td><?php echo esc_html( $item->feedback ); ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php
	}
	?>
</div>
