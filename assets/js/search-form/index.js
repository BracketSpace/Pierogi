export default class SearchForm {
	constructor() {
		this.modalBtns = document.querySelectorAll( '[data-toggle-element]' );

		if ( this.modalBtns.length ) {
			this.init();
		}
	}

	init() {
		this.toggleModal = this.toggleModal.bind( this );

		this.mediaQuery = window.matchMedia( '( max-width: 1025px )' );

		window.addEventListener( 'resize', this.handleResize.bind( this ) );

		for ( const element of this.modalBtns ) {
			element.addEventListener( 'click', this.toggleModal );
		}
	}

	handleResize() {
		if ( this.activeModal ) {
			this.hideModal();
		}
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

		const
			height = ( this.mediaQuery.matches ) ? window.innerHeight : this.activeModal.scrollHeight + 200,
			closeBtn = this.activeModal.querySelector( '.search-close' );

		this.activeModal.style.maxHeight = `${ height }px`;
		this.activeModal.style.height = `${ height }px`;

		if ( this.mediaQuery.matches ) {
			this.activeModal.classList.add( 'header-search-mobile-active' );
		}

		closeBtn.addEventListener( 'click', this.toggleModal );
	}

	hideModal() {
		if ( this.mediaQuery.matches ) {
			this.activeModal.classList.remove( 'header-search-mobile-active' );
		}

		this.activeModal.style.maxHeight = 0;
		this.activeModal.style.height = 0;
		this.activeModal = false;
	}
}
