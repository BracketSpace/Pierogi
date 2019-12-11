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

		$wp_customize->selective_refresh->add_partial(
			'footer_logo',
			[
				'selector'            => 'a.footer-logo-link',
				'render_callback'     => 'pierogi_customize_partial_footer_logo',
				'container_inclusive' => true,
			]
		);

		$wp_customize->selective_refresh->add_partial(
			'pierogi_footer_text',
			[
				'selector'            => '.footer-text',
				'render_callback'     => 'pierogi_customize_partial_footer_text',
			]
		);
	}

	$wp_customize->add_section( 'pierogi_footer', [
		'title'    => __( 'Footer', 'pierogi' ),
		'priority' => 120,
	] );

	$wp_customize->add_setting( 'footer_logo', [
		'transport' => 'postMessage',
	] );

	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'footer_logo',
			[
				'label'         => __( 'Footer Logo', 'pierogi' ),
				'section'       => 'pierogi_footer',
				'settings'      => 'footer_logo',
				'priority'      => 9,
				'width'         => 134,
				'height'        => 48,
				'flex_width'    => true,
				'flex_height'   => true,
				'button_labels' => [
					'select'       => __( 'Select logo', 'pierogi' ),
					'change'       => __( 'Change logo', 'pierogi' ),
					'remove'       => __( 'Remove', 'pierogi' ),
					'default'      => __( 'Default', 'pierogi' ),
					'placeholder'  => __( 'No logo selected', 'pierogi' ),
					'frame_title'  => __( 'Select logo', 'pierogi' ),
					'frame_button' => __( 'Choose logo', 'pierogi' ),
				],
			]
		)
	);

	$wp_customize->add_setting( 'pierogi_footer_text', [
		'capability' => 'edit_theme_options',
		'default'    => pierogi_get_theme_mod_default( 'pierogi_footer_text' ),
		'transport'  => 'postMessage',
	] );

	$wp_customize->add_control( 'pierogi_footer_text', [
		'type'        => 'textarea',
		'section'     => 'pierogi_footer',
		'label'       => __( 'Footer Text', 'pierogi' ),
	] );

	$wp_customize->add_section( 'pierogi_layout', [
		'title' => __( 'Layout', 'pierogi' ),
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
			'no-sidebar'  => __( 'No Sidebar', 'pierogi' ),
			'has-sidebar' => __( 'With Sidebar', 'pierogi' ),
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
 * Render the footer logo for the selective refresh partial.
 *
 * @return void
 */
function pierogi_customize_partial_footer_logo() {
	pierogi_footer_logo();
}

/**
 * Render the footer text for the selective refresh partial.
 *
 * @return void
 */
function pierogi_customize_partial_footer_text() {
	pierogi_footer_text();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pierogi_customize_preview_js() {
	wp_enqueue_script( 'pierogi-customizer', get_template_directory_uri() . '/js/customizer.js', [ 'customize-preview' ], '1.0.0', true );
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
		'pierogi_footer_text'  => '© %year% All Rights Reserved. Pierogi by BracketSpace. Proudly powered by WordPress',
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
