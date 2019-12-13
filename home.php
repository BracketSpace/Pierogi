<?php
/**
 * The template for displaying home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_page_title = is_front_page() ? esc_html( 'Blog', 'pierogi' ) : get_the_title( get_option( 'page_for_posts' ) );

get_header();

?>
<header class="page-header">
	<h1 class="page-title screen-reader-text"><?php echo esc_html( $pierogi_page_title ); ?></h1>

	<?php
	if ( function_exists( 'the_subtitle' ) ) {
		the_subtitle( '<p class="entry-subtitle featured">', '</p>' );
	}
	?>

</header>
	<div class="content-area">
		<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/

					get_template_part( 'template-parts/content-loop' );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;

			the_posts_pagination( [ 'mid_size' => 2 ] );

			?>

		</main><!-- #main -->

		<?php	pierogi_display_sidebar(); ?>

	</div>

<?php get_footer(); ?>
