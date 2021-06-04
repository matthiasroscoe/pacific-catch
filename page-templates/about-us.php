<?php
/* Template Name: About Us */

get_header();
?>

<!-- Hero -->
<?php
    $data = get_field('hero')['hero'];
    render_module('hero', $data);
?>


<!-- Introduction -->
<?php $data = get_field('intro')['intro']; ?>
<?php if (! $data['intro_off']) : ?>
    <section <?php echo $id_string; ?> class="intro intro--advanced intro--about">
        <img class="intro__top" src="<?php images_folder(); ?>borders/top_yellow.svg">
        <div class="intro-container | container-fluid u-px-mobile-30">

            <img src="<?php images_folder(); ?>icons/west-coast-stamp.png" class="intro--about__wc-stamp | u-pos-abs js-prlx--rotate" loading="lazy">
            <img src="<?php images_folder(); ?>icons/maui-stamp.png" class="intro--about__maui-stamp | u-pos-abs js-prlx--rotate" loading="lazy">
            <img src="<?php images_folder(); ?>icons/hawaii-map.png" class="intro--about__map | u-pos-abs js-prlx--rotate" loading="lazy">

            <div class="row justify-content-center js-hidden">
                <div class="text-center col-lg-7">
                    <?php if ( $data['title'] ) : ?>
                        <h2 class="intro__title"><?php echo $data['title']; ?></h2>
                    <?php endif; ?>

                    <img class="intro--about__tagline" src="<?php images_folder(); ?>spirit-of-adventure.svg" alt="Spirit of Adventure">
                    
                    <?php if ( $data['content'] ) : ?>
                        <div class="intro__content | c-wysiwyg"><?php echo $data['content'] ?></div>
                    <?php endif; ?>

                    <?php 
                        if ( $data['button'] ) {
                            render_svg_button($data['button']['url'], $data['button']['title'], 'big', 'blue', 'white', null, $data['button']['target']);
                        }
                    ?>
                </div>
            </div>
        </div>
        <img src="<?php images_folder(); ?>leaf_1.png" class="intro__leaf | js-prlx" loading="lazy">
        <img class="intro__bottom" src="<?php images_folder(); ?>borders/bottom_yellow.svg">
    </section>
<?php endif; ?>


<!-- About Us -->
<?php 
    $data = get_field('about_us_1')['content_image'];
    render_module('content_image', $data, 'about-us-1');

    $data = get_field('about_us_2')['content_image'];
    render_module('content_image', $data, 'about-us-2');
?>


<!-- Our Partners -->
<?php 
    $data = get_field('partners_1')['content_image'];
    render_module('content_image', $data, 'partners-1');

    $data = get_field('partners_2')['content_image'];
    render_module('content_image', $data, 'partners-2');

    $data = get_field('partners_3')['content_image'];
    render_module('content_image', $data, 'partners-3');
?>


<!-- Ocean Lovers -->
<?php 
    $data = get_field('about_us_3')['content_image'];
    render_module('content_image', $data, 'ocean-lovers');
?>


<?php get_footer(); ?>