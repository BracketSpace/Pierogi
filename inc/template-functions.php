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
 * Output author box markup
 *
 * @return void
 */
function pierogi_author_box() {
	$author_name = get_the_author_meta( 'display_name' );
	$author_id   = get_the_author_meta( 'ID' );
	$gravatar    = get_avatar( $author_id, 147 );
	$description = wpautop( get_the_author_meta( 'description' ) );
	$output      = [];

		$author_content[] = sprintf(
			'<div class="author-title">%s %s</div>',
			'<span class="h2">' . __( 'Author', 'pierogi' ) . '</span>',
			'<span class="h6">' . esc_html( $author_name ) . '</span>'
		);

		$content[] = sprintf(
			'<div class="author-box-content-wrap">%s %s</div>',
			implode('', $author_content ),
			$description
		);

		$gravatar_content[] = sprintf(
			'<div class="author-gravatar">%s</div>',
			$gravatar
		);

		//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		$output[] = printf(
			'<section class="author-box">%s %s</section>',
			implode( '', $gravatar_content ),
			implode( '', $content )
		);
		//phpcs:enable
}
