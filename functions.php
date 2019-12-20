<?php
/**
 * Pierogi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pierogi
 */

if ( ! function_exists( 'pierogi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pierogi_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pierogi, use a find and replace
		 * to change 'pierogi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pierogi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'pierogi' ),
				'mobile'  => esc_html__( 'Mobile', 'pierogi' ),
				'footer'  => esc_html__( 'Footer Menu', 'pierogi' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			[
				'height'      => 48,
				'width'       => 133,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add editor styles support.
		add_theme_support( 'editor-styles');

		// Add editor styles.
		add_editor_style( 'style-editor.css' );

		// Register image size for posts list.
		add_image_size( 'post-list', 521, 348, true );

		// Register image size for post header.
		add_image_size( 'post-header', 1270, 846, true );

		// Add excerpt support for pages.
		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'after_setup_theme', 'pierogi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pierogi_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pierogi_content_width', 640 );
}
add_action( 'after_setup_theme', 'pierogi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pierogi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pierogi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pierogi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'pierogi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pierogi_scripts() {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style( 'pierogi-style', get_stylesheet_uri(), array(), $version );

	wp_enqueue_script( 'pierogi-script', get_template_directory_uri() . '/js/main.js', [ 'wp-i18n' ], $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Register js script translations
	 */
	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'pierogi-script', 'pierogi' );
	}
}
add_action( 'wp_enqueue_scripts', 'pierogi_scripts' );

/**
 * Enqeues block editor scripts
 */
function pierogi_enqueue_block_editor_scripts() {
	wp_enqueue_script( 'pierogi-editor-script', get_stylesheet_directory_uri() . '/js/editor.js', [ 'wp-data' ], filemtime( get_stylesheet_directory() . '/js/editor.js' ), true );
}

add_action( 'enqueue_block_editor_assets', 'pierogi_enqueue_block_editor_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Implement the custom styles.
 */
require get_template_directory() . '/inc/custom-colors.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'walker_nav_menu_start_el', function( $item_output, $item, $depth, $args ) {
	if ( isset( $args->mobile ) && $args->mobile && 0 === $depth ) {
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$item_output .= '<button class="mobile-submenu-button"></button>';
		}

		$item_output = sprintf( '<div class="item-wrap">%s</div>', $item_output );
	}

	return $item_output;
}, 10, 4 );
