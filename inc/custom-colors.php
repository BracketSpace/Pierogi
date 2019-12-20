<?php
/**
 * Pierogi Theme Customizer Styles
 *
 * @package Pierogi
 */

/**
 * Returns accent color selectors
 *
 * @return array
 */
function pierogi_get_accent_selectors() {
	return [
		'color' => [
			'a',
			'body.blog .entry-title a:hover',
			'body.archive .entry-title a:hover',
			'body.search .entry-title a:hover',
			'body.blog .excerpt:hover p',
			'body.archive .excerpt:hover p',
			'body.search .excerpt:hover p',
			'body.blog .read-more:hover',
			'body.archive .read-more:hover',
			'body.search .read-more:hover',
			'.wp-block-cover a:hover',
			'.entry-meta a:hover',
			'.screen-reader-text:focus',
			'.main-navigation .main-menu-wrap li:hover > a',
			'.author-box .h6',
			'.site-header .site-branding p',
			'.post-navigation a:hover',
			'body.blog a:hover',
			'body.archive a:hover',
			'body.search a:hover',
			'.widget_calendar td a:hover',
			'.widget_calendar th a:hover',
		],
		'background-color' => [
			'body.blog .read-more:hover::after',
			'body.archive .read-more:hover::after',
			'body.search .read-more:hover::after',
			'.main-navigation .main-menu-wrap li a::after',
			'.main-navigation .main-menu-wrap li span::after',
			'.comment-navigation .nav-links a::after',
			'body.blog .read-more:hover::after',
			'body.archive .read-more:hover::after',
			'body.search .read-more:hover::after',
			'.comments-area .reply .comment-reply-link:hover::after',
		],
		'stroke' => [
			'.site-header .navigation-container .search-button:hover g',
			'.site-header .navigation-container .search-button:hover line',
		],
		'border-color' => [
			'.screen-reader-text:focus',
			'.widget_categories a:hover',
			'.widget_tag_cloud a:hover',
			'.widget_archive a:hover',
			'.widget_nav_menu a:hover',
		],
	];
}

/**
 * Returns custom color selectors
 *
 * @return array
 */
function pierogi_get_accent_light_selectors() {
	return [
		'background-color' => [
			'.site-footer .footer-navigation',
			'.navigation.pagination .nav-links a::after',
			'body.page .entry-content .page-links a::after',
			'body.single-post .entry-content .page-links a::after',
			'.navigation.pagination .nav-links span::after',
			'body.page .entry-content .page-links span::after',
			'body.single-post .entry-content .page-links span::after',
			'body.page article .has-drop-cap:not(:focus) > span::before',
			'body.single-post article .has-drop-cap:not(:focus) > span::before',
		],
	];
}

/**
 * Returns custom color selectors
 *
 * @return array
 */
function pierogi_get_secondary_selectors() {
	return [
		'background-color' => [
			'.btn-primary',
			'.faux-button',
			'.wp-block-button__link',
			'.wp-block-file .wp-block-file__button',
			'.bg-accent',
			'.bg-accent-hover:hover',
			'.bg-accent-hover:focus',
			'input[type="submit"]',
			'input[type="button"]',
		],
		'border-color' => [
			'.btn-primary:hover',
			'.faux-button:hover',
			'.wp-block-button__link:hover',
			'.wp-block-file .wp-block-file__button:hover',
			'.bg-accent:hover',
			'.bg-accent-hover:hover:hover',
			'.bg-accent-hover:focus:hover',
			'input[type="submit"]:hover',
			'input[type="button"]:hover',
		],
		'color' => [
			'.btn-primary:hover',
			'.faux-button:hover',
			'.wp-block-button__link:hover',
			'.wp-block-file .wp-block-file__button:hover',
			'.bg-accent:hover',
			'.bg-accent-hover:hover:hover',
			'.bg-accent-hover:focus:hover',
			'input[type="submit"]:hover',
			'input[type="button"]:hover',
			'.main-navigation-mobile .current-menu-item > a',
			'.main-navigation-mobile .current-menu-item > span',
			'.main-navigation-mobile .current-menu-item > .item-wrap > a',
			'.main-navigation-mobile .current-menu-item > .item-wrap > span',
		],
	];
}

/**
 * Returns string with custom css
 *
 * @param  array  $styles Styling rules array.
 * @param  string $color  Color.
 * @return string
 */
function pierogi_prepare_custom_css( $styles, $color ) {
	$rules = [];

	foreach ( $styles as $prop => $selectors ) {
		$selectors = implode( ",\n\t", $selectors );

		$rules[] = "\t{$selectors} {\n\t\t{$prop}: {$color};\n\t}";
	}

	return implode( "\n\n", $rules );
}

/**
 * Outputs customizer styles
 *
 * @return void
 */
function pierogi_custom_styles() {
	$colors   = get_theme_mod( 'colors' );
	$defaults = pierogi_get_theme_mod_default( 'colors' );

	$custom_css = [];

	if ( $colors['accent'] !== $defaults['accent'] ) {
		$accent_selectors = pierogi_get_accent_selectors();
		$light_selectors  = pierogi_get_accent_light_selectors();

		$custom_css[] = pierogi_prepare_custom_css( $accent_selectors, $colors['accent'] );
		$custom_css[] = pierogi_prepare_custom_css( $light_selectors, $colors['light'] );
	}

	if ( $colors['secondary'] !== $defaults['secondary'] ) {
		$secondary_selectors = pierogi_get_secondary_selectors();
		$custom_css[]        = pierogi_prepare_custom_css( $secondary_selectors, $colors['secondary'] );
	}

	if ( $custom_css ) {
		wp_add_inline_style( 'pierogi-style', implode( '', $custom_css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'pierogi_custom_styles' );
