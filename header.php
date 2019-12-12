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

	<?php
	$pierogi_header_class = 'site-header';

	if ( ! has_custom_logo() && get_bloginfo( 'description' ) ) {
		$pierogi_header_class .= ' large';
	}
	?>

	<header id="masthead" class="<?php echo esc_attr( $pierogi_header_class ); ?>">
		<div class="header-inner">
			<div class="container">
				<div class="site-branding">

					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a class="site-branding-text" href="<?php echo esc_url( home_url() ); ?>">
							<h1><?php bloginfo( 'name' ); ?></h1>
							<?php if ( get_bloginfo( 'description' ) ) : ?>
								<p><?php bloginfo( 'description' ); ?></p>
							<?php endif; ?>
						</a>
					<?php endif; ?>

				</div><!-- .site-branding -->

				<div class="navigation-container">
					<nav id="site-navigation" class="main-navigation">
						<span id="menu-container-shadow-left" class="navigation-shadow navigation-shadow-left"></span>
						<span id="menu-container-shadow-right" class="navigation-shadow navigation-shadow-right"></span>
						<?php
						wp_nav_menu( [
							'theme_location'  => 'primary',
							'menu_id'         => 'primary-menu',
							'container_class' => 'main-menu-wrap',
							'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
							'depth'           => 2,
							'fallback_cb'     => 'pierogi_no_menu_warning',
						] );
						?>
					</nav><!-- #site-navigation -->
					<button class="toggle-header-modal search-button" aria-controls="search-modal" aria-expanded="false" data-toggle-element="header-search">
						<svg xmlns="http://www.w3.org/2000/svg" width="20.121" height="20.121" viewBox="0 0 20.121 20.121"><g transform="translate(-1014 -174)"><g transform="translate(1014 174)" fill="#fff" stroke="#868e96" stroke-width="3"><circle cx="8.101" cy="8.101" r="8.101" stroke="none"/><circle cx="8.101" cy="8.101" r="6.601" fill="none"/></g><line x2="3.609" y2="3.609" transform="translate(1028.391 188.391)" fill="none" stroke="#868e96" stroke-linecap="round" stroke-width="3"/></g></svg>
					</button>
				</div>

				<button id="mobile-menu-button" class="mobile-menu-button">
					<span></span>
					<span></span>
					<span></span>
				</button>

			</div>
		</div><!-- .header-inner -->

		<div id="header-search" class="header-big-section header-search">
			<div class="search-form">
				<span><?php esc_html_e( 'Search', 'pierogi' ); ?></span>

				<?php get_search_form(); ?>

			</div>
		</div>


		<nav id="site-navigation-mobile" class="main-navigation-mobile">
			<?php
			$pierogi_mobile_location = has_nav_menu( 'mobile' ) ? 'mobile' : 'primary';

			wp_nav_menu( [
				'theme_location'  => $pierogi_mobile_location,
				'menu_id'         => 'mobile-menu',
				'container_class' => 'mobile-menu-wrap',
				'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
				'depth'           => 2,
				'mobile'          => true,
			] );
			?>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
