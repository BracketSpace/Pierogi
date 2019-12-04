/**
 * Internal dependencies
 */

import './skip-link-focus';
import SearchModal from './search-modal';
import MobileMenu from './mobile-menu';

const mobileMenu = new MobileMenu();
const searchModal = new SearchModal();

window.onresize = () => {
	mobileMenu.init();
	searchModal.hideModal();
};
