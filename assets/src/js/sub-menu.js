export default class SubMenu {
	constructor() {
		this.menuParent = document.querySelector( '.main-navigation #primary-menu' );

		if ( ! this.menuParent ) {
			return;
		}
		this.findParentElems = this.findParentElems.bind( this );
		this.menuParentItems = this.findParentElems( this.menuParent );
		this.subMenuContainer = document.getElementById( 'header-submenu' );

		this.init = this.init.bind( this );
		this.showMenuBackground = this.showMenuBackground.bind( this );

		this.init();

		this.menuParentItems.forEach( ( item ) => {
			item.addEventListener( 'mouseover', ( e ) => {
				this.showMenuBackground( e );
			} );
		} );

		this.menuParentItems.forEach( ( item ) => {
			item.addEventListener( 'mouseleave', () => {
				this.hideMenuBackground();
			} );
		} );
	}

	init() {
		window.onload = () => {
			this.menuParentItems.forEach( ( item ) => {
				const subMenu = item.querySelector( '.sub-menu' );
				const subMenuH = subMenu.scrollHeight + 60;

				subMenu.setAttribute( 'data-menu-height', subMenuH );
				subMenu.style.visibility = 'hidden';
				subMenu.style.opacity = 0;
			} );
		};
	}

	findParentElems( elem ) {
		const parentElems = [ ...elem.children ].filter( ( element ) => {
			return element.matches( '.menu-item-has-children' );
		} );

		return parentElems;
	}

	showMenuBackground( event ) {
		const parent = event.currentTarget;
		const elemH = parent.querySelector( 'ul' ).getAttribute( 'data-menu-height' );

		this.subMenuContainer.style.height = `${ elemH }px`;
		this.subMenuContainer.style.opacity = 1;
		this.subMenuContainer.style.visibility = 'visible';
	}

	hideMenuBackground() {
		this.subMenuContainer.style.height = 0;
		this.subMenuContainer.style.opacity = 0;
		this.subMenuContainer.style.visibility = 'hidden';
	}
}
