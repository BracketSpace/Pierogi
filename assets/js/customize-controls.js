/* global Color */

wp.customize( 'accent_color', ( setting ) => {
	setting.bind( ( color ) => {
		const
			colorObj = new Color( color ),
			colors = wp.customize( 'colors' ).get();

		colors.accent = color;
		colors.light = calculateLightColor( colorObj );

		wp.customize( 'colors' ).set( colors );
		wp.customize( 'colors' )._dirty = true;
	} );
} );

wp.customize( 'secondary_color', ( setting ) => {
	setting.bind( ( color ) => {
		const	colors = wp.customize( 'colors' ).get();

		colors.secondary = color;

		wp.customize( 'colors' ).set( colors );
		wp.customize( 'colors' )._dirty = true;
	} );
} );

const calculateLightColor = ( color ) => {
	const
		l = color.l(),
		factor = 0.38,
		newL = ( ( 100 - l ) * factor ) + l;

	color.l( newL );

	return color.toCSS();
};
