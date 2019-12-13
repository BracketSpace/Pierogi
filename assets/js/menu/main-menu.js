import normalizeWheel from 'normalize-wheel';
import { innerWidth } from '../helpers';

export default class MainMenu {
	intervalRight = null;
	intervalLeft = null;

	constructor() {
		this.container = document.querySelector( 'header.site-header .container' );
		this.branding = this.container.querySelector( '.site-branding' );
		this.navContainer = this.container.querySelector( '.navigation-container' );
		this.nav = document.getElementById( 'site-navigation' );
		this.menu = document.getElementById( 'primary-menu' );
		this.shadowRight = document.getElementById( 'menu-container-shadow-right' );
		this.shadowLeft = document.getElementById( 'menu-container-shadow-left' );
		this.mobileNav = document.getElementById( 'mobile-site-navigation' );

		if ( this.menu ) {
			this.verticalScrollCapture();
			this.horizontalScrollCapture();
			this.init();
		}
	}

	init() {
		this.calculateMenuSize = this.calculateMenuSize.bind( this );

		window.addEventListener( 'resize', this.calculateMenuSize );
		window.addEventListener( 'load', this.calculateMenuSize );

		this.shadowRight.addEventListener( 'mouseover', this.shadowElementScrollLeft.bind( this ) );
		this.shadowRight.addEventListener( 'mouseleave', () => clearInterval( this.intervalRight ) );
		this.shadowLeft.addEventListener( 'mouseover', this.shadowElementScrollRight.bind( this ) );
		this.shadowLeft.addEventListener( 'mouseleave', () => clearInterval( this.intervalLeft ) );

		this.submenus = this.menu.querySelectorAll( '.menu-item-has-children .sub-menu' );

		if ( this.submenus ) {
			this.setSubmenuPosition = this.setSubmenuPosition.bind( this );

			window.addEventListener( 'resize', this.setSubmenuPosition );
			this.menu.addEventListener( 'scroll', this.setSubmenuPosition );

			this.setSubmenuPosition();
		}
	}

	calculateMenuSize() {
		const
			containerWidth = innerWidth( this.container ),
			brandingMargin = parseInt( window.getComputedStyle( this.branding ).marginRight ),
			brandingWidth = this.branding.clientWidth + brandingMargin,
			maxMenuWidth = containerWidth - brandingWidth;

		this.navContainer.style.maxWidth = `${ maxMenuWidth }px`;

		if ( this.menu.scrollWidth > this.menu.clientWidth ) {
			this.nav.classList.add( 'scrollable' );
		} else if ( this.nav.classList.contains( 'scrollable' ) ) {
			this.nav.classList.remove( 'scrollable' );
		}
	}

	calculateSubmenuPosition( submenu ) {
		if ( submenu.classList.contains( 'alignright' ) ) {
			// Clear alignment for proper mesurement.
			submenu.classList.remove( 'alignright' );
		}

		submenu.style.transform = null;

		const
			rect = submenu.getBoundingClientRect(),
			totalWidth = Math.round( rect.left + rect.width ),
			link = submenu.parentNode.querySelector( 'a' ),
			linkStyle = window.getComputedStyle( link ),
			linkWidth = link.clientWidth - parseInt( linkStyle.paddingRight ),
			rightAligned = ( totalWidth > document.body.clientWidth );

		return {
			rightAligned,
			offset: rightAligned ? linkWidth - rect.width : parseInt( linkStyle.paddingLeft ),
		};
	}

	isMobile() {
		return this.mobileNav && ( 'none' !== window.getComputedStyle( this.mobileNav ).display );
	}

	setSubmenuPosition() {
		for ( const submenu of this.submenus ) {
			if ( this.isMobile() ) {
				submenu.style.transform = '';
			} else {
				const { rightAligned, offset } = this.calculateSubmenuPosition( submenu );

				if ( rightAligned ) {
					submenu.classList.add( 'alignright' );
				}

				submenu.style.transform = `translateX(${ offset - this.menu.scrollLeft }px)`;
			}
		}
	}

	verticalScrollCapture() {
		this.menu.addEventListener( 'wheel', ( e ) => {
			const normalized = normalizeWheel( e );

			if ( normalized.spinY !== 0 ) {
				this.menu.scrollLeft += this.recalculateScroll( normalized.spinY );
				e.preventDefault();
			}
		} );
	}

	horizontalScrollCapture() {
		this.menu.addEventListener( 'wheel', ( e ) => {
			const normalized = normalizeWheel( e );

			if ( normalized.spinX !== 0 ) {
				this.menu.scrollLeft += this.recalculateScroll( normalized.spinX );
				e.preventDefault();
			}
		} );
	}

	recalculateScroll( num ) {
		return num * 50;
	}

	shadowElementScrollLeft() {
		this.intervalRight = window.setInterval( this.animationIntervalLeft.bind( this ), 24 );
	}

	animationIntervalLeft() {
		this.menu.scrollLeft += 5;
	}

	shadowElementScrollRight() {
		this.intervalLeft = window.setInterval( this.animationIntervalRight.bind( this ), 24 );
	}

	animationIntervalRight() {
		this.menu.scrollLeft -= 5;
	}
}
