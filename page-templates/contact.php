<?php
/* Template Name: Contact */

get_header(); 
?>

<!-- Hero -->
<?php
    $data = get_field('top_banner_menu')['top_banner'];
    render_module('top_banner', $data);
?>


<?php if (! get_field('intro_off') ) : ?>
    <section class="intro">
        <img class="intro__top" src="<?php images_folder(); ?>borders/top_white.svg">
        <div class="intro-container | container-fluid u-px-mobile-30">
            <div class="row justify-content-center">
                <div class="text-center col-lg-7">
                    <?php if ( get_field('intro_title') ) : ?>
                        <h2 class="intro__title"><?php the_field('intro_title'); ?></h2>
                    <?php endif; ?>

                    <div class="intro__contact-info">
                        <?php if (get_field('email_address', 'option')) : ?>
                            <div>
                                <h3>Drop us a line</h3>
                                <a href="mailto:<?php the_field('email_address', 'option'); ?>" target="_blank"><?php the_field('email_address', 'option'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <img class="intro__bottom" src="<?php images_folder(); ?>borders/bottom_white.svg">
    </section>
<?php endif; ?>


<?php if (! get_field('forms_off')) : ?>
    <section class="contact-tabs">
        <div class="contact-tabs__tabs | u-pos-rel">
            <a href="#" class="tab is-active | js-contact-tab" data-tab-index="1">General Inquiries</a>
            <a href="#" class="tab | js-contact-tab" data-tab-index="2">Catering & Private Events Inquiries</a>
            <!-- <div class="js-tab-select"></div> -->
        </div>
        <div class="contact-tabs__forms">
            <div class="js-form-container is-active | container" data-tab-index="1">
                <div class="row">
                    <div class="c-form col-xl-10 offset-xl-1">
                        <?php echo do_shortcode('[contact-form-7 id="899" title="General Enquiries"]'); ?>
                        <?php render_svg_button('#', 'Submit', 'big', 'blue', 'white'); ?>
                    </div>
                </div>
            </div>
            <div class="js-form-container container" data-tab-index="2">
                <div class="row">
                    <div class="c-form col-xl-10 offset-xl-1">
                        <?php echo do_shortcode('[contact-form-7 id="362" title="Catering"]'); ?>
                        <?php render_svg_button('#', 'Submit', 'big', 'blue', 'white'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php /* if (! get_field('locations_contact_off')) : ?>
    <img src="<?php images_folder(); ?>top_yellow.svg" class="loc-contact-info__top | d-block">
    <section class="loc-contact-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-xl-1">
                    <h1 class="loc-contact-info__title"><?php the_field('loc_contact_title'); ?></h1>
                    <?php render_wave_divider('blue'); ?>
                    <?php if (get_field('loc_contact_title')) : ?>
                        <p><?php the_field('loc_contact_title'); ?></p>
                    <?php endif; ?>

                    <label for="loc-contact">Location</label>
                    <select name="loc-contact" class="loc-contact-info__select | js-selectric">
                        <?php // Display option for each published location
                            $args = array(
                                'post_type' => 'location',
                                'post_status' => 'publish',
                                'numberposts' => -1,
                            );

                            $locations = get_posts($args);

                            var_dump($locations);


                        ?>
                    </select>

                </div>
            </div>
        </div>
    </section>
    <img src="<?php images_folder(); ?>bottom_yellow.svg" class="loc-contact-info__bottom | d-block">
<?php endif;*/ ?>


<!-- Book a Table -->
<?php
    $data = get_field('cta')['call_to_action'];
    render_module('call_to_action', $data);
?>


<?php get_footer(); ?>