<?php 
/* Template Name: Our Food */

get_header();
?>


<!-- Hero -->
<?php
    $data = get_field('hero')['hero'];
    render_module('hero', $data);
?>


<!-- Our Menu -->
<?php 
    $data = get_field('content_image')['content_image'];
    render_module('content_image', $data, 'our-menu');
?>


<!-- Fresh Catch -->
<?php 
    $data = get_field('fresh_catch')['content_image'];
    render_module('content_image', $data);
?>


<!-- Promises -->
<?php
    $data = get_field('promises')['img_grid_small'];
    render_module('img_grid_small', $data);
?>


<!-- Our Sources -->
<?php
    $data = get_field('our_sources')['three_cols'];
    render_module('three_cols', $data);
?>


<!-- Health Benefits -->
<?php if ( ! get_field('hb_off') ) : ?>
    <section class="health-benefits">
        <?php if (get_field('hb_title')) : ?>
            <h1 class="health-benefits__title"><?php the_field('hb_title'); ?></h1>
        <?php endif; ?>

        <img src="<?php images_folder(); ?>borders/top_white.svg" class="health-benefits__top">
        <div class="container-fluid">
            <?php if (get_field('hb_subheading')) : ?>
                <h2 class="hb__subheading"><?php the_field('hb_subheading'); ?></h2>
            <?php endif; ?>

            <?php if (get_field('hb_text')) : ?>
                <div class="hb__text c-wysiwyg"><?php the_field('hb_text'); ?></div>
            <?php endif; ?>
        </div>
        <img src="<?php images_folder(); ?>borders/top_white.svg" class="health-benefits__bottom">

        <img src="<?php images_folder(); ?>leaf--rewards.png" class="hb__leaf" loading="lazy">
    </section>
<?php endif; ?>


<!-- Fish -->
<?php 
    $data = get_field('fishes')['img_grid_big'];
    render_module('img_grid_big', $data);
?>


<!-- FAQs -->
<?php
    $data = get_field('questions')['faqs'];
    render_module('faqs', $data);
?>


<!-- Our Menus CTA -->
<?php
    $data = get_field('our_menus')['call_to_action'];
    render_module('call_to_action', $data);
?>


<?php get_footer(); ?>