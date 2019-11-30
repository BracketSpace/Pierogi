/**
 * Internal dependencies
 */

import './skip-link-focus';
import SearchModal from './search-modal';
import SubMenu from './sub-menu';
import MobileMenu from './mobile-menu';

const mobileMenu = new MobileMenu();
const subMenu = new SubMenu();
const searchModal = new SearchModal();

window.onresize = () => {
	mobileMenu.init();
	subMenu.setSubMenuHeight();
	searchModal.hideModal();
};
