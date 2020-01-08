export default class {
	constructor() {
		this.blocks = document.querySelectorAll( '.wp-block-embed.is-type-video' );

		if ( ! this.blocks ) {
			return;
		}

		this.fix = this.fix.bind( this );

		for ( const block of this.blocks ) {
			this.fix( block );
		}
	}

	fix( block ) {
		const
			iframe = block.querySelector( 'iframe' ),
			wrapper = block.querySelector( '.wp-block-embed__wrapper' ),
			ratio = iframe.clientHeight / iframe.clientWidth * 100;

		wrapper.classList.add( 'pierogi-video-wrap' );
		wrapper.style.paddingTop = `${ ratio }%`;
	}
}
