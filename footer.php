<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pierogi
 */

$pierogi_footer_logo      = get_theme_mod( 'footer_logo', null );
$pierogi_footer_copyright = get_theme_mod( 'pierogi_footer_copyright', null );

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'pierogi' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'depth'          => 1,
				)
			);
			?>
		</nav><!-- .footer-navigation -->
		<div class="site-info">
			<div class="container">
				<?php if ( ! empty( $pierogi_footer_logo ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
					<?php echo wp_get_attachment_image( $pierogi_footer_logo, 'full' ); ?>
				</a>
				<?php endif; ?>
				<div class="site-info-content">
					<?php
					if ( ! empty( $pierogi_footer_copyright ) ) :
						echo apply_filters( 'the_content', $pierogi_footer_copyright ); // phpcs:ignore
					endif;
					?>
				</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
