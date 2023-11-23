/* global wpSimpleForm */
( function ( $ ) {
	$( document ).ready( function ( $ ) {
		// Handle Feedback form submition.
		$( 'form#wpsf-form' ).submit( function ( e ) {
			e.preventDefault();
			const messageBlock = $( this ).find(
				'.wpsf-form-success-message-block'
			);
			messageBlock.html( '' );
			const isValid = validateWPSimpleForm();
			if ( false === isValid ) {
				return;
			}

			const button = $( this ).find( 'button[type="submit"]' );
			const formData = $( this ).serializeArray();
			$.ajax( {
				url: wpSimpleForm._rest_url + 'wp-simple-form/v1/feedback',
				data: formData,
				type: 'POST',
				/**
				 * Before send ajax request.
				 */
				beforeSend: function () {
					button.attr( 'disabled', 'disabled' );
				},
				/**
				 * After complate ajax request.
				 */
				complete: function () {
					button.removeAttr( 'disabled' );
				},
				/**
				 * On succcess ajax request.
				 *
				 * @param {Object} response Response data.
				 */
				success: function ( response ) {
					if ( true === response.success ) {
						messageBlock.html( response.data );
						$( '#wpsf-name, #wpsf-feedback' ).val( '' );
						$( '#wpsf-feedback' ).html( '' );
					}
				},
			} );
		} );

		/**
		 * For validate form.
		 *
		 * @return boolean
		 */
		function validateWPSimpleForm() {
			$( '#wpsf-name, #wpsf-feedback' ).removeClass( 'required' );
			const name = $( '#wpsf-name' ).val();
			if ( null === name || '' === name ) {
				$( '#wpsf-name' ).addClass( 'required' );
				return false;
			}
			const feedback = $( '#wpsf-feedback' ).val();
			if ( null === feedback || '' === feedback ) {
				$( '#wpsf-feedback' ).addClass( 'required' );
				return false;
			}
			return true;
		}

		// Handle Feedback search filter.
		$( '#wpsf-feedback-filter-btn' ).click( function ( e ) {
			e.preventDefault();
			const button = $( this );
			const search = $( '#wpsf-search' ).val();
			$.ajax( {
				url:
					wpSimpleForm._rest_url +
					'wp-simple-form/v1/feedback?search=' +
					search,
				type: 'GET',
				/**
				 * Before send ajax request.
				 */
				beforeSend: function () {
					button.attr( 'disabled', 'disabled' );
				},
				/**
				 * After complate ajax request.
				 */
				complete: function () {
					button.removeAttr( 'disabled' );
				},
				/**
				 * On succcess ajax request.
				 *
				 * @param {Object} response Object Response data.
				 */
				success: function ( response ) {
					if ( true === response.success ) {
						button
							.closest( '#wpsf-feedback-container' )
							.find( '.wpsf-feedback-list-container' )
							.html( response.data.html );
					}
				},
			} );
		} );
	} );
} )( jQuery );
