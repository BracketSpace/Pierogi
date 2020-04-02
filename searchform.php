<?php
/**
 * The search form for the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pierogi
 */

?>
<div class="search-form">
	<form method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input class="search-input" type="text" name="s" placeholder="<?php esc_attr_e( 'Type words and hit enter', 'pierogi' ); ?>" value="<?php the_search_query(); ?>"  tabindex="-1" />
		<button class="btn-primary search-button" type="submit" tabindex="-1">
			<?php echo pierogi_get_inline_svg( 'icon-search' ); // phpcs:ignore ?>
			<?php esc_html_e( 'Search', 'pierogi' ); ?>
		</button>
		<button type="button" class="search-close" tabindex="-1">
			<img src="<?php pierogi_image_url( 'searchform-close.svg' ); ?>" alt="<?php esc_attr_e( 'Close search form', 'pierogi' ); ?>" />
		</button>
	</form>
</div>
