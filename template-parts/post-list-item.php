<?php
/**
 * Template part for displaying blog posts in list layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$categories_list = get_the_category_list( esc_html__( ', ', 'pierogi' ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( ' post-column-item ' ); ?>>

	<div class="post-column-thumbnail">

	<?php the_post_thumbnail( 'post-list-thumb' ); ?>

	</div>
	<div class="post-column-content">
		<div class="entry-meta">
			<?php
			pierogi_posted_on();

			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( ' &#183; <span class="cat-links">' . esc_html__( '%1$s', 'pierogi' ) . '</span>', $categories_list ); // phpcs:ignore
			}
			?>
		</div><!-- .entry-meta -->
		<header class="entry-header">

			<?php

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			?>

		</header><!-- .entry-header -->
		<div class="entry-content">

			<?php the_excerpt(); ?>

		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
