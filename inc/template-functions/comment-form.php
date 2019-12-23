<?php
/**
 * Comment form functions
 *
 * @package Pierogi
 */

/**
 * Filter comment form fields
 *
 * @param array $fields Comment form fields.
 * @return array
 */
function pierogi_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = $req ? " aria-required='true'" : '';

	$fields['author'] = sprintf(
		'<p class="comment-form-author">
			<label for="author">%s</label>
			<input id="author" name="author" type="text" placeholder="%s" value="%s" size="30" max-lenght="245"%s />
		</p>',
		esc_html__( 'Your name (required)', 'pierogi' ),
		esc_attr__( 'Awesome Client-Love', 'pierogi' ),
		esc_attr( $commenter['comment_author'] ),
		$aria_req
	);

	$fields['email'] = sprintf(
		'<p class="comment-form-email">
			<label for="email">%s</label>
			<input id="email" name="email" type="email" placeholder="%s" value="%s" size="30" max-lenght="100"%s />
		</p>',
		esc_html__( 'Your email (required)', 'pierogi' ),
		esc_attr__( 'hello@awesomeclient.com', 'pierogi' ),
		esc_attr( $commenter['comment_author_email'] ),
		$aria_req
	);

	$fields['url'] = sprintf(
		'<p class="comment-form-url">
			<label for="url">%s</label>
			<input id="url" name="url" type="url"  placeholder="%s" value="%s" />
		</p>',
		esc_html__( 'Website', 'pierogi' ),
		esc_attr__( 'Awesome Client-Love', 'pierogi' ),
		esc_attr( $commenter['comment_author_url'] )
	);

	return $fields;
}
add_filter( 'comment_form_default_fields', 'pierogi_comment_form_fields' );

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
		esc_html( 'Leave a reply', 'pierogi' ),
		esc_html( 'Write a comment...', 'pierogi' )
	);
}
add_filter( 'comment_form_field_comment', 'pierogi_comment_form_field' );
