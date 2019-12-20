const { getComputedStyle } = window;

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
		const style = getComputedStyle( button );

		if ( button.classList.contains( 'has-text-color' ) ) {
			button.setAttribute( 'data-color', style.color );
		}

		button.style.color = style.backgroundColor;
	}

	handleMouseOut( button ) {
		const color = button.getAttribute( 'data-color' );
		button.style.color = color;
	}
}
