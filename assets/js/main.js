/**
 * Internal dependencies
 */
import './scrollbar-width';
import './menu';
import skipLinkFocus from './skip-link-focus';
import ViewportObserver from './viewport';
import ButtonColors from './button-colors';
import SearchForm from './search-form';
import '../images/searchform-close.svg';

skipLinkFocus();
new ViewportObserver;
new SearchForm;
new ButtonColors;
