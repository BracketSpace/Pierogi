<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pierogi
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			echo '<div class="post-navigation">';
			//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
			echo get_previous_post_link(
				'%link',
				pierogi_get_inline_svg( 'arrow-left' ) . '<span>' . esc_html__( 'Previous post', 'pierogi' ) . '</span><span>%title</span>'
			);

			echo get_next_post_link(
				'%link',
				'<span>' . esc_html__( 'Next post', 'pierogi'  ) . '</span><span>%title</span>' . pierogi_get_inline_svg( 'arrow-right' )
			);
			//phpcs:enable
			echo '</div>';

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

	<?php
		pierogi_display_sidebar();
	?>

	</div><!-- #primary -->

<?php
get_footer();
