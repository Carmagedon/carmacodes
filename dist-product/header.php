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

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">
    <nav class="navbar-primary">
        <a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
        <ul class="navbar-primary-menu">
            <li>
                <a href="#"><span class="glyphicon glyphicon-list-alt"></span><span class="nav-label">Dashboard</span></a>
                <a href="#"><span class="glyphicon glyphicon-envelope"></span><span class="nav-label">Profile</span></a>
                <a href="#"><span class="glyphicon glyphicon-cog"></span><span class="nav-label">Settings</span></a>
                <a href="#"><span class="glyphicon glyphicon-film"></span><span class="nav-label">Notification</span></a>
                <a href="#"><span class="glyphicon glyphicon-calendar"></span><span class="nav-label">Monitor</span></a>
            </li>
        </ul>
    </nav>