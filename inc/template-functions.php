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
 * Filter comment form fields
 *
 * @param array $fields Comment form fields.
 *
 * @return array
 */
function pierogi_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = $req ? "aria-required='true'" : '';

		$fields['author'] =
			'<p class="comment-form-author">
				<label for="author">' . __( 'Your name (required)', 'pierogi' ) . '</label>
				<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Awesome Client-Love', 'pierogi' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30" max-lenght="245"' . $aria_req . ' />
			</p>';

		$fields['email'] =
			'<p class="comment-form-email">
				<label for="email">' . __( 'Your email (required)', 'pierogi' ) . '</label>
				<input id="email" name="email" type="email" placeholder="' . esc_attr__( 'hello@awesomeclient.com', 'pierogi' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30" max-lenght="100" ' . $aria_req . ' />
			</p>';

		$fields['url'] =
			'<p class="comment-form-url">
				<label for="url">' . __( 'Website', 'pierogi' ) . '</label>
				<input id="url" name="url" type="url"  placeholder="' . esc_attr__( 'Awesome Client-Love', 'pierogi' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" />
			</p>';

	return $fields;
}

add_filter( 'comment_form_default_fields', 'pierogi_comment_form_fields' );

/**
 * Filter comment form comment fields
 *
 * @return string
 */
function pierogi_comment_form_field() {
	$field .= '<p class="comment-form-comment">';
	$field .= '<label for="comment">' . esc_html( 'Leave a reply', 'pierogi' ) . '</label>';
	$field .= '<textarea id="comment" name="comment" required="required" placeholder="' . esc_html( 'Write a comment...', 'pierogi' ) . '"></textarea>';
	$field .= '</p>';

	return $field;
}

add_filter( 'comment_form_field_comment', 'pierogi_comment_form_field' );
