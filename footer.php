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

$pierogi_footer_text = get_theme_mod( 'footer_text', null );
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php pierogi_footer_navigation(); ?>
		<div class="site-info">
			<div class="container">
				<?php pierogi_footer_logo(); ?>
				<p class="footer-text">
					<?php pierogi_footer_text(); ?>
				</p>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
