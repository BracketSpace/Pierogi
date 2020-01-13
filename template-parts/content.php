<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

$pierogi_show_avatar = get_theme_mod( 'author_avatar' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header<?php $pierogi_show_avatar && print( ' has-avatar' ); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<?php pierogi_post_thumbnail( 'pierogi_post_header' ); ?>
		<?php endif; ?>

		<?php if ( $pierogi_show_avatar ) : ?>
			<div class="author-image">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 139, '', '', [ 'force_display' => true ] ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-meta">
			<?php pierogi_entry_meta(); ?>
		</div>

		<div class="entry-title-wrap">
					<?php
					the_title( '<h1 class="entry-title">', '</h1>' );

					if ( function_exists( 'the_subtitle' ) ) {
						the_subtitle( '<p class="entry-subtitle">', '</p>' );
					};
					?>
		</div>

		<?php the_excerpt(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pierogi' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			)
		);

		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pierogi' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( has_tag() ) : ?>

		<footer class="entry-footer">
			<div class="entry-meta">
				<span class="entry-tags">
					<?php esc_html_e( 'Tagged:', 'pierogi' ); ?>
					<?php pierogi_entry_tags(); ?>
				</span>
			</div>
		</footer>

	<?php endif; ?>

	<?php get_template_part( 'template-parts/post-author-box' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
