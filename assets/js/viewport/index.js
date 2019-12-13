import { triggerEvent } from '../helpers';

export default class ViewportObserver {
	constructor() {
		this.element = document.querySelector( '.main-navigation-mobile' );

		if ( this.element ) {
			window.addEventListener( 'resize', this.detect.bind( this ) );

			this.detect();
		}
	}

	detect() {
		const isElementVisible = 'none' !== window.getComputedStyle( this.element ).display;

		if ( isElementVisible !== this.lastVisible ) {
			this.lastVisible = isElementVisible;

			const	viewport = isElementVisible ? 'mobile' : 'desktop';

			triggerEvent( 'viewportchange', { viewport } );
		}
	}
}
