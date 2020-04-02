/**
 * External dependencies
 */
import 'custom-event-polyfill';
import 'focus-within-polyfill';

/**
 * Internal dependencies
 */
import './scrollbar-width';
import './menu';
import skipLinkFocus from './skip-link-focus';
import ViewportObserver from './viewport';
import ButtonColors from './button-colors';
import SearchForm from './search-form';
import VideoResize from './video-resize';
import '../images/searchform-close.svg';

skipLinkFocus();
new ViewportObserver;
new SearchForm;
new ButtonColors;
new VideoResize;
