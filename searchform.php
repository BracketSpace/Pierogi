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
		<svg class="header-modal-close" height="18.243" viewBox="0 0 18.243 18.243" width="18.243" xmlns="http://www.w3.org/2000/svg"><title><?php esc_html_e( 'Close search form', 'pierogi' ); ?></title><g fill="none" stroke="#adb5bd" stroke-linecap="round" stroke-width="3"><path d="m2.121 2.121 14 14"/><path d="m16.121 2.121-14 14"/></g></svg>
	</button>
</form>
