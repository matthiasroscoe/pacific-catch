<?php 

/**
 * Menu Type Taxonomy
 * Applied to Menu Items post types
 */

add_action( 'init', 'menu_type_taxonomy', 0 );

function menu_type_taxonomy() {
  $labels = array(
    'name'              => _x( 'Menu Types', 'taxonomy general name', 'pac-catch' ),
    'singular_name'     => _x( 'Menu Type', 'taxonomy singular name', 'pac-catch' ),
    'search_items'      => __( 'Search Menu Types', 'pac-catch' ),
    'all_items'         => __( 'All Menu Types', 'pac-catch' ),
    'edit_item'         => __( 'Edit Menu Type', 'pac-catch' ),
    'parent_item'       => __( 'Menu Type', 'pac-catch' ),
    'parent_item_colon' => __( 'Menu Type:', 'pac-catch' ),
    'update_item'       => __( 'Update Menu Type', 'pac-catch' ),
    'add_new_item'      => __( 'Add New Menu Type', 'pac-catch' ),
    'new_item_name'     => __( 'New Menu Type Name', 'pac-catch' ),
    'menu_name'         => __( 'Menu Types', 'pac-catch' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'menu-types' ),
  );

  register_taxonomy( 'menu_types', array( 'menu_items' ), $args );
}




/**
 * Menu Type Taxonomy
 * Applied to Menu Items post types
 */

add_action( 'init', 'dietary_info_taxonomy', 0 );

function dietary_info_taxonomy() {
  $labels = array(
    'name'              => _x( 'Dietary Info', 'taxonomy general name', 'pac-catch' ),
    'singular_name'     => _x( 'Dietary Info', 'taxonomy singular name', 'pac-catch' ),
    'search_items'      => __( 'Search Dietary Info', 'pac-catch' ),
    'all_items'         => __( 'All Dietary Info', 'pac-catch' ),
    'edit_item'         => __( 'Edit Dietary Info', 'pac-catch' ),
    'parent_item'       => __( 'Dietary Info', 'pac-catch' ),
    'parent_item_colon' => __( 'Dietary Info:', 'pac-catch' ),
    'update_item'       => __( 'Update Dietary Info', 'pac-catch' ),
    'add_new_item'      => __( 'Add New Dietary Info', 'pac-catch' ),
    'new_item_name'     => __( 'New Dietary Info Name', 'pac-catch' ),
    'menu_name'         => __( 'Dietary Info', 'pac-catch' ),
  );

  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'dietary-info' ),
  );

  register_taxonomy( 'dietary_info', array( 'menu_items' ), $args );
}


?>