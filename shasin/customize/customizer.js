/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Background color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			if ( to !== 'ffffff' || to !== '' ) {
				$( 'body' ).removeClass( 'elara-background-color-default' );
				$( 'body' ).addClass( 'elara-background-color-custom' );
			} else {
				$( 'body' ).removeClass( 'elara-background-color-custom' );
				$( 'body' ).addClass( 'elara-background-color-default' );
			}
		} );
	} );

} )( jQuery );
