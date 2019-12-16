<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Pierogi
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pierogi_body_classes( $classes ) {
	$display_sidebar = get_theme_mod( 'pierogi_sidebar_settings' );

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a layout class.
	$classes[] = get_theme_mod( 'pierogi_theme_layout' );

	// Add blog page layout type css class.
	if ( is_home() ) {
		$blog_layout = get_theme_mod( 'pierogi_blog_layout' );
		$classes[]   = "blog-layout-{$blog_layout}";
	}

	return $classes;
}
add_filter( 'body_class', 'pierogi_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pierogi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pierogi_pingback_header' );

/**
 * Filter footer text.
 *
 * @param  string $text Footer text.
 * @return string
 */
function pierogi_footer_text_filter( $text ) {
	return str_ireplace( [
		'%year%',
		'BracketSpace',
		'WordPress',
	], [
		date( 'Y' ),
		sprintf( '<a href="%s" target="_blank">%s</a>', 'https://bracketspace.com', 'BracketSpace' ),
		sprintf( '<a href="%s" target="_blank">%s</a>', 'https://wordpress.org', 'WordPress' ),
	], esc_html( $text ) );
}
add_action( 'pierogi_footer_text', 'pierogi_footer_text_filter', 1000 );

/**
 * Filter comment author text
 *
 * @param string $translated_text Translated text.
 * @param string $text  Text to translate.
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 *
 * @return string
 */
function pierogi_remove_comments_text( $translated_text, $text, $domain ) {

	if ( '%s <span class="says">says:</span>' === $text && 'default' === $domain ) {
		return '%s';
	}

	return $translated_text;
}

add_filter( 'gettext', 'pierogi_remove_comments_text', 20, 3);
