<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="alignwide">
				<?php pierogi_post_thumbnail( 'post-header' ); ?>
			</div>

		<?php endif; ?>

		<div class="author-image">
			<div class="author-image-inner">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 139 ); ?>
			</div>
		</div>

		<div class="entry-meta">
				<?php pierogi_entry_meta(); ?>
		</div>

		<div class="single-post-header">
					<?php
					the_title( '<h1 class="entry-title">', '</h1>' );

					if ( function_exists( 'the_subtitle' ) ) {
						the_subtitle( '<p class="entry-subtitle">', '</p>' );
					};
					?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pierogi' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pierogi' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/author-box' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
