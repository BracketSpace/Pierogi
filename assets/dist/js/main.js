/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "../";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./assets/src/js/main.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/js/main.js":
/*!*******************************!*\
  !*** ./assets/src/js/main.js ***!
  \*******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _skip_link_focus__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./skip-link-focus */ \"./assets/src/js/skip-link-focus.js\");\n/* harmony import */ var _skip_link_focus__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_skip_link_focus__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _search_modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./search-modal */ \"./assets/src/js/search-modal.js\");\n/* harmony import */ var _mobile_menu__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./mobile-menu */ \"./assets/src/js/mobile-menu.js\");\n/**\n * Internal dependencies\n */\n\n\n\nvar mobileMenu = new _mobile_menu__WEBPACK_IMPORTED_MODULE_2__[\"default\"]();\nvar searchModal = new _search_modal__WEBPACK_IMPORTED_MODULE_1__[\"default\"]();\n\nwindow.onresize = function () {\n  mobileMenu.init();\n  searchModal.hideModal();\n};\n\n//# sourceURL=webpack:///./assets/src/js/main.js?");

/***/ }),

/***/ "./assets/src/js/mobile-menu.js":
/*!**************************************!*\
  !*** ./assets/src/js/mobile-menu.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return MobileMenu; });\nfunction _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }\n\nfunction _nonIterableSpread() { throw new TypeError(\"Invalid attempt to spread non-iterable instance\"); }\n\nfunction _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === \"[object Arguments]\") return Array.from(iter); }\n\nfunction _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\n/**\n * External dependencies\n */\nvar __ = wp.i18n.__;\n\nvar MobileMenu =\n/*#__PURE__*/\nfunction () {\n  function MobileMenu() {\n    _classCallCheck(this, MobileMenu);\n\n    this.mediaQuery = window.matchMedia('( max-width: 1025px )');\n    this.desktopMenu = document.getElementById('site-navigation');\n    this.btn = document.getElementById('mobile-menu-button');\n    this.menuCreated = false;\n    this.mobileMenu = '';\n    this.subMenuBtns = '';\n    this.subMenuActive = '';\n    this.init = this.init.bind(this);\n    this.showMenu = this.showMenu.bind(this);\n\n    if (this.mediaQuery.matches) {\n      this.init();\n    }\n  }\n\n  _createClass(MobileMenu, [{\n    key: \"init\",\n    value: function init() {\n      if (!this.menuCreated) {\n        this.createMobileMenu();\n      }\n\n      this.setMenuHeight();\n    }\n  }, {\n    key: \"createMobileMenu\",\n    value: function createMobileMenu() {\n      var mobileMenu = this.desktopMenu.cloneNode(true);\n      var header = document.getElementById('masthead');\n      mobileMenu.id = 'mobile-site-navigation';\n      mobileMenu.classList.remove('main-navigation');\n      mobileMenu.classList.add('main-mobile-navigation');\n      mobileMenu.querySelector('ul').id = 'primary-mobile-menu';\n      this.addSearchButton(mobileMenu.querySelector('ul'));\n      header.appendChild(mobileMenu);\n      this.mobileMenu = document.getElementById('mobile-site-navigation');\n      this.subMenuBtns = this.mobileMenu.querySelectorAll('.menu-item-has-children .mobile-submenu-btn');\n      this.addMenuBtnsListeners();\n      this.menuCreated = true;\n    }\n  }, {\n    key: \"addMenuBtnsListeners\",\n    value: function addMenuBtnsListeners() {\n      var _this = this;\n\n      if (this.btn) {\n        this.btn.addEventListener('click', function (e) {\n          _this.showMenu(e);\n        });\n      }\n\n      if (this.subMenuBtns) {\n        _toConsumableArray(this.subMenuBtns).forEach(function (button) {\n          button.addEventListener('click', function (e) {\n            _this.resetSubmenus(e);\n\n            _this.showSubMenu(e);\n          });\n        });\n      }\n    }\n  }, {\n    key: \"setMenuHeight\",\n    value: function setMenuHeight() {\n      var menu = this.mobileMenu;\n      var winH = window.innerHeight;\n      menu.style.height = \"\".concat(winH, \"px\");\n    }\n  }, {\n    key: \"showMenu\",\n    value: function showMenu(e) {\n      e.currentTarget.classList.toggle('mobile-menu-active');\n      this.mobileMenu.classList.toggle('main-mobile-navigation-active');\n      document.querySelector('html').classList.toggle('menu-open');\n      document.querySelector('body').classList.toggle('menu-open');\n    }\n  }, {\n    key: \"resetSubmenus\",\n    value: function resetSubmenus(e) {\n      if (e.currentTarget === this.subMenuActive) {\n        return;\n      }\n\n      if (this.subMenuActive) {\n        var submenus = document.querySelectorAll('.main-mobile-navigation .sub-menu');\n        var menuContainer = document.getElementById('primary-mobile-menu');\n\n        _toConsumableArray(this.subMenuBtns).forEach(function (btn) {\n          btn.classList.remove('submenu-item-active');\n        });\n\n        menuContainer.classList.remove('mobile-submenu-open');\n\n        _toConsumableArray(submenus).forEach(function (submenu) {\n          submenu.classList.remove('mobile-submenu-active');\n        });\n\n        this.subMenuActive = e.currentTarget;\n      }\n    }\n  }, {\n    key: \"showSubMenu\",\n    value: function showSubMenu(e) {\n      e.preventDefault();\n      this.subMenuActive = e.currentTarget;\n      var submenuId = e.currentTarget.getAttribute('data-submenu');\n      var submenu = document.querySelector(\".main-mobile-navigation .\".concat(submenuId));\n      var menuContainer = document.getElementById('primary-mobile-menu');\n      e.currentTarget.classList.toggle('submenu-item-active');\n      menuContainer.classList.toggle('mobile-submenu-open');\n      submenu.classList.toggle('mobile-submenu-active');\n    }\n  }, {\n    key: \"addSearchButton\",\n    value: function addSearchButton(menu) {\n      var searchBtn = document.createElement('li');\n      var link = document.createElement('a');\n      link.innerText = __('Search', 'pierogi');\n      searchBtn.setAttribute('id', 'mobile-search-button');\n      searchBtn.setAttribute('data-toggle-element', 'header-search');\n      searchBtn.classList.add('toggle-header-modal');\n      searchBtn.appendChild(link);\n      searchBtn.classList.add('menu-item');\n      menu.insertBefore(searchBtn, menu.firstChild);\n    }\n  }]);\n\n  return MobileMenu;\n}();\n\n\n\n//# sourceURL=webpack:///./assets/src/js/mobile-menu.js?");

/***/ }),

/***/ "./assets/src/js/search-modal.js":
/*!***************************************!*\
  !*** ./assets/src/js/search-modal.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"default\", function() { return SearchModal; });\nfunction _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }\n\nfunction _nonIterableSpread() { throw new TypeError(\"Invalid attempt to spread non-iterable instance\"); }\n\nfunction _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === \"[object Arguments]\") return Array.from(iter); }\n\nfunction _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }\n\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\n\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }\n\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }\n\nvar SearchModal =\n/*#__PURE__*/\nfunction () {\n  function SearchModal() {\n    _classCallCheck(this, SearchModal);\n\n    this.modalBtns = document.querySelectorAll('.toggle-header-modal');\n\n    if (!this.modalBtns.length) {\n      return;\n    }\n\n    this.mediaQuery = window.matchMedia('( max-width: 1025px )');\n    this.activeModal = '';\n    this.init = this.initModals.bind(this);\n    this.init(this.modalBtns);\n  }\n\n  _createClass(SearchModal, [{\n    key: \"initModals\",\n    value: function initModals(elements) {\n      var _this = this;\n\n      _toConsumableArray(elements).forEach(function (element) {\n        element.addEventListener('click', function (e) {\n          e.preventDefault();\n\n          if (!_this.activeModal) {\n            _this.openModal(e.currentTarget);\n          } else {\n            _this.activeModal.style.maxHeight = 0;\n            _this.activeModal = '';\n          }\n        });\n      });\n    }\n  }, {\n    key: \"openModal\",\n    value: function openModal(element) {\n      var modalData = element.getAttribute('data-toggle-element');\n      var modal = document.getElementById(modalData);\n      var modalH = this.mediaQuery.matches ? window.innerHeight : modal.scrollHeight + 200;\n      this.animationHandler(modal, modalH);\n    }\n  }, {\n    key: \"animationHandler\",\n    value: function animationHandler(elem, elemH) {\n      elem.style.maxHeight = \"\".concat(elemH, \"px\");\n      elem.style.height = \"\".concat(elemH, \"px\");\n\n      if (this.mediaQuery.matches) {\n        elem.classList.add('header-search-mobile-active');\n      }\n\n      this.activeModal = elem;\n      this.handleClose();\n    }\n  }, {\n    key: \"handleClose\",\n    value: function handleClose() {\n      var _this2 = this;\n\n      var closeBtn = this.activeModal.querySelector('.search-close');\n      closeBtn.addEventListener('click', function (e) {\n        e.preventDefault();\n\n        _this2.hideModal();\n      });\n    }\n  }, {\n    key: \"hideModal\",\n    value: function hideModal() {\n      if (!this.activeModal) {\n        return;\n      }\n\n      if (this.mediaQuery.matches) {\n        this.activeModal.classList.remove('header-search-mobile-active');\n      }\n\n      this.activeModal.style.maxHeight = 0;\n      this.activeModal.style.height = 0;\n      this.activeModal = '';\n    }\n  }]);\n\n  return SearchModal;\n}();\n\n\n\n//# sourceURL=webpack:///./assets/src/js/search-modal.js?");

/***/ }),

/***/ "./assets/src/js/skip-link-focus.js":
/*!******************************************!*\
  !*** ./assets/src/js/skip-link-focus.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/**\n * File skip-link-focus-fix.js.\n *\n * Helps with accessibility for keyboard only users.\n *\n * Learn more: https://git.io/vWdr2\n */\nvar skipLink = function skipLink() {\n  // eslint-disable-next-line no-undef\n  var isIe = /(trident|msie)/i.test(navigator.userAgent);\n\n  if (isIe && document.getElementById && window.addEventListener) {\n    window.addEventListener('hashchange', function () {\n      // eslint-disable-next-line no-undef\n      var id = location.hash.substring(1);\n\n      if (!/^[A-z0-9_-]+$/.test(id)) {\n        return;\n      }\n\n      var element = document.getElementById(id);\n\n      if (element) {\n        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {\n          element.tabIndex = -1;\n        }\n\n        element.focus();\n      }\n    }, false);\n  }\n};\n\nskipLink();\n\n//# sourceURL=webpack:///./assets/src/js/skip-link-focus.js?");

/***/ })

/******/ });