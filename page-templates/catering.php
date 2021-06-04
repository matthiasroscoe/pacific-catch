<?php 
/* Template Name: Catering */

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

<!-- Menus --> 
<?php 
    $data = get_field('menu_1')['content_image'];
    render_module('content_image', $data, 'menu-1');

    $data = get_field('menu_2')['content_image'];
    render_module('content_image', $data, 'menu-2');

    $data = get_field('menu_3')['content_image'];
    render_module('content_image', $data, 'menu-3');
?>


<!-- Catering Services -->
<?php
    $data = get_field('services')['services'];
    render_module('services', $data);
?>


<!-- Contact -->
<?php if (! get_field('contact_off')) :?>
    <section class="contact">
        <img src="<?php images_folder(); ?>borders/top_form_brown.svg" alt="" class="contact__top">
        <div class="contact__inner | u-px-mobile-15">
            <h1 class="contact__title js-hidden"><?php the_field('form_title'); ?></h1>
            <div class="container js-hidden">
                <div class="row">
                    <div class="c-form col-lg-10 offset-lg-1">
                        <?php echo do_shortcode('[contact-form-7 id="362" title="Catering"]'); ?>
                        <?php render_svg_button('#', 'Submit', 'big', 'blue', 'white'); ?>
                    </div>
                </div>
            </div>
        </div>
        <img src="<?php images_folder(); ?>borders/bottom_form_brown.svg" alt="" class="contact__bottom">
    </section>
<?php endif; ?>


<!-- Online Orders call to action -->
<?php
    $data = get_field('call_to_action')['call_to_action'];
    render_module('call_to_action', $data);
?>


<!-- Private Events -->
<?php 
    $data = get_field('private_events')['content_image'];
    render_module('content_image', $data, 'con-img');
?>


<?php get_footer(); ?>