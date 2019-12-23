/**
 * WordPress Dependencies
 */
import domReady from '@wordpress/dom-ready';
import { unregisterBlockStyle } from '@wordpress/blocks';
/**
 * Internal Dependencies
 */
import ButtonColors from './button-colors';

domReady( () => {
	unregisterBlockStyle( 'core/button', 'squared' );
	unregisterBlockStyle( 'core/button', 'outline' );
	unregisterBlockStyle( 'core/button', 'fill' );
	unregisterBlockStyle( 'core/quote', 'default' );
	unregisterBlockStyle( 'core/quote', 'large' );

	new ButtonColors;
} );
