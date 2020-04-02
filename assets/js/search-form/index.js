import { triggerEvent } from '../helpers';

export default class SearchForm {
	constructor() {
		this.modalBtns = document.querySelectorAll( '[data-toggle-element]' );

		if ( this.modalBtns.length ) {
			this.init();
		}
	}

	init() {
		this.toggleModal = this.toggleModal.bind( this );
		this.hideModal = this.hideModal.bind( this );

		for ( const element of this.modalBtns ) {
			element.addEventListener( 'click', this.toggleModal );
		}

		document.addEventListener( 'click', ( e ) => {
			if ( e.target.matches( 'button.search-close' ) || e.target.matches( 'button.search-close *' ) ) {
				this.hideModal();
			}
		} );

		window.addEventListener( 'pierogi.viewportchange', this.hideModal );
		window.addEventListener( 'pierogi.menuclose', this.hideModal );
		window.addEventListener( 'resize', this.resizeModal.bind( this ) );
	}

	toggleModal( e ) {
		e.preventDefault();

		if ( ! this.activeModal ) {
			this.openModal( e.currentTarget );
		} else {
			this.hideModal();
		}
	}

	calculateModalHeight() {
		let height = 0;

		for ( const child of this.activeModal.children ) {
			height += child.clientHeight;
		}

		return height;
	}

	openModal( element ) {
		const modalID = element.getAttribute( 'data-toggle-element' );

		this.activeModal = document.getElementById( modalID );
		this.inactiveItems = this.activeModal.querySelectorAll( '[tabindex="-1"]' );

		for ( const item of this.inactiveItems ) {
			item.removeAttribute( 'tabindex' );
		}

		const height = this.calculateModalHeight();

		this.activeModal.style.maxHeight = `${ height }px`;

		triggerEvent( 'searchformopen', { height } );
	}

	hideModal() {
		if ( this.activeModal ) {
			this.activeModal.style.maxHeight = 0;
			this.activeModal.inert = true;
			this.activeModal = false;

			for ( const item of this.inactiveItems ) {
				item.setAttribute( 'tabindex', '-1' );
			}

			this.inactiveItems = false;

			triggerEvent( 'searchformclose' );
		}
	}

	resizeModal() {
		if ( this.activeModal ) {
			const height = this.calculateModalHeight();

			this.activeModal.style.maxHeight = `${ height }px`;
		}
	}
}
