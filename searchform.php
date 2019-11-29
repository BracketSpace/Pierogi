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
	<div class="input-container">
		<svg height="20.121" viewBox="0 0 20.121 20.121" width="20.121" xmlns="http://www.w3.org/2000/svg"><g stroke="#868e96" stroke-width="3"><g fill="#fff"><circle cx="8.101" cy="8.101" r="8.101" stroke="none"/><circle cx="8.101" cy="8.101" fill="none" r="6.601"/></g><path d="m14.391 14.391 3.609 3.609" fill="none" stroke-linecap="round"/></g></svg>
		<input class="seach-input" type="text" name="s" placeholder="<?php esc_html_e( 'Type words and hit enter', 'pierogi' ); ?>" value="">
	</div>
	<input id="search-button" class="btn search-form-btn" type="submit" value="<?php esc_html_e('Search', 'pierogi'); ?>" />
	<button type="button" class="search-close">
		<svg class="header-modal-close" height="18.243" viewBox="0 0 18.243 18.243" width="18.243" xmlns="http://www.w3.org/2000/svg"><title><?php esc_html_e( 'Close search form', 'pierogi' ); ?></title><g fill="none" stroke="#adb5bd" stroke-linecap="round" stroke-width="3"><path d="m2.121 2.121 14 14"/><path d="m16.121 2.121-14 14"/></g></svg>
	</button>
</form>
