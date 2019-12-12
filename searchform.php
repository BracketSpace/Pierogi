<?php
/**
 * The search form for the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pierogi
 */

?>
<form method="POST" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input class="seach-input" type="text" name="s" placeholder="<?php esc_html_e( 'Type words and hit enter', 'pierogi' ); ?>" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>">
	<input id="search-button" class="btn search-form-btn" type="submit" value="<?php esc_html_e( 'Search', 'pierogi' ); ?>" />
	<button type="button" class="search-close">
		<img src="<?php pierogi_image_url( 'searchform-close.svg' ); ?>" alt="<?php esc_attr_e( 'Close search form', 'pierogi' ); ?>" />
	</button>
</form>
