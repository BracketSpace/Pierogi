<?php
/**
 * Pierogi Theme Customizer Styles
 *
 * @package Pierogi
 */

/**
 * Outputs customizer styles
 *
 * @return void
 */
function pierogi_custom_styles() {
	$accent    = get_theme_mod( 'pierogi_accent_color' );
	$light     = pierogi_lighten_color( $accent, 0.38, true );
	$secondary = get_theme_mod( 'pierogi_secondary_color' );

	if ( ! $accent && ! $secondary ) {
		return;
	}

	echo '<style type="text/css" id="pierogi-custom-css">';

	if ( $accent ) :
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo <<<EOT
		a,
		body.blog .entry-title a:hover,
		body.archive .entry-title a:hover,
		body.search .entry-title a:hover,
		body.blog .excerpt:hover p,
		body.archive .excerpt:hover p,
		body.search .excerpt:hover p,
		body.blog .read-more:hover,
		body.archive .read-more:hover,
		body.search .read-more:hover,
		.wp-block-cover a:hover,
		.entry-meta a:hover,
		.screen-reader-text:focus,
		.main-navigation .main-menu-wrap li:hover > a,
		.author-box .h6,
		.comments-area .comment-metadata a:hover,
		.comment-navigation .nav-links a,
		.site-header .site-branding p,
		.post-navigation a:hover,
		body.blog a:hover,
		body.archive a:hover,
		body.search a:hover {
			color: {$accent};
		}

		.site-header .navigation-container .search-button:hover g,
		.site-header .navigation-container .search-button:hover line {
			stroke: {$accent};
		}

		body.blog .read-more:hover::after,
		body.archive .read-more:hover::after,
		body.search .read-more:hover::after,
		.main-navigation .main-menu-wrap li a::after,
		.main-navigation .main-menu-wrap li span::after,
		.comment-navigation .nav-links a::after,
		body.blog .read-more:hover::after,
		body.archive .read-more:hover::after,
		body.search .read-more:hover::after {
			background-color: {$accent};
		}

		.screen-reader-text:focus {
			border-color: {$accent};
		}

		.site-footer .footer-navigation,
		.navigation.pagination .nav-links a::after,
		body.page .entry-content .page-links a::after,
		body.single-post .entry-content .page-links a::after,
		.navigation.pagination .nav-links span::after,
		body.page .entry-content .page-links span::after,
		body.single-post .entry-content .page-links span::after,
		body.page article .has-drop-cap:not(:focus) > span::before,
		body.single-post article .has-drop-cap:not(:focus) > span::before {
			background-color: ${light};
		}
EOT;
	endif;

	if ( $secondary ) :
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo <<<EOT
		.btn-primary,
		.faux-button,
		.wp-block-button__link,
		.wp-block-file .wp-block-file__button,
		.bg-accent,
		.bg-accent-hover:hover,
		.bg-accent-hover:focus,
		input[type="submit"],
		input[type="button"] {
			background-color: ${secondary};
		}

		.btn-primary:hover,
		.faux-button:hover,
		.wp-block-button__link:hover,
		.wp-block-file .wp-block-file__button:hover,
		.bg-accent:hover,
		.bg-accent-hover:hover:hover,
		.bg-accent-hover:focus:hover,
		input[type="submit"]:hover,
		input[type="button"]:hover {
			border-color: ${secondary};
			color: ${secondary};
		}

		.main-navigation-mobile .current-menu-item > a,
		.main-navigation-mobile .current-menu-item > span,
		.main-navigation-mobile .current-menu-item > .item-wrap > a,
		.main-navigation-mobile .current-menu-item > .item-wrap > span {
			color: ${secondary};
		}
EOT;
	endif;

	echo '</style>';
}
add_action( 'wp_head', 'pierogi_custom_styles' );
