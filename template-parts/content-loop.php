<?php
/**
 * Template part for displaying blog posts on posts page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_categories_list = get_the_category_list( esc_html__( ', ', 'pierogi' ) );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

		<?php pierogi_post_thumbnail( 'post-list' ); ?>

	<?php endif; ?>

	<div class="post-content"><!-- .post -->

		<div class="entry-meta">
			<?php pierogi_entry_meta(); ?>
		</div><!-- .entry-meta -->

		<header class="entry-header">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<a class="excerpt" href="<?php the_permalink(); ?>">
				<?php the_excerpt(); ?>
			</a>

			<a class="read-more" href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'pierogi' ); ?> </a>
		</div><!-- .entry-content -->

	</div><!-- .post-list-content -->

</article><!-- #post-<?php the_ID(); ?> -->
