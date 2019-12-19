<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pierogi
 */

?>

<aside id="secondary" class="widget-area">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1');
	} else {
		the_widget( 'WP_Widget_Categories' );
		the_widget( 'WP_Widget_Tag_Cloud' );
		the_widget( 'WP_Widget_Recent_Comments' );
	}
	?>
</aside><!-- #secondary -->
