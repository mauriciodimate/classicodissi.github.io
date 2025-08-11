/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Custom theme options
	wp.customize( 'vogue_clone_primary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $('#vogue-clone-custom-color-css');
			if ( style.length ) {
				style.remove();
			}
			
			$('head').append('<style id="vogue-clone-custom-color-css">:root { --primary-color: ' + to + '; }</style>');
		} );
	} );

	wp.customize( 'vogue_clone_secondary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $('#vogue-clone-custom-secondary-color-css');
			if ( style.length ) {
				style.remove();
			}
			
			$('head').append('<style id="vogue-clone-custom-secondary-color-css">:root { --secondary-color: ' + to + '; }</style>');
		} );
	} );

	wp.customize( 'vogue_clone_featured_title', function( value ) {
		value.bind( function( to ) {
			$( '.featured-posts .section-title' ).text( to );
		} );
	} );

	wp.customize( 'vogue_clone_latest_title', function( value ) {
		value.bind( function( to ) {
			$( '.latest-posts .section-title' ).text( to );
		} );
	} );

	wp.customize( 'vogue_clone_footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.site-info p' ).html( to );
		} );
	} );

	wp.customize( 'vogue_clone_sticky_header', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-header' ).css( 'position', 'sticky' );
			} else {
				$( '.site-header' ).css( 'position', 'relative' );
			}
		} );
	} );

} )( jQuery );