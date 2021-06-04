<?php
if ( ! function_exists( 'custom_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this, use a find and replace
		 * to change the theme name referenced here to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pac_catch', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pac_catch' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	}
endif;
add_action( 'after_setup_theme', 'custom_theme_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edit_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'edit_content_width', 640 );
}
add_action( 'after_setup_theme', 'edit_content_width', 0 );



/**
 * Add ACF Options page
 */
add_action('init', 'setup_options');

function setup_options() {

 	if(function_exists('acf_add_options_page')) {
	 	$parent = acf_add_options_page(array(
			'page_title'  => 'Site Settings',
			'menu_title'  => 'Site Settings',
			'menu_slug'   => 'options',
			'capability'  => 'manage_options',
			'redirect'    => true,
   		));
	 }
	 
	if( function_exists('acf_add_options_page') ) {
		$locations = acf_add_options_page(array(
			'page_title'  => 'Locations Settings',
			'menu_title'  => 'Locations Settings',
			'position'    => 6,
		));
	}

	// if( function_exists('acf_add_options_page') ) {
	// 	$menu = acf_add_options_page(array(
	// 		'page_title'  => 'Menu Settings',
	// 		'menu_title'  => 'Menu Settings',
	// 		'position'    => 7,
	// 	));
	// }

	if( function_exists('acf_add_options_sub_page') ) {
		$child = acf_add_options_sub_page(array(
			'page_title'  => 'Dev Settings',
			'menu_title'  => 'Dev Settings',
			'parent_slug' => $parent['menu_slug'],
		));
	}
}

/**
 * Link Google Maps API Key with ACF
 */

add_filter('acf/fields/google_map/api', 'acf_google_map_api');

function acf_google_map_api( $api ){
	$api['key'] = get_field('google_maps_api', 'option');
	return $api;
}



/**
 * Image sizes
 */

add_image_size('service', 256, 256, false);
add_image_size('image-grid--small', 120, 120, false);
add_image_size('three-cols', 400, 360, false);
add_image_size('hero-dish', 600, 500, false);
add_image_size('half-width', 700, 700, false);
add_image_size('max-grid', 1200, 600, false);
add_image_size('locations-thumb', 242, 242, false);




/**
 * Admin Bar Tweak. 
 * 
 * This changes the default CSS added by WordPress to place the admin bar margin in 
 * the body element instead of the html element.
 */

add_theme_support( 'admin-bar', array( 'callback' => 'my_admin_bar_css') );

function my_admin_bar_css() { ?>
	<style type="text/css" media="screen">	
		html , html body { margin-top: 0 !important; }
	</style>
<?php } 
?>