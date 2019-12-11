import normalizeWheel from 'normalize-wheel';

export default class Submenu {
	intervalRight = null;
	intervalLeft = null;

	constructor() {
		this.navContainer = document.getElementById( 'site-navigation' );
		this.menuContainer = document.getElementById( 'primary-menu' );
		this.shadowRight = document.getElementById( 'menu-container-shadow-right' );
		this.shadowLeft = document.getElementById( 'menu-container-shadow-left' );
		this.breakpoint = window.matchMedia( '( min-width: 1025px )' );

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

		this.setScrollPosition = this.setScrollPosition.bind( this );

		window.addEventListener( 'resize', this.setScrollPosition );
		this.menuContainer.addEventListener( 'scroll', this.setScrollPosition );
		this.shadowRight.addEventListener( 'mouseover', this.shadowElementScrollLeft.bind( this ) );
		this.shadowRight.addEventListener( 'mouseleave', () => clearInterval( this.intervalRight ) );
		this.shadowLeft.addEventListener( 'mouseover', this.shadowElementScrollRight.bind( this ) );
		this.shadowLeft.addEventListener( 'mouseleave', () => clearInterval( this.intervalLeft ) );
	}

	setScrollPosition() {
		const submenuItems = this.menuContainer.querySelectorAll( `.menu-item-has-children .sub-menu` );

		if ( ! submenuItems ) {
			return;
		}

		if ( this.breakpoint.matches ) {
			for ( const item of submenuItems ) {
				item.style.transform = `translateX( -${ this.menuContainer.scrollLeft }px )`;
			}
		} else {
			for ( const item of submenuItems ) {
				item.style.transform = `translateX( 0 )`;
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
