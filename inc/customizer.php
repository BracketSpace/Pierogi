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
				'height'        => 101,
				'width'         => 36,
				'flex_height'   => true,
				'flex_width'    => true,
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

	$wp_customize->add_setting( 'pierogi_footer_copyright', [
		'capability' => 'edit_theme_options',
		'default'    => '© 2019 All Rights Reserved. Pierogi by BracketSpace.',
		'transport'  => 'postMessage',
	] );

	$wp_customize->add_control( 'pierogi_footer_copyright', [
		'type'        => 'textarea',
		'section'     => 'pierogi_footer',
		'label'       => __( 'Footer Copyright Text', 'pierogi' ),
		'description' => __( 'Enter copyright text', 'pierogi' ),
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
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pierogi_customize_partial_footer_logo() {
	pierogi_footer_logo();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pierogi_customize_preview_js() {
	wp_enqueue_script( 'pierogi-customizer', get_template_directory_uri() . '/js/customizer.js', [ 'customize-preview' ], '1.0.0', true );
}
add_action( 'customize_preview_init', 'pierogi_customize_preview_js' );
