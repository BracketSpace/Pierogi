import normalizeWheel from 'normalize-wheel';

export default class Submenu {
	intervalRight = null;
	intervalLeft = null;

	constructor() {
		this.navContainer = document.getElementById( 'site-navigation' );
		this.menuContainer = document.getElementById( 'primary-menu' );
		this.shadowRight = document.getElementById( 'menu-container-shadow-right' );
		this.shadowLeft = document.getElementById( 'menu-container-shadow-left' );
		this.mobileNavigation = document.getElementById( 'mobile-site-navigation' );

		if ( this.menuContainer ) {
			this.verticalScrollCapture();
			this.horizontalScrollCapture();
			this.init();
		}
	}

	init() {
		if ( this.menuContainer.scrollWidth > this.menuContainer.clientWidth ) {
			this.navContainer.classList.add( 'menu-scrollable' );
		}

		this.shadowRight.addEventListener( 'mouseover', this.shadowElementScrollLeft.bind( this ) );
		this.shadowRight.addEventListener( 'mouseleave', () => clearInterval( this.intervalRight ) );
		this.shadowLeft.addEventListener( 'mouseover', this.shadowElementScrollRight.bind( this ) );
		this.shadowLeft.addEventListener( 'mouseleave', () => clearInterval( this.intervalLeft ) );

		this.submenus = this.menuContainer.querySelectorAll( '.menu-item-has-children .sub-menu' );

		if ( this.submenus ) {
			this.setSubmenuPosition = this.setSubmenuPosition.bind( this );

			window.addEventListener( 'resize', this.setSubmenuPosition );
			this.menuContainer.addEventListener( 'scroll', this.setSubmenuPosition );

			this.setSubmenuPosition();
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
			parent = submenu.parentNode,
			parentStyle = window.getComputedStyle( parent ),
			parentWidth = parent.clientWidth - parseInt( parentStyle.paddingLeft ) - parseInt( parentStyle.paddingRight ),
			rightAligned = ( totalWidth > document.body.clientWidth );

		return {
			rightAligned,
			offset: rightAligned ? parentWidth - rect.width : 0,
		};
	}

	isMobile() {
		return this.mobileNavigation && ( 'none' !== window.getComputedStyle( this.mobileNavigation ).display );
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

				submenu.style.transform = `translateX(${ offset - this.menuContainer.scrollLeft }px)`;
			}
		}
	}

	verticalScrollCapture() {
		this.menuContainer.addEventListener( 'wheel', ( e ) => {
			const normalized = normalizeWheel( e );

			if ( normalized.spinY !== 0 ) {
				this.menuContainer.scrollLeft -= this.recalculateScroll( normalized.spinY );
				e.preventDefault();
			}
		} );
	}

	horizontalScrollCapture() {
		this.menuContainer.addEventListener( 'wheel', ( e ) => {
			const normalized = normalizeWheel( e );

			if ( normalized.spinX !== 0 ) {
				this.menuContainer.scrollLeft -= this.recalculateScroll( normalized.spinX );
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
		this.menuContainer.scrollLeft += 5;
	}

	shadowElementScrollRight() {
		this.intervalLeft = window.setInterval( this.animationIntervalRight.bind( this ), 24 );
	}

	animationIntervalRight() {
		this.menuContainer.scrollLeft -= 5;
	}
}
