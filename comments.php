<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) :
		?>

		<h2 class="comments-title">

			<?php
			$pierogi_comment_count = get_comments_number();

			printf(
				/* translators: 1: comment count number. */
				esc_html( _nx( '%1$s Comment', '%1$s Comments', $pierogi_comment_count, 'comments-title', 'pierogi' ) ),
				esc_html( number_format_i18n( $pierogi_comment_count ) )
			);
			?>

		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list
		<?php
		if ( ! get_option('show_avatars') ) {
			echo 'has-avatars';}
		?>
		">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 100,
				)
			);
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pierogi' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(array(
		'title_reply_before'   => '',
		'title_reply'          => '',
		'title_reply_after'    => '',
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'pierogi' ) . '</p>',
		'label_submit'         => esc_html__( 'Comment', 'pierogi' ),
	));
	?>

</div><!-- #comments -->
