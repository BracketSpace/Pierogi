/**
 * External dependencies
 */
const { __ } = wp.i18n;

export default class MobileMenu {
	constructor() {
		this.menuContainer = document.getElementById( 'site-navigation-mobile' );
		this.menuToggle = document.getElementById( 'mobile-menu-button' );
		this.mobileMenu = document.getElementById( 'site-navigation-mobile' );
		this.subMenuButtons = this.mobileMenu.querySelectorAll( '.mobile-submenu-button' );

		this.activeItem = '';

		this.addMenuButtonsListeners();

		this.isMenuToggleVisible = window.getComputedStyle( this.menuToggle ).display;

		window.addEventListener( 'resize', this.watchBreakpointChange.bind( this ) );
	}

	watchBreakpointChange() {
		const currentVisibility = window.getComputedStyle( this.menuToggle ).display;

		if ( this.isMenuToggleVisible !== currentVisibility ) {
			this.isMenuToggleVisible = currentVisibility;

			if ( 'none' === currentVisibility && this.mobileMenu.classList.contains( 'active' ) ) {
				// Hide menu if switched to desktop.
				this.toggleMenu();
			}
		}
	}

	addMenuButtonsListeners() {
		if ( this.menuToggle ) {
			this.menuToggle.addEventListener( 'click', this.toggleMenu.bind( this ) );
		}

		if ( this.subMenuButtons ) {
			for ( const button of this.subMenuButtons ) {
				button.addEventListener( 'click', this.handleClick.bind( this ) );
			}
		}
	}

	handleClick( e ) {
		e.preventDefault();

		const item = e.currentTarget.parentNode.parentNode;

		if ( item !== this.activeItem ) {
			this.resetSubmenus();
		}

		this.toggleSubMenu( item );
	}

	toggleMenu() {
		this.menuToggle.classList.toggle( 'active' );
		this.mobileMenu.classList.toggle( 'active' );

		document.querySelector( 'html' ).classList.toggle( 'menu-open' );
		document.querySelector( 'body' ).classList.toggle( 'menu-open' );
		this.resetSubmenus();
	}

	resetSubmenus() {
		if ( this.activeItem ) {
			for ( const button of this.subMenuButtons ) {
				button.parentNode.parentNode.classList.remove( 'active' );
			}

			this.menuContainer.classList.remove( 'submenu-open' );
			this.activeItem = null;
		}
	}

	toggleSubMenu( item ) {
		this.activeItem = item;
		item.classList.toggle( 'active' );
		this.menuContainer.classList.toggle( 'submenu-open' );
	}

	addSearchButton( menu ) {
		const searchBtn = document.createElement( 'li' );
		const link = document.createElement( 'a' );

		link.innerText = __( 'Search', 'pierogi' );
		searchBtn.setAttribute( 'id', 'mobile-search-button' );
		searchBtn.setAttribute( 'data-toggle-element', 'header-search' );
		searchBtn.classList.add( 'toggle-header-modal' );
		searchBtn.appendChild( link );
		searchBtn.classList.add( 'menu-item' );

		menu.insertBefore( searchBtn, menu.firstChild );
	}
}
