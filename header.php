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
                    <i class="material-icons small"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2zm9 7h-6v13h-2v-6h-2v6H9V9H3V7h18v2z"/></svg></i>
                    O mne
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#o-zrucnosti">
                    <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M21 6H3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 10H3V8h2v4h2V8h2v4h2V8h2v4h2V8h2v4h2V8h2v8z"/></svg></i>
                    Zručnosti
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#portfolio">
                    <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg></i>
                    Portfólio
                </a>
            </li>
            <li>
                <a class="mobile-menu__item" href="#contact">
                    <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M21 8V7l-3 2-3-2v1l3 2 3-2zm1-5H2C.9 3 0 3.9 0 5v14c0 1.1.9 2 2 2h20c1.1 0 1.99-.9 1.99-2L24 5c0-1.1-.9-2-2-2zM8 6c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H2v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1zm8-6h-8V6h8v6z"/><path d="M0 0h24v24H0z" fill="none"/></svg></i>
                    Kontakt
                </a>
            </li>
        </ul>
    </div>
</header>
