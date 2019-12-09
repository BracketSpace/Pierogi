export default class ButtonColors {
	selector = '.wp-block-button__link';

	constructor() {
		document.addEventListener( 'mouseover', ( e ) => {
			if ( e.target.matches( this.selector ) ) {
				this.handleMouseOver( e.target );
			}
		} );

		document.addEventListener( 'mouseout', ( e ) => {
			if ( e.target.matches( this.selector ) ) {
				this.handleMouseOut( e.target );
			}
		} );
	}

	handleMouseOver( button ) {
		if ( button.style.color === null && button.style.backgroundColor === null ) {
			return;
		}

		const { color, backgroundColor } = button.style;

		button.style.borderColor = backgroundColor;
		button.style.color = backgroundColor;

		button.setAttribute( 'data-color', color );
	}

	handleMouseOut( button ) {
		const color = button.getAttribute( 'data-color' );
		button.style.color = color;
	}
}
