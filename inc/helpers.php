<?php
/**
 * Helper functions
 *
 * @package Pierogi
 */

/**
 * Echoes image url
 *
 * @param  string $image Image name.
 * @return void
 */
function pierogi_image_url( $image ) {
	echo esc_url( get_theme_file_uri( "images/{$image}" ) );
}

/**
 * Display inline SVG from file.
 *
 * @param  string $filename Filename to load.
 * @return void
 */
function pierogi_inline_svg( $filename ) {
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo pierogi_get_inline_svg( $filename );
}

/**
 * Get inline SVG from file.
 *
 * @param  string $filename Filename to load.
 * @return string|bool
 */
function pierogi_get_inline_svg( $filename ) {
	$directory = get_template_directory();
	$filename  = "{$directory}/images/{$filename}.svg";

	if ( is_file( $filename ) ) {
		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		return file_get_contents( $filename );
	}

	return false;
}

/**
 * Returns theme layout
 *
 * @return string
 */
function pierogi_get_layout() {
	if ( is_404() ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/template-full-width.php' ) ) {
		$layout = 'full-width';
	} else {
		$layout = get_theme_mod( 'theme_layout' );
	}

	return apply_filters( 'pierogi_get_layout', $layout );
}

/**
 * Returns theme version
 *
 * @return string
 */
function pierogi_get_version() {
	return wp_get_theme()->get( 'Version' );
}
