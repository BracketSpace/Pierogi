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

$pierogi_footer_logo_id = get_theme_mod( 'footer_logo', '' );

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
				<?php if ( ! empty( $pierogi_footer_logo_id ) ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
					<?php echo wp_get_attachment_image( $footer_logo_id, 'full' ); ?>
				</a>
				<?php endif; ?>
				<div class="site-info-content">
					<span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( '&copy; 2019 All Rights Reserved. %1$s by %2$s.', 'pierogi' ), 'Pierogi', '<a href="https://bracketspace.com/" target="_blank">BracketSpace</a>' );
						?>
					</span>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'pierogi' ) ); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'pierogi' ), 'WordPress' );
						?>
					</a>
				</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
