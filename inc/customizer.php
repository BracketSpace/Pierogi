<?php
/**
 * Pierogi Theme Customizer
 *
 * @package Pierogi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pierogi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'pierogi_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'pierogi_customize_partial_blogdescription',
			)
		);
	}

}
add_action( 'customize_register', 'pierogi_customize_register' );

/**
 * Add blog layout settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function pierogi_register_blog_layout( $wp_customize ) {
	$wp_customize->add_section( 'pierogi_blog_layout', array(
		'title'             => __('Blog Layout', 'pierogi'),
		'description'       => __('Layout settings for blog page', 'pierogi'),
	) );

	$wp_customize->add_setting( 'pierogi_blog_layout', array(
		'default'       => 'column',
		'type'          => 'theme_mod',
	) );

	$wp_customize->add_control( 'pierogi_blog_layout_control', array(
		'section'     => 'pierogi_blog_layout',
		'settings'    => 'pierogi_blog_layout',
		'type'        => 'select',
		'choices'     => array(
			'grid'           => __('Grid', 'pierogi'),
			'column'         => __('Column', 'pierogi'),
		),
	) );
}

add_action( 'customize_register', 'pierogi_register_blog_layout' );

/**
 * Add sidebar settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function pierogi_register_sidebar_settings( $wp_customize ) {
	$wp_customize->add_section( 'pierogi_sidebar_settings', array(
		'title'             => __('Sidebar Settings', 'pierogi'),
		'description'       => __('Sidebar Settings', 'pierogi'),
	) );

	$wp_customize->add_setting( 'pierogi_sidebar_settings', array(
		'default'       => true,
		'type'          => 'theme_mod',
	) );

	$wp_customize->add_control( 'pierogi_sidebar_settings', array(
		'section'     => 'pierogi_sidebar_settings',
		'settings'    => 'pierogi_sidebar_settings',
		'type'        => 'select',
		'choices'     => array(
			true           => __('Display sidebar', 'pierogi'),
			false          => __('Hide sidebar', 'pierogi'),
		),
	) );
}

add_action( 'customize_register', 'pierogi_register_sidebar_settings' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pierogi_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pierogi_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pierogi_customize_preview_js() {
	wp_enqueue_script( 'pierogi-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'pierogi_customize_preview_js' );
