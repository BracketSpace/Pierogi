/**
 * External dependencies
 */

const { __ } = wp.i18n;

export default class MobileMenu {
	constructor() {
		this.mediaQuery = window.matchMedia( '( max-width: 1025px )' );
		this.desktopMenu = document.getElementById( 'site-navigation' );
		this.btn = document.getElementById( 'mobile-menu-button' );
		this.menuCreated = false;

		this.mobileMenu = '';
		this.subMenuBtns = '';
		this.subMenuActive = '';

		this.init = this.init.bind( this );
		this.showMenu = this.showMenu.bind( this );

		if ( this.mediaQuery.matches ) {
			this.init();
		}
	}

	init() {
		if ( ! this.menuCreated ) {
			this.createMobileMenu();
		}

		this.setMenuHeight();
	}

	createMobileMenu() {
		const mobileMenu = this.desktopMenu.cloneNode( true );
		const header = document.getElementById( 'masthead' );

		mobileMenu.id = 'mobile-site-navigation';

		mobileMenu.classList.remove( 'main-navigation' );
		mobileMenu.classList.add( 'main-mobile-navigation' );
		mobileMenu.querySelector( 'ul' ).id = 'primary-mobile-menu';

		this.addSearchButton( mobileMenu.querySelector( 'ul' ) );

		header.appendChild( mobileMenu );

		this.mobileMenu = document.getElementById( 'mobile-site-navigation' );
		this.subMenuBtns = this.mobileMenu.querySelectorAll( '.menu-item-has-children .mobile-submenu-btn' );

		this.addMenuBtnsListeners();

		this.menuCreated = true;
	}

	addMenuBtnsListeners() {
		if ( this.btn ) {
			this.btn.addEventListener( 'click', ( e ) => {
				this.showMenu( e );
			} );
		}

		if ( this.subMenuBtns ) {
			[ ...this.subMenuBtns ].forEach( ( button ) => {
				button.addEventListener( 'click', ( e ) => {
					this.resetSubmenus( e );
					this.showSubMenu( e );
				} );
			} );
		}
	}

	setMenuHeight() {
		const menu = this.mobileMenu;
		const winH = window.innerHeight;
		menu.style.height = `${ winH }px`;
	}

	showMenu( e ) {
		e.currentTarget.classList.toggle( 'mobile-menu-active' );
		this.mobileMenu.classList.toggle( 'main-mobile-navigation-active' );

		document.querySelector( 'html' ).classList.toggle( 'menu-open' );
		document.querySelector( 'body' ).classList.toggle( 'menu-open' );
	}

	resetSubmenus( e ) {
		if ( e.currentTarget === this.subMenuActive ) {
			return;
		}

		if ( this.subMenuActive ) {
			const submenus = document.querySelectorAll( '.main-mobile-navigation .sub-menu' );
			const menuContainer = document.getElementById( 'primary-mobile-menu' );

			[ ...this.subMenuBtns ].forEach( ( btn ) => {
				btn.classList.remove( 'submenu-item-active' );
			} );

			menuContainer.classList.remove( 'mobile-submenu-open' );

			[ ...submenus ].forEach( ( submenu ) => {
				submenu.classList.remove( 'mobile-submenu-active' );
			} );

			this.subMenuActive = e.currentTarget;
		}
	}

	showSubMenu( e ) {
		e.preventDefault();

		this.subMenuActive = e.currentTarget;

		const submenuId = e.currentTarget.getAttribute( 'data-submenu' );
		const submenu = document.querySelector( `.main-mobile-navigation .${ submenuId }` );
		const menuContainer = document.getElementById( 'primary-mobile-menu' );

		e.currentTarget.classList.toggle( 'submenu-item-active' );
		menuContainer.classList.toggle( 'mobile-submenu-open' );
		submenu.classList.toggle( 'mobile-submenu-active' );
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
