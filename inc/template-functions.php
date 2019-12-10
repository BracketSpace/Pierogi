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
	$options = pierogi_get_theme_mods();

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of sidebar-active when sidebar is activated in customizer.
	if ( $options['pierogi_sidebar_settings'] ) {
		$classes[] = 'sidebar-active';
	}

	// Add blog page layout type css class.
	if ( is_home() ) {
		$classes[] = $options['pierogi_blog_layout'];
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
 * Display sidebar based on theme settings
 *
 * @return void
 */
function pierogi_display_sidebar() {
	$options = pierogi_get_theme_mods();

	if ( $options['pierogi_sidebar_settings'] ) {
		get_sidebar();
	}
}
