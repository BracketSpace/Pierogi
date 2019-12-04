/**
 * Internal dependencies
 */

import './skip-link-focus';
import SearchModal from './search-modal';
import MobileMenu from './mobile-menu';
import Submenu from './submenu';

const submenu = new Submenu();
const mobileMenu = new MobileMenu();
const searchModal = new SearchModal();

window.onresize = () => {
	mobileMenu.init();
	searchModal.hideModal();
	submenu.setScrollPosition();
};
