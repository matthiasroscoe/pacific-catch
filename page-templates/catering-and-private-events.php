<?php 
/* Template Name: Catering & Private Events */

get_header(); 
?>

<!-- Hero Video -->
<?php 
    $data = get_field('hero')['hero'];
    render_module('hero', $data); 
?>

<!-- Introduction -->
<?php
    $data = get_field('intro')['intro'];
    render_module('intro', $data);
?>


<!-- Catering -->
<?php
    $data = get_field('catering')['content_image'];
    render_module('content_image', $data);
?>


<!-- Private Events -->
<?php
    $data = get_field('priv_events')['content_image'];
    render_module('content_image', $data);
?>


<!-- Three Columns -->
<?php
    $data = get_field('three_cols')['three_cols'];
    render_module('three_cols', $data);
?>

<?php get_footer(); ?>