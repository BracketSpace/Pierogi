<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pierogi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pierogi' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-top-section">
			<div class="site-branding
			<?php
			if ( ! has_custom_logo() ) {
				echo 'site-branding-text'; }
			?>
			">

			<?php

			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo '<a href="' . esc_url( get_home_url() ) . '">';
				?>
					<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
					<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
				<?php
			}
					echo '</a>';
			?>

		</div><!-- .site-branding -->
		<div class="navigation-container">
			<nav id="site-navigation" class="main-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-1',
						'menu_id'         => 'primary-menu',
						'container_class' => 'header-menu-container',
						'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
						'depth'           => 2,
						'walker'          => new Pierogi_Primary_Menu_Nav_Walker(),
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<button class="toggle-header-modal search-button" aria-controls="search-modal" aria-expanded="false" data-toggle-element="header-search">
				<svg height="20.121" viewBox="0 0 20.121 20.121" width="20.121" xmlns="http://www.w3.org/2000/svg"><title><?php esc_html_e( 'Open search form', 'pierogi' ); ?></title><g stroke="#868e96" stroke-width="3"><g fill="#fff"><circle cx="8.101" cy="8.101" r="8.101" stroke="none"/><circle cx="8.101" cy="8.101" fill="none" r="6.601"/></g><path d="m14.391 14.391 3.609 3.609" fill="none" stroke-linecap="round"/></g></svg>
			</button>
		</div>
		<button id="mobile-menu-button" class="mobile-menu-button">
			<span></span>
			<span></span>
			<span></span>
		</button>
		</div>
		<div id="header-submenu" class="header-big-section header-submenu">

		</div>
		<div id="header-search" class="header-big-section header-search">
			<div class="search-form">
				<span><?php esc_html_e( 'Search', 'pierogi' ); ?></span>

				<?php get_search_form(); ?>

			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
