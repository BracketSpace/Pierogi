<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Pierogi
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'pierogi' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</header><!-- .page-header -->


<?php else : ?>

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'pierogi' ); ?></h1>
	</header><!-- .page-header -->

<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="posts">

				<?php if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'loop' );

					endwhile;

					the_posts_pagination( [ 'mid_size' => 2 ] );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</div>

		</main><!-- #main -->

		<?php	pierogi_display_sidebar(); ?>

	</div><!-- #primary -->

<?php
get_footer();
