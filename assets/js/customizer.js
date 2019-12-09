/**
 * Footer text live preview
 */
wp.customize( 'pierogi_footer_copyright', ( value ) => {
	value.bind( ( newValue ) => {
		const item = document.querySelector( 'footer.site-footer .site-info-content p' );

		item.innerHTML = newValue;
	} );
} );
