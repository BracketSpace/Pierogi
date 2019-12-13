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
	}

	toggleModal( e ) {
		e.preventDefault();

		if ( ! this.activeModal ) {
			this.openModal( e.currentTarget );
		} else {
			this.hideModal();
		}
	}

	openModal( element ) {
		const	modalID = element.getAttribute( 'data-toggle-element' );

		this.activeModal = document.getElementById( modalID );

		let height = 0;

		for ( const child of this.activeModal.children ) {
			height += child.clientHeight;
		}

		this.activeModal.style.maxHeight = `${ height }px`;

		triggerEvent( 'searchformopen', { height } );
	}

	hideModal() {
		if ( this.activeModal ) {
			this.activeModal.style.maxHeight = 0;
			this.activeModal = false;

			triggerEvent( 'searchformclose' );
		}
	}
}
