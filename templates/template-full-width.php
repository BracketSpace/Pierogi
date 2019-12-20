<?php
/**
 * Template Name: Full width page
 * Template Post Type: post, page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pierogi
 */

if ( is_page() ) {
	get_template_part( 'page' );
} else {
	get_template_part( 'single' );
}
