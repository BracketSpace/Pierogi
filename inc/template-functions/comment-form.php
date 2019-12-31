<?php
/**
 * Comment form functions
 *
 * @package Pierogi
 */

/**
 * Filter comment form comment fields
 *
 * @return string
 */
function pierogi_comment_form_field() {
	return sprintf(
		'<p class="comment-form-comment">
			<label for="comment">%s</label>
			<textarea id="comment" name="comment" required="required" placeholder="%s"></textarea>
		</p>',
		esc_html__( 'Leave a reply', 'pierogi' ),
		esc_html__( 'Write a comment...', 'pierogi' )
	);
}
add_filter( 'comment_form_field_comment', 'pierogi_comment_form_field' );
