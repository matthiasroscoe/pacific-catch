<?php
/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', 'enqueue_css_js' );

function enqueue_css_js() {
	// Enqueue main stylesheet.
	wp_enqueue_style( 'pc-styles', get_template_directory_uri() . '/library/dist/css/styles.min.css?debug='.date('U') );
	
	// Enqueue main js file.
	wp_enqueue_script( 'pc-js', get_template_directory_uri() . '/library/dist/js/main.min.js?debug='.date('U'), array('jquery'), '', true );
	wp_localize_script( 'pc-js', 'script_vars', array(
		'geocode_url' => 'https://maps.googleapis.com/maps/api/geocode/json?',
		'maps_api_key' => get_field('google_maps_api', 'option'),
		'ajaxUrl' => admin_url('admin-ajax.php'),
	));

	// Google Maps API js
	$api_key = get_field('google_maps_api', 'option');
	if ( is_archive() || ( is_single() && 'location' == get_post_type() ) ) {
		wp_enqueue_script( 'google-maps', "https://maps.googleapis.com/maps/api/js?key=${api_key}&callback=initMap", array('jquery'), '', true);
	}
}

?>