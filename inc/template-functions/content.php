<?php
/**
 * Content functions
 *
 * @package Pierogi
 */

/**
 * Adds markup for Drop Cap
 *
 * @param  string $content Post content.
 * @return string
 */
function pierogi_drop_cap( $content ) {
	return preg_replace_callback( '%(<p(?:[^>]+)(?:class="[^"]*(?:has-drop-cap)[^"]*")(?:[^>]*)>)((?!</p).+)(</p>)%i', function( $matches ) {
		unset( $matches[0] );
		$matches[1] = str_replace( 'has-drop-cap', 'pierogi-drop-cap', $matches[1] );
		$first_letter;
		$remaining_text;

		if ( '<' === substr( $matches[2], 0, 1 ) && preg_match( '%((?:(?:<strong>)|(?:<em>))+)(.+)%i', $matches[2], $submatches ) ) {
			$first_letter   = $submatches[1] . substr( $submatches[2], 0, 1 ) . str_replace( '<', '</', $submatches[1] );
			$remaining_text = $submatches[1] . substr( $submatches[2], 1 );
		} else {
			$first_letter   = substr( $matches[2], 0, 1 );
			$remaining_text = substr( $matches[2], 1 );
		}

		$matches[2] = sprintf( '<span>%s</span>%s', $first_letter, $remaining_text );

		return implode( '', $matches );
	}, $content );
}
add_filter( 'the_content', 'pierogi_drop_cap' );

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
 * Prevent from displaying auto-generated excerpt on single post
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
