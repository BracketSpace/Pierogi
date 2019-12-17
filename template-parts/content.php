<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_categories_list = get_the_category_list( esc_html__( ', ', 'pierogi' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<div class="alignwide">

		<?php pierogi_post_thumbnail( 'post-header' ); ?>

		</div>

	<?php endif; ?>

	<header class="entry-header">
		<div class="author-image">
			<div class="author-image-inner">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 139 ); ?>
			</div>
		</div>
		<div class="entry-meta">
				<?php
					pierogi_posted_on();
				?>
				&#183;
				<?php
				the_author_meta( 'display_name' );
				if ( $pierogi_categories_list ) {
					/* translators: 1: list of categories. */
					printf( ' &#183; <span class="cat-links">' . esc_html__( '%1$s', 'pierogi' ) . '</span>', $pierogi_categories_list ); // phpcs:ignore
				}
				?>
		</div><!-- .entry-meta -->
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
