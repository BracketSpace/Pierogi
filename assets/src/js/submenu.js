export default class Submenu {
	constructor() {
		this.menuContainer = document.getElementById( 'primary-menu' );
		this.shadow = document.getElementById( 'menu-container-shadow' );
		this.setScrollPosition = this.setScrollPosiotion.bind( this );
		this.breakpoint = window.matchMedia( '( min-width: 1025px )' );
		this.interval = '';

		this.verticalScrollCapture = this.verticalScrollCapture.bind( this );
		this.shadowElementScroll = this.shadowElementScroll.bind( this );

		this.verticalScrollCapture();

		this.menuContainer.addEventListener( 'scroll', () => {
			this.setScrollPosiotion();
		} );

		this.shadow.addEventListener( 'mouseover', () => {
			this.shadowElementScroll();
		} );

		this.shadow.addEventListener( 'mouseleave', () => {
			clearInterval( this.interval );
		} );
	}

	setScrollPosiotion() {
		if ( ! this.breakpoint.matches ) {
			return;
		}

		const submenuItems = this.menuContainer.querySelectorAll( `.menu-item-has-children .sub-menu` );

		[ ...submenuItems ].forEach( ( item ) => {
			item.style.transform = `translateX( -${ this.menuContainer.scrollLeft }px )`;
		} );
	}

	verticalScrollCapture() {
		this.menuContainer.addEventListener( 'mousewheel', ( e ) => {
			if ( e.deltaY !== 0 ) {
				this.menuContainer.scrollLeft -= e.deltaY;
				e.preventDefault();
			}
		} );
	}

	shadowElementScroll() {
		this.interval = window.setInterval( this.animationInterval.bind( this ), 25 );
	}

	animationInterval() {
		this.menuContainer.scrollLeft += 1;
	}
}
