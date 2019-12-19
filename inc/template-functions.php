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
	$blog_layout = is_home() ? get_theme_mod( 'pierogi_blog_layout' ) :
		( is_search() || is_archive() ? 'list' : false );

	if ( $blog_layout ) {
		$classes[] = "blog-layout-{$blog_layout}";
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
	if ( $excerpt && ( is_singular( 'post' ) || is_page() ) ) {
		return sprintf( '<div class="excerpt">%s</div>', $excerpt );
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
	$aria_req  = $req ? " aria-required='true'" : '';

	$fields['author'] = sprintf(
		'<p class="comment-form-author">
			<label for="author">%s</label>
			<input id="author" name="author" type="text" placeholder="%s" value="%s" size="30" max-lenght="245"%s />
		</p>',
		esc_html__( 'Your name (required)', 'pierogi' ),
		esc_attr__( 'Awesome Client-Love', 'pierogi' ),
		esc_attr( $commenter['comment_author'] ),
		$aria_req
	);

	$fields['email'] = sprintf(
		'<p class="comment-form-email">
			<label for="email">%s</label>
			<input id="email" name="email" type="email" placeholder="%s" value="%s" size="30" max-lenght="100"%s />
		</p>',
		esc_html__( 'Your email (required)', 'pierogi' ),
		esc_attr__( 'hello@awesomeclient.com', 'pierogi' ),
		esc_attr( $commenter['comment_author_email'] ),
		$aria_req
	);

	$fields['url'] = sprintf(
		'<p class="comment-form-url">
			<label for="url">%s</label>
			<input id="url" name="url" type="url"  placeholder="%s" value="%s" />
		</p>',
		esc_html__( 'Website', 'pierogi' ),
		esc_attr__( 'Awesome Client-Love', 'pierogi' ),
		esc_attr( $commenter['comment_author_url'] )
	);

	return $fields;
}
add_filter( 'comment_form_default_fields', 'pierogi_comment_form_fields' );

/**
 * Filter comment form comment fields
 *
 * @return string
 */
function pierogi_comment_form_field() {
	return sprintf(
		'<p class="comment-form-comment">
			<label for="comment">%s</label>
			<textarea id="comment" name="comment" required="required" placeholder="%s"></textarea>
		</p>',
		esc_html( 'Leave a reply', 'pierogi' ),
		esc_html( 'Write a comment...', 'pierogi' )
	);
}
add_filter( 'comment_form_field_comment', 'pierogi_comment_form_field' );

/**
 * Filter comment form comment fields
 *
 * @param  string  $excerpt Post Excerpt.
 * @param  WP_Post $post    Post object.
 * @return string
 */
function pierogi_get_the_excerpt( $excerpt, $post ) {
	if ( is_singular( 'post' ) || is_page() ) {
		if ( post_password_required( $post ) || ! $post->post_excerpt ) {
			// Prevent displaying auto generated excerpt on single post/page.
			return null;
		}
	}

	return $excerpt;
}
add_filter( 'get_the_excerpt', 'pierogi_get_the_excerpt', 10, 2 );

/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @param string $input Tag cloud link.
 *
 * @return string
 */
function pierogi_format_tagcloud_link( $input ) {
	$input = preg_replace( '/ style=("|\')(.*?)("|\')/', '', $input );

	return str_replace( [
		'<span class="tag-link-count"> (',
		')</span>',
	], [
		' <span class="tag-link-count">',
		'</span>',
	], $input );
}
add_filter( 'wp_generate_tag_cloud', 'pierogi_format_tagcloud_link' );

/**
 * Add custom category widget walker
 *
 * @param array $args Array of categories widget options.
 *
 * @return array
 */
function pierogi_add_custom_category_widget_walker( $args ) {

	$args['walker'] = new Pierogi_Widget_Category_Walker();

	return $args;
}
add_filter( 'widget_categories_args', 'pierogi_add_custom_category_widget_walker', 10, 2 );
