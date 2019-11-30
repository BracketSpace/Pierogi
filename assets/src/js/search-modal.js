export default class SearchModal {
	constructor() {
		this.modalBtns = document.querySelectorAll( '.toggle-header-modal' );

		if ( ! this.modalBtns.length ) {
			return;
		}

		this.mediaQuery = window.matchMedia( '( max-width: 1025px )' );
		this.activeModal = '';
		this.init = this.initModals.bind( this );

		this.init( this.modalBtns );
	}

	initModals( elements ) {
		[ ...elements ].forEach( ( element ) => {
			element.addEventListener( 'click', ( e ) => {
				e.preventDefault();

				if ( ! this.activeModal ) {
					this.openModal( e.currentTarget );
				} else {
					this.activeModal.style.maxHeight = 0;
					this.activeModal = '';
				}
			} );
		} );
	}

	openModal( element ) {
		const modalData = element.getAttribute( 'data-toggle-element' );
		const modal = document.getElementById( modalData );
		const modalH = ( this.mediaQuery.matches ) ? window.innerHeight : modal.scrollHeight + 200;

		this.animationHandler( modal, modalH );
	}

	animationHandler( elem, elemH ) {
		elem.style.maxHeight = `${ elemH }px`;
		elem.style.height = `${ elemH }px`;

		if ( this.mediaQuery.matches ) {
			elem.classList.add( 'header-search-mobile-active' );
		}

		this.activeModal = elem;
		this.handleClose();
	}

	handleClose() {
		const closeBtn = this.activeModal.querySelector( '.search-close' );

		closeBtn.addEventListener( 'click', ( e ) => {
			e.preventDefault();

			this.hideModal();
		} );
	}

	hideModal() {
		if ( ! this.activeModal ) {
			return;
		}

		if ( this.mediaQuery.matches ) {
			this.activeModal.classList.remove( 'header-search-mobile-active' );
		}

		this.activeModal.style.maxHeight = 0;
		this.activeModal.style.height = 0;
		this.activeModal = '';
	}
}

