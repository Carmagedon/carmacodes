<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		//$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme-opt.min.css' );
		wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );
		//wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme-opt.min.css', array(), $css_version );

		wp_dequeue_script('jquery');


		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-custom.js' );
		$jss_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		wp_localize_script( 'understrap-scripts', 'ajax_object',
			array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'errtext' => get_field('err_text','option'),
				'suctext' => get_field('suc_text','option'),
			)
		);
		if(get_post_type() === 'portfolio')
		{
			wp_enqueue_script( 'carma-gallery', get_template_directory_uri() . '/js/single-portfolio.js', array(), '', true );
		}

	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
