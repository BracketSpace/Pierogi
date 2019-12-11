<?php
/**
 * Pierogi Image functions
 *
 * @package Pierogi
 */

add_image_size('post-list-thumb', 521, 348, true);

/**
 * Add theme image sizes
 *
 * @return void
 */
function pierogi_theme_image_sizes() {
	update_option( 'medium_size_l', 895, true );
	update_option( 'medium_size_h', 9999, false );
	update_option( 'large_size_l', 1269, true );
	update_option( 'large_size_h', 9999, false );
}

add_action( 'init', 'pierogi_theme_image_sizes' );
