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
			'footer_text',
			[
				'selector'            => '.footer-text',
				'render_callback'     => 'pierogi_customize_partial_footer_text',
			]
		);
	}

	$colors = pierogi_get_theme_mod_default( 'colors' );

	$wp_customize->add_setting( 'colors', [
		'transport'         => 'postMessage',
		'default'           => $colors,
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_colors',
	] );

	$wp_customize->add_setting( 'accent_color', [
		'transport'         => 'postMessage',
		'default'           => $colors['accent'],
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_colors',
	] );

	$wp_customize->add_setting( 'secondary_color', [
		'transport'         => 'postMessage',
		'default'           => $colors['secondary'],
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_colors',
	] );

	$wp_customize->add_control( 'accent_color', [
		'type'    => 'color',
		'label'   => __( 'Accent Color', 'pierogi' ),
		'section' => 'colors',
	] );
	$wp_customize->add_control( 'secondary_color', [
		'type'    => 'color',
		'label'   => __( 'Buttons Color', 'pierogi' ),
		'section' => 'colors',
	] );

	$wp_customize->add_section( 'pierogi_footer', [
		'title'    => __( 'Footer', 'pierogi' ),
		'priority' => 120,
	] );

	$wp_customize->add_setting( 'footer_logo', [
		'transport'         => 'postMessage',
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_footer_logo',
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

	$wp_customize->add_setting( 'footer_text', [
		'capability'        => 'edit_theme_options',
		'default'           => pierogi_get_theme_mod_default( 'footer_text' ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_footer_text',
	] );

	$wp_customize->add_control( 'footer_text', [
		'type'        => 'textarea',
		'section'     => 'pierogi_footer',
		'label'       => __( 'Footer Text', 'pierogi' ),
	] );

	$wp_customize->add_section( 'pierogi_layout', [
		'title'    => __( 'Layout', 'pierogi' ),
		'priority' => 100,
	] );

	$wp_customize->add_setting( 'theme_layout', [
		'default'           => pierogi_get_theme_mod_default( 'theme_layout' ),
		'type'              => 'theme_mod',
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_theme_layout',
	] );

	$wp_customize->add_control( 'theme_layout_control', [
		'section'  => 'pierogi_layout',
		'settings' => 'theme_layout',
		'type'     => 'radio',
		'label'    => __( 'Layout', 'pierogi' ),
		'choices'  => [
			'no-sidebar'  => __( 'No Sidebar', 'pierogi' ),
			'has-sidebar' => __( 'With Sidebar', 'pierogi' ),
		],
	] );

	$wp_customize->add_setting( 'blog_layout', [
		'default'           => pierogi_get_theme_mod_default( 'blog_layout' ),
		'type'              => 'theme_mod',
		'sanitize_callback' => 'pierogi_sanitize_theme_mod_blog_layout',
	] );

	$wp_customize->add_control( 'blog_layout_control', [
		'section'  => 'pierogi_layout',
		'settings' => 'blog_layout',
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
 * Theme Mod sanitization callback
 *
 * @param  mixed $value Value to sanitize.
 * @return mixed
 */
function pierogi_sanitize_theme_mod_colors( $value ) {
	if ( is_array( $value ) ) {
		foreach ( $value as &$val ) {
			$val = pierogi_sanitize_theme_mod_colors( $val );
		}

		return $value;
	}

	return sanitize_hex_color( $value );
}

/**
 * Theme Mod sanitization callback
 *
 * @param  int $value Value to sanitize.
 * @return int
 */
function pierogi_sanitize_theme_mod_footer_logo( $value ) {
	return (int) $value;
}

/**
 * Theme Mod sanitization callback
 *
 * @param  string $value Value to sanitize.
 * @return string
 */
function pierogi_sanitize_theme_mod_footer_text( $value ) {
	return sanitize_textarea_field( esc_html( $value ) );
}

/**
 * Theme Mod sanitization callback
 *
 * @param  string $value Value to sanitize.
 * @return string
 */
function pierogi_sanitize_theme_mod_theme_layout( $value ) {
	return in_array( $value, [ 'no-sidebar', 'has-sidebar' ], true ) ? $value : 'has-sidebar';
}

/**
 * Theme Mod sanitization callback
 *
 * @param  string $value Value to sanitize.
 * @return string
 */
function pierogi_sanitize_theme_mod_blog_layout( $value ) {
	return in_array( $value, [ 'grid', 'list' ], true ) ? $value : 'list';
}

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
function pierogi_customize_controls_js() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'pierogi-customize-controls', get_theme_file_uri( 'js/customize-controls.min.js' ), [ 'wp-color-picker' ], pierogi_get_version(), true );
}
add_action( 'customize_controls_enqueue_scripts', 'pierogi_customize_controls_js' );

/**
 * Add customize preview js.
 */
function pierogi_customize_preview_js() {
	wp_enqueue_script( 'pierogi-customize-preview', get_theme_file_uri( 'js/customize-preview.min.js' ), [ 'customize-preview' ], pierogi_get_version(), true );

	wp_localize_script( 'pierogi-customize-preview', 'Pierogi', [
		'colors' => [
			'accent'    => pierogi_get_accent_selectors(),
			'light'     => pierogi_get_accent_light_selectors(),
			'secondary' => pierogi_get_secondary_selectors(),
		],
	] );
}
add_action( 'customize_preview_init', 'pierogi_customize_preview_js' );

/**
 * Customizer defaults
 *
 * @return array
 */
function pierogi_get_theme_mods_defaults() {
	$defaults = [
		'theme_layout' => 'no-sidebar',
		'blog_layout'  => 'grid',
		'footer_text'  => '© %year% All Rights Reserved. Pierogi by BracketSpace. Proudly powered by WordPress',
		'colors'       => [
			'accent'    => '#ffc33a',
			'light'     => '#ffd983',
			'secondary' => '#ff8787',
		],
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
