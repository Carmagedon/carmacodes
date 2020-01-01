<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://cdn.carmacodes.sk">
    <link href="https://cdn.carmacodes.sk" rel="preconnect" crossorigin>
    <link href="https://www.google-analytics.com" rel="preconnect" crossorigin>
    <link href="https://www.googletagmanager.com" rel="preconnect" crossorigin>
    <link rel="shortcut icon" href="<?php echo home_url() ?>/favicon.ico">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <link rel="preload" as="image" href="<?php echo content_url(); ?>/uploads/carma.webp">
    <link rel="preload" as="font" type="font/woff2" crossorigin="anonymous" href="<?php echo get_stylesheet_directory_uri() ?>/fonts/roboto-v20-latin-ext_latin-regular.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin="anonymous" href="<?php echo get_stylesheet_directory_uri() ?>/fonts/roboto-v20-latin-ext_latin-500.woff2">
    <link rel="preload" as="font" type="font/woff2" crossorigin="anonymous" href="<?php echo get_stylesheet_directory_uri() ?>/fonts/roboto-v20-latin-ext_latin-700.woff2">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-100593486-8"></script>
    <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-100593486-8');
    </script>
    <?php wp_head(); ?>

<body <?php body_class(); ?>>

<header>

    <!-- The WordPress Menu goes here -->
	<?php wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container' => '',
			'menu_class'      => 'sidenav sidenav-fixed',
			'fallback_cb'     => '',
			'menu_id'         => 'slide-out',
			'depth'           => 2,
			'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
		)
	); ?>
    <div class="mobile-menu">
        <ul>
            <li>
                <a class="mobile-menu__item" href="#o-mne">
                    <i class="material-icons small">accessibility</i>
                    O mne
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#o-zrucnosti">
                    <i class="material-icons">straighten</i>
                    Zručnosti
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#portfolio">
                    <i class="material-icons">code</i>
                    Portfólio
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#contact">
                    <i class="material-icons">contact_mail</i>
                    Kontakt
                </a>
            </li>
        </ul>
    </div>
</header>
