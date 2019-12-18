import { triggerEvent } from '../helpers';

const { __ } = wp.i18n;

export default class menuContainer {
	activeItem;

	constructor() {
		this.menuContainer = document.getElementById( 'site-navigation-mobile' );
		this.menuToggle = document.getElementById( 'mobile-menu-button' );
		this.menu = document.getElementById( 'mobile-menu' );
		this.subMenuButtons = this.menuContainer.querySelectorAll( '.mobile-submenu-button' );

		this.createSearchForm();
		this.addMenuButtonsListeners();

		window.addEventListener( 'pierogi.viewportchange', this.watchBreakpointChange.bind( this ) );
		window.addEventListener( 'pierogi.searchformopen', this.searchFormOpen.bind( this ) );
		window.addEventListener( 'pierogi.searchformclose', this.searchFormClose.bind( this ) );
	}

	watchBreakpointChange( e ) {
		if ( 'desktop' === e.detail.viewport && this.menuToggle.classList.contains( 'active' ) ) {
			this.toggleMenu();
		}
	}

	isMobile() {
		return ( window.getComputedStyle( this.menuContainer ).display !== 'none' );
	}

	createSearchForm() {
		const
			searchButton = document.querySelector( 'button.search-button' ),
			searchFormID = searchButton.getAttribute( 'data-toggle-element' ),
			searchFormMobileID = `${ searchFormID }-mobile`,
			searchForm = document.getElementById( searchFormID ),
			searchFormMobile = searchForm.cloneNode( true ),
			searchLink = document.createElement( 'a' ),
			searchLinkWrap = document.createElement( 'li' ),
			itemWrap = document.createElement( 'div' );

		searchFormMobile.setAttribute( 'id', searchFormMobileID );

		itemWrap.setAttribute( 'class', 'item-wrap' );
		searchLinkWrap.setAttribute( 'class', 'menu-item search-link' );

		searchLink.innerText = __( 'Search', 'pierogi' );
		searchLink.setAttribute( 'href', '#' );
		searchLink.setAttribute( 'data-toggle-element', searchFormMobileID );

		itemWrap.appendChild( searchLink );
		searchLinkWrap.appendChild( itemWrap );
		searchLinkWrap.appendChild( searchFormMobile );

		this.searchLinkWrap = searchLinkWrap;

		this.menu.insertBefore( searchLinkWrap, this.menu.firstChild );
	}

	searchFormOpen( e ) {
		if ( this.isMobile() ) {
			this.resetSubmenus();
			this.toggleSearchFormActive();
			this.searchLinkWrap.style.marginBottom = `${ e.detail.height }px`;
		}
	}

	searchFormClose() {
		if ( this.menuContainer.classList.contains( 'searchform-active' ) ) {
			this.toggleSearchFormActive();
			this.searchLinkWrap.style.marginBottom = '';
		}
	}

	toggleSearchFormActive() {
		this.menuContainer.classList.toggle( 'searchform-active' );
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
		this.menuContainer.classList.toggle( 'active' );

		const
			isActive = this.menuToggle.classList.contains( 'active' ),
			eventType = isActive ? 'menuopen' : 'menuclose';

		triggerEvent( eventType );

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
