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
 * Adds markup for Drop Cap
 *
 * @param  string $content Post content.
 * @return string
 */
function pierogi_drop_cap( $content ) {
	return preg_replace_callback( '%(<p(?:[^>]+)(?:class="[^"]*(?:has-drop-cap)[^"]*")(?:[^>]*)>)([^<>]+)(</p>)%i', function( $matches ) {
		unset( $matches[0] );
		$matches[2] = sprintf( '<span>%s</span>%s', substr( $matches[2], 0, 1 ), substr( $matches[2], 1 ) );

		return implode( '', $matches );
	}, $content );

}
add_action( 'the_content', 'pierogi_drop_cap' );

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

/**
 * Filter post author name
 *
 * @param string $author_name Author name.
 * @return string
 */
function pierogi_the_author( $author_name ) {
	$first_name = get_the_author_meta( 'first_name' );

	if ( $first_name ) {
		return $first_name;
	}

	return $author_name;
}
add_filter( 'the_author', 'pierogi_the_author' );

/**
 * Filter post excerpt
 *
 * @param string $excerpt Excerpt content.
 * @return string
 */
function pierogi_the_excerpt( $excerpt ) {
	if ( is_singular( 'post' ) ) {
		return sprintf( '<div class="post-excerpt">%s</div>', $excerpt );
	}

	return $excerpt;
}
add_filter( 'the_excerpt', 'pierogi_the_excerpt' );

/**
 * Filter comment form fields
 *
 * @param array $fields Comment form fields.
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
