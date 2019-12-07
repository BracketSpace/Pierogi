const { domReady } = wp;
const { registerBlockStyle, unregisterBlockStyle } = wp.blocks;
const { __ } = wp.i18n;

domReady( () => {
	unregisterBlockStyle( 'core/button', 'squared' );
	unregisterBlockStyle( 'core/button', 'outline' );

	registerBlockStyle( 'core/button', {
		name: 'secondary',
		label: __( 'Secondary' ),
		isDefault: false,
	} );
} );
