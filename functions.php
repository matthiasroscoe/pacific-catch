<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Theme Setup
require('inc/setup/theme-setup.php');

// Enqueues
require('inc/setup/enqueues.php');

// Template Tags
require(get_template_directory() . '/inc/template-tags.php');

// Misc Template Functions
require(get_template_directory() . '/inc/template-functions.php');

// Locations Functions
require(get_template_directory() . '/inc/locations-functions.php');

// Menu Functions
require(get_template_directory() . '/inc/menu-functions.php');

// Blog Functions
require(get_template_directory() . '/inc/blog-functions.php');

// Custom Post Types & Custom Taxonomies
require(get_template_directory() . '/inc/setup/custom-post-types.php');
require(get_template_directory() . '/inc/setup/custom-taxonomies.php');
?>