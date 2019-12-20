/* global Pierogi */

wp.customize( 'accent_color', ( setting ) => {
	setting.bind( refresh );
} );

wp.customize( 'secondary_color', ( setting ) => {
	setting.bind( refresh );
} );

const refresh = () => {
	const
		colors = window.parent.wp.customize( 'colors' ).get(),
		styleSheet = getStyleSheet();

	for ( const color in Pierogi.colors ) {
		if ( colors[ color ] ) {
			applyStyles( styleSheet, Pierogi.colors[ color ], colors[ color ] );
		}
	}
};

const applyStyles = ( styleSheet, selectors, color ) => {
	for ( const attr in selectors ) {
		const rule = `${ selectors[ attr ].join( ', ' ) } { ${ attr }: ${ color } }`;

		styleSheet.insertRule( rule );
	}
};

const getStyleSheet = () => {
	let style = document.getElementById( 'pierogi-style-inline-css' );

	if ( style ) {
		style.parentNode.removeChild( style );
	}

	// Create new style element.
	style = document.createElement( 'style' );
	style.setAttribute( 'id', 'pierogi-style-inline-css' );
	style.appendChild( document.createTextNode( '' ) );

	document.head.appendChild( style );

	return style.sheet;
};
