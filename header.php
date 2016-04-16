<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Geekhub-exam
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'gh_exam' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="wrapper">
		<div class="site-branding">
            <h1 class="logo-wrapper">
                <!-- LOGO -->
                <a class="logo" href="<?php bloginfo('url'); ?>">
                    <?php if (get_theme_mod('geekhub_logo')) :
                        echo '<img src="' . esc_url(get_theme_mod('geekhub_logo')) . '">';
                    else:
                        echo get_bloginfo('name') . '<span>' . get_bloginfo('description') . '</span>';
                    endif; ?>
                </a>
            </h1>
            <span class="site-phone"><span class="fa fa-phone"></span><?php echo get_theme_mod('phone', ''); ?></span>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gh_exam' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
            </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
