<?php
/**
 * The template for displaying home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_page_title       = is_front_page() ? esc_html( 'Blog', 'pierogi' ) : get_the_title( get_option( 'page_for_posts' ) );
$pierogi_blog_layout_type = get_theme_mod( 'pierogi_blog_layout' );

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
<div class="wrap <?php echo esc_html( $pierogi_blog_layout_type ); ?>">
	<div class="posts-container">
		<div id="primary" class="content-area">
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

						get_template_part( 'template-parts/post-list-item' );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div>
<?php

if ( pierogi_blog_sidebar() ) {
	get_sidebar();
}

?>
<?php get_footer(); ?>
