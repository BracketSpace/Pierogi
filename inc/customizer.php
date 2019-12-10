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
			[
				'selector'        => '.site-title a',
				'render_callback' => 'pierogi_customize_partial_blogname',
			]
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			[
				'selector'        => '.site-description',
				'render_callback' => 'pierogi_customize_partial_blogdescription',
			]
		);
	}

	$wp_customize->add_section( 'pierogi_layout', [
		'title'       => __( 'Layout', 'pierogi' ),
	] );

	$wp_customize->add_setting( 'pierogi_theme_layout', [
		'default' => pierogi_get_theme_mod_default( 'pierogi_theme_layout' ),
		'type'    => 'theme_mod',
	] );

	$wp_customize->add_control( 'pierogi_theme_layout_control', [
		'section'  => 'pierogi_layout',
		'settings' => 'pierogi_theme_layout',
		'type'     => 'radio',
		'label'    => __( 'Layout', 'pierogi' ),
		'choices'  => [
			'no-sidebar'   => __( 'No Sidebar', 'pierogi' ),
			'with-sidebar' => __( 'With Sidebar', 'pierogi' ),
		],
	] );

	$wp_customize->add_setting( 'pierogi_blog_layout', [
		'default' => pierogi_get_theme_mod_default( 'pierogi_blog_layout' ),
		'type'    => 'theme_mod',
	] );

	$wp_customize->add_control( 'pierogi_blog_layout_control', [
		'section'  => 'pierogi_layout',
		'settings' => 'pierogi_blog_layout',
		'type'     => 'radio',
		'label'    => __( 'Blog Posts Layout', 'pierogi' ),
		'choices'  => [
			'grid' => __( 'Grid', 'pierogi' ),
			'list' => __( 'List', 'pierogi' ),
		],
	] );
}
add_action( 'customize_register', 'pierogi_customize_register' );

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

/**
 * Customizer defaults
 *
 * @return array
 */
function pierogi_get_theme_mods_defaults() {
	$defaults = [
		'pierogi_theme_layout' => 'no-sidebar',
		'pierogi_blog_layout'  => 'grid',
	];

	return apply_filters( 'pierogi_theme_mod_defaults', $defaults );
}

/**
 * Filters theme mods option.
 *
 * @param  array $theme_mods Theme mods array.
 * @return array
 */
function pierogi_theme_mods_filter( $theme_mods ) {
	return array_merge( pierogi_get_theme_mods_defaults(), $theme_mods );
}
add_filter( 'option_theme_mods_pierogi', 'pierogi_theme_mods_filter' );

/**
 * Get theme mod default value.
 *
 * @param  string $theme_mod Theme Mod name.
 * @return mixed
 */
function pierogi_get_theme_mod_default( $theme_mod ) {
	$defaults = pierogi_get_theme_mods_defaults();

	return array_key_exists( $theme_mod, $defaults ) ? $defaults[ $theme_mod ] : null;
}
