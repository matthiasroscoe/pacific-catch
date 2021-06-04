<?php 
/* Template Name: Private Events */

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


<!-- Services -->
<?php
    $data = get_field('services')['services'];
    render_module('services', $data);
?>


<!-- Content Block -->
<?php
    $data = get_field('content_image')['content_image'];
    render_module('content_image', $data);
?>


<!-- Contact Form -->
<?php if ( ! get_field('contact_off') ) : ?> 
    <section class="contact">
        <img src="<?php images_folder(); ?>borders/top_form_brown.svg" alt="" class="contact__top">
        <div class="contact__inner">
            <h1 class="contact__title"><?php the_field('form_title'); ?></h1>
            <div class="container">
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


<!-- Our Partners -->
<?php
    $data = get_field('our_partners')['our_partners'];
    render_module('our_partners', $data);
?>


<!-- Catering -->
<?php
    $data = get_field('catering')['content_image'];
    render_module('content_image', $data);
?>

<?php get_footer(); ?>