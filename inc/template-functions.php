<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pc_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pc_body_classes' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pc_pingback_header' );


/**
 * Returns the path to the compressed images folder
 * @return string
 */

function images_folder() {
	echo get_stylesheet_directory_uri() . '/library/images/compressed/';
};


/**
 * Moves YOAST panel to bottom when editing posts/pages/etc
 */

 function yoasttobottom() {
   return 'low';
 }
 add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/**
 * Get module from /modules directory and pass in data
 * @param string. Module file name (exl. suffix)
 * @param array. Data to use in module
 * @param string. ID selector for parent module element.
 */

function render_module($module, $data = null, $id = null) {

	// Check if module and data both passed
	if( empty($module) || $data == null ) {
		return false;
	}
	else {
		$module = get_stylesheet_directory() . '/modules/' . $module . '.php';
	}

	// If id exists, create id attribute string
	$id_string = '';
	if( $id !== null ) {
		$id_string = 'id="' . $id . '" ';
	}

	if(! file_exists($module) ) {
		echo 'module does not exist';
		return false;
	}
	else {
		include($module);
		return true;
	}

}

?>