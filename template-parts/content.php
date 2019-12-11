<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_author_id       = $post->post_author;
$pierogi_author_image    = get_avatar( $author_id, 139);
$pierogi_author_name     = get_the_author_meta( 'display_name', $author_id );
$pierogi_categories_list = get_the_category_list( esc_html__( ', ', 'pierogi' ) );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="alignwide">

		<?php pierogi_post_thumbnail( 'large' ); ?>

	</div>
	<header class="entry-header">
		<div class="author-image">
			<div class="author-image-inner">
				<?php echo $pierogi_author_image; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		</div>
		<div class="entry-meta">
				<?php
					pierogi_posted_on();
				?>
				&#183;
				<?php
				echo esc_html( $pierogi_author_name );
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

	<footer class="entry-footer">
		<?php pierogi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
