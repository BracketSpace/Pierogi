<?php
/**
 * Sidebar functions
 *
 * @package Pierogi
 */

/**
 * Modify tag cloud widget markup
 *
 * @param string $input Tag cloud link.
 *
 * @return string
 */
function pierogi_format_tagcloud_link( $input ) {
	return preg_replace( [
		'/ style=("|\')(.*?)("|\')/',
		'#<span class="tag-link-count"> \(([0-9]+)\)</span>#i',
	], [
		'',
		'<span class="tag-link-count">$1</span>',
	], $input );
}
add_filter( 'wp_generate_tag_cloud', 'pierogi_format_tagcloud_link' );

/**
 * Filter archives count display
 *
 * @param string $link Archive links.
 * @return string
 */
function pierogi_archive_count( $link ) {
	return preg_replace( '#</a>(?:&nbsp;|[\s]+)\(([0-9]+)\)#i', '<span>$1</span></a>', $link );
}
add_filter( 'get_archives_link', 'pierogi_archive_count' );
add_filter( 'wp_list_categories', 'pierogi_archive_count' );

/**
 * Display widgets
 *
 * @param mixed $index Sidebar index.
 * @param bool  $has_widgets Whether sodebar has widgets.
 * @return void
 */
function pierogi_display_default_widgets( $index, $has_widgets ) {
	if ( $has_widgets || is_admin() ) {
		return;
	}

	$args = [
		'before_title' => '<h2 class="widget-title">',
	];

	the_widget( 'WP_Widget_Categories', [
		'count'        => '1',
		'hierarchical' => '1',
	], $args );
	the_widget( 'WP_Widget_Tag_Cloud', [ 'count' => '1' ], $args );
	the_widget( 'WP_Widget_Recent_Comments', [], $args );
}
add_action( 'dynamic_sidebar_before', 'pierogi_display_default_widgets', 10, 2 );
