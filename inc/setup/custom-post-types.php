<?php

/* Hiding default 'post' post type categories */
add_action('admin_menu','remove_post_cat_menu');
function remove_post_cat_menu() {
    remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
}

/* Locations post type */
add_action( 'init', 'location_post_type' );

function location_post_type() {
    $labels = array(
        'name'               => _x( 'Locations', 'post type general name', 'pac-catch' ),
        'singular_name'      => _x( 'Location', 'post type singular name', 'pac-catch' ),
        'menu_name'          => _x( 'Locations', 'admin menu', 'pac-catch' ),
        'name_admin_bar'     => _x( 'Location', 'add new on admin bar', 'pac-catch' ),
        'add_new'            => _x( 'Add New', 'menu', 'pac-catch' ),
        'add_new_item'       => __( 'Add New Location', 'pac-catch' ),
        'new_item'           => __( 'New Location', 'pac-catch' ),
        'edit_item'          => __( 'Edit Location', 'pac-catch' ),
        'view_item'          => __( 'View Location', 'pac-catch' ),
        'all_items'          => __( 'All Locations', 'pac-catch' ),
        'search_items'       => __( 'Search Locations', 'pac-catch' ),
        'parent_item_colon'  => __( 'Parent Locations:', 'pac-catch' ),
        'not_found'          => __( 'No locations found.', 'pac-catch' ),
        'not_found_in_trash' => __( 'No locations found in Trash.', 'pac-catch' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Locations', 'pac-catch' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'locations' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-store',
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'location', $args );
}



/* Locations post type */
add_action( 'init', 'menu_post_type' );

function menu_post_type() {
    $labels = array(
        'name'               => _x( 'Menu Items', 'post type general name', 'pac-catch' ),
        'singular_name'      => _x( 'Menu Item', 'post type singular name', 'pac-catch' ),
        'menu_name'          => _x( 'Menu Items', 'admin menu', 'pac-catch' ),
        'name_admin_bar'     => _x( 'Menu', 'add new on admin bar', 'pac-catch' ),
        'add_new'            => _x( 'Add New Item', 'menu', 'pac-catch' ),
        'add_new_item'       => __( 'Add New Item', 'pac-catch' ),
        'new_item'           => __( 'New Item', 'pac-catch' ),
        'edit_item'          => __( 'Edit Item', 'pac-catch' ),
        'view_item'          => __( 'View Item', 'pac-catch' ),
        'all_items'          => __( 'All Menu Items', 'pac-catch' ),
        'search_items'       => __( 'Search Menu Items', 'pac-catch' ),
        'parent_item_colon'  => __( 'Parent Items:', 'pac-catch' ),
        'not_found'          => __( 'No items found.', 'pac-catch' ),
        'not_found_in_trash' => __( 'No items found in Trash.', 'pac-catch' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Menu Items', 'pac-catch' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'menu-items' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-clipboard',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    register_post_type( 'menu_items', $args );
}
?>