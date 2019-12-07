const customColorBtn = document.querySelectorAll( '.wp-block-button a' );

if ( customColorBtn ) {
	const setBtnColor = ( e ) => {
		const element = e.target;
		const backgroundColor = e.target.style.backgroundColor;
		const fontColor = e.target.style.color;

		element.style.borderColor = backgroundColor;
		element.style.color = backgroundColor;

		const colors = {
			backgroundColor,
			fontColor,
		};

		return colors;
	};

	const removeBtnColor = ( e, colors ) => {
		const element = e.target;

		element.style.borderColor = colors.backgroundColor;
		element.style.color = colors.fontColor;
		element.backgroundColor = colors.backgroundColor;
	};

	[ ...customColorBtn ].forEach( ( btn ) => {
		let colors;

		if ( btn.style.color === null && btn.style.backgroundColor === null ) {
			return;
		}

		btn.addEventListener( 'mouseover', ( e ) => {
			colors = setBtnColor( e );
		} );

		btn.addEventListener( 'mouseleave', ( e ) => {
			removeBtnColor( e, colors );
		} );
	} );
}
