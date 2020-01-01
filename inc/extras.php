<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'body_class', 'understrap_body_classes' );

if ( ! function_exists( 'understrap_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function understrap_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'understrap_adjust_body_class' );

if ( ! function_exists( 'understrap_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function understrap_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'understrap_change_logo_class' );

if ( ! function_exists( 'understrap_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function understrap_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */

if ( ! function_exists ( 'understrap_post_nav' ) ) {
	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'understrap' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'understrap' ) );
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

/**
 * Add a pingback url auto-discovery header for single posts of any post type.
 */
function understrap_pingback() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'understrap_pingback' );


function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

function new_nav_menu_items($items, $args)
{

	if( $args->theme_location == 'primary' )
	{
		if ( ! has_custom_logo() ) { ob_start(); ?>
            <li class="logo">
                <a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="brand-logo"><span class="title"><?php echo get_field('title', 'option'); ?></span><span class="sub-title"><?php echo get_field('sub_-_title', 'option'); ?></span></a>
            </li>
			<?php $logo = ob_get_contents(); ob_clean(); ?>
		<?php } else {
			the_custom_logo();
		}
		$items = $logo . $items;
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();
}

if (!is_admin()) {
	if( preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING']) ) {
		add_filter( 'query_vars', 'iside_remove_author_from_query_vars' );
	}
	add_filter('redirect_canonical', 'iside_remove_author_from_redirects', 10, 2);
}
function iside_remove_author_from_redirects($redirect, $request) {
	if( !is_admin() && preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING']) ) {
		add_filter( 'query_vars', 'iside_remove_author_from_query_vars' );
	}
	return $redirect;
}
function iside_remove_author_from_query_vars( $query_vars ) {
	if( !is_admin() ) {
		foreach( array( 'author', 'author_name' ) as $var ) {
			$key = array_search( $var, $query_vars );
			if ( false !== $key ) {
				unset( $query_vars[$key] );
			}
		}
	}
	return $query_vars;
}

// Register Custom Post Type
function portfolio_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio Type', 'text_domain' ),
		'description'           => __( 'Portfolio Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio_post_type', 0 );
// Register Custom Post Type
function contact_post_type() {

	$labels = array(
		'name'                  => _x( 'Contact form', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Contact form', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Contact form', 'text_domain' ),
		'name_admin_bar'        => __( 'Contact form', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Contact form Type', 'text_domain' ),
		'description'           => __( 'Contact form Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array('title' ),
		'taxonomies'            => array(  ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
	);
	register_post_type( 'contact', $args );

}
add_action( 'init', 'contact_post_type', 0 );
// Register Custom Taxonomy
function portfolio_cats() {

	$labels = array(
		'name'                       => _x( 'Portfolio cats', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Portfolio cat', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Portfolio cats', 'text_domain' ),
		'all_items'                  => __( 'Portfolio cats', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'portfolio-cats', array( 'portfolio' ), $args );

}
add_action( 'init', 'portfolio_cats', 0 );


function contact_form()
{
	$nonce =  check_ajax_referer( 'contact_form', false ,false );

	if($nonce)
    {
        $fl =  sanitize_text_field($_REQUEST['first_name_last_name']);
        $email = sanitize_email($_REQUEST['email']);
        $subject = sanitize_text_field($_REQUEST['subject']);
        $message = sanitize_textarea_field($_REQUEST['message']);

        $post_title = $fl . ' - ' . $email;

	    $post_args = array(
		    'post_title'    => $post_title,
		    'post_status'   => 'draft',
		    'post_author'   => 1,
            'post_type'     => 'contact'
	    );

	    $post_id = wp_insert_post( $post_args, $wp_error );

	    if(!$wp_error)
        {
            update_field('field_5cdb4a5fabd6a', $fl ,$post_id);
            update_field('field_5cdb4a80abd6b', $email ,$post_id);
            update_field('field_5cdb4a87abd6c', $subject, $post_id);
            update_field('field_5cdb4a95abd6d', $message, $post_id);

	        $to = get_field('send__to_email', 'option');
	        $subject = 'Carmacodes.sk - '.$fl;
	        $body = admin_url('/post.php?post='.$post_id.'&action=edit');
	        $headers = array('Content-Type: text/html; charset=UTF-8');

	        wp_mail( $to, $subject, $body, $headers );
	        echo 'ok';
	        wp_die();
        }
        echo 'err';
	    wp_die();
    }
	echo 'err';
	wp_die();
}
add_action( 'wp_ajax_contact_form', 'contact_form' );
add_action( 'wp_ajax_nopriv_contact_form','contact_form' );

/*----------------------- Remove JQuery migrate -------------------------*/
function remove_jquery_migrate($scripts)
{
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) { // Check whether the script has any dependencies
			$script->deps = array_diff($script->deps, array(
				'jquery-migrate'
			));
		}
	}
}

add_action('wp_default_scripts', 'remove_jquery_migrate');


/*----------------------- disable embeded js  -------------------------*/
function disable_embeds_code_init() {

	// Remove the REST API endpoint.
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );

	// Turn off oEmbed auto discovery.
	add_filter( 'embed_oembed_discover', '__return_false' );

	// Don't filter oEmbed results.
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

	// Remove oEmbed discovery links.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

	// Remove oEmbed-specific JavaScript from the front-end and back-end.
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );

	// Remove all embeds rewrite rules.
	add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );

	// Remove filter of the oEmbed result before any HTTP requests are made.
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

add_action( 'init', 'disable_embeds_code_init', 9999 );

function disable_embeds_tiny_mce_plugin($plugins) {
	return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules) {
	foreach($rules as $rule => $rewrite) {
		if(false !== strpos($rewrite, 'embed=true')) {
			unset($rules[$rule]);
		}
	}
	return $rules;
}



/*----------------------- disable emoji -------------------------*/
/**
 * Add mobile-web-app meta.
 */
function understrap_mobile_web_app_meta() {
	echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
	echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
	echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
}
add_action( 'wp_head', 'understrap_mobile_web_app_meta' );


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' == $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

		$urls = array_diff( $urls, array( $emoji_svg_url ) );
	}

	return $urls;
}

/*----------------------- remove wp version -------------------------*/
function remove_version() {
	return '';
}
add_filter('the_generator', 'remove_version');

// disable gutenberg for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable gutenberg for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);
function wpassist_remove_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css' );
// disable xml rpc
add_filter('xmlrpc_enabled', '__return_false');

function webp_upload_mimes($existing_mimes) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');

function shapeSpace_script_loader_tag($tag, $handle) {

	if ($handle === 'understrap-scripts') {

		if (false === stripos($tag, 'defer')) {

			$tag = str_replace('<script ', '<script async ', $tag);

		}

	}

	return $tag;

}
//add_filter('script_loader_tag', 'shapeSpace_script_loader_tag', 10, 2);