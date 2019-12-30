<?php
/**
 * Template for displaying author box
 *
 * @package Pierogi
 */

if ( get_the_author_meta( 'description' ) ) : ?>

<aside class="author-box">
	<div class="author-gravatar">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 147, '', '', array( 'force_display' => true ) ); ?>
	</div>
	<div class="author-box-content-wrap">
		<div class="author-title">
			<span class="h2"><?php esc_html_e( 'Author', 'pierogi' ); ?></span> <span class="h6"><?php the_author_meta( 'display_name' ); ?></span>
		</div>
		<p><?php the_author_meta( 'description' ); ?></p>
	</div>
</aside>

<?php endif; ?>
