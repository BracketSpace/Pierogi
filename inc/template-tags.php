<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pierogi
 */

if ( ! function_exists( 'pierogi_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function pierogi_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'pierogi' ), // phpcs:ignore
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore

	}
endif;

if ( ! function_exists( 'pierogi_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function pierogi_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'pierogi' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore

	}
endif;

if ( ! function_exists( 'pierogi_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function pierogi_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'pierogi' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'pierogi' ) . '</span>', $categories_list ); // phpcs:ignore
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'pierogi' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'pierogi' ) . '</span>', $tags_list ); // phpcs:ignore
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pierogi' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'pierogi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'pierogi_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $size Post thumbnail size.
	 */
	function pierogi_post_thumbnail( $size = null ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			printf( '<div class="post-thumbnail">%s</div>',
				get_the_post_thumbnail(  $post->ID, $size )
			);
		} else {
			printf( '<a class="post-thumbnail" href="%s" aria-hidden="true" tabindex="-1">%s</a>',
				esc_html( get_the_permalink() ),
				get_the_post_thumbnail( $post->ID, $size )
			);
		} // End is_singular().
	}
endif;

if ( ! function_exists( 'pierogi_footer_logo' ) ) :
	/**
	 * Displays footer logo.
	 */
	function pierogi_footer_logo() {
		$footer_logo_id = get_theme_mod( 'footer_logo', null );

		if ( $footer_logo_id ) {
			$footer_logo_attr = [
				'class' => 'footer-logo',
			];

			$image_alt = get_post_meta( $footer_logo_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$footer_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
			}

			printf(
					'<a href="%1$s" class="footer-logo-link" rel="home">%2$s</a>',
					esc_url( home_url( '/' ) ),
					wp_get_attachment_image( $footer_logo_id, 'full', false, $footer_logo_attr )
			);
		} elseif ( is_customize_preview() ) {
			printf(
				'<a href="%1$s" class="footer-logo-link" style="display:none;"><img class="footer-logo"/></a>',
				esc_url( home_url( '/' ) )
			);
		}
	}
endif;

/**
 * Display sidebar based on theme settings
 *
 * @return void
 */
function pierogi_display_sidebar() {
	if ( 'has-sidebar' === get_theme_mod( 'pierogi_theme_layout' ) ) {
		get_sidebar();
	}
}

/**
 * Display sidebar based on theme settings
 *
 * @return void
 */
function pierogi_footer_text() {
	echo wp_kses_post( apply_filters( 'pierogi_footer_text', get_theme_mod( 'pierogi_footer_text' ) ) );
}
