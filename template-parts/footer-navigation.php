<?php
/**
 * Template part for displaying footer navigation
 *
 * @package Pierogi
 */

?>

<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'pierogi' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'footer',
		'menu_class'     => 'footer-menu',
		'depth'          => 1,
	] );
	?>
</nav><!-- .footer-navigation -->
