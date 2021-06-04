<?php
/* Template Name: Rewards */

get_header();
?>

<!-- Hero Video -->
<?php 
    $data = get_field('hero')['hero'];
    render_module('hero', $data); 
?>


<!-- Introduction -->
<?php $data = get_field('intro')['intro']; ?>
<section class="intro">
    <img alt="" class="intro__top" src="<?php images_folder(); ?>borders/top_yellow.svg">
    <div class="intro-container | container-fluid  u-px-mobile-30">
        <div class="row justify-content-center js-hidden">
            <div class="text-center col-lg-6">
                <?php if ( $data['title'] ) : ?>
                    <h2 class="intro__title"><?php echo $data['title']; ?></h2>
                <?php endif; ?>

                <?php if ( $data['content'] ) : ?>
                    <div class="intro__content | c-wysiwyg"><?php echo $data['content'] ?></div>
                <?php endif; ?>

                <?php 
                    if ( $data['button'] ) {
                        render_svg_button($data['button']['url'], $data['button']['title'], 'big', 'blue', 'white', 'ga-rewards-sign-up', $data['button']['target']);
                    }
                ?>
            </div>
        </div>
    </div>
    <img alt="" class="intro__bottom" src="<?php images_folder(); ?>borders/bottom_yellow.svg">
    
    <img alt="" src="<?php images_folder(); ?>leaf_1.png" class="intro__leaf js-prlx" loading="lazy">
    <img alt="" src="<?php images_folder(); ?>small-leaf.png" class="intro__leaf-2 js-prlx--early" loading="lazy">
    
    <!-- <img src="<?php images_folder(); ?>icons/rewards-roundel--navy.svg" alt="Pacific Catch Rewards" class="intro__roundel"> -->
    <div class="intro__roundel">
        <img alt="" class="intro__roundel__text | js-rotate-scroll" src="<?php images_folder(); ?>icons/roundel--text-blue.svg" loading="lazy">
        <img alt="" class="intro__roundel__fish" src="<?php images_folder(); ?>icons/fish-blue.svg" loading="lazy">
    </div>

    <?php if ( get_field('intro_image') ) : ?>
        <img src="<?php echo get_field('intro_image')['sizes']['large']; ?> " alt="<?php echo get_field('intro_image')['alt']; ?>" class="intro__image | js-prlx" loading="lazy">
    <?php endif; ?>
</section>


<!-- How it works -->
<section class="how-it-works | u-px-mobile-15 js-hidden">
    <h1 class="how-it-works__title | u-px-mobile-30"><?php the_field('how_it_works_title'); ?></h1>
    <div class="container">
        <div class="row">

            <?php // Display steps
                $step_counter = 1;
                $num_steps = count(get_field('steps'));

                foreach( get_field('steps') as $step ) : 
                    ?>
                        <div class="how-it-works__step | col-lg-4">
                            <h3 class="how-it-works__heading"><?php echo $step['heading']; ?></h3>
                            <img src="<?php echo $step['image']['sizes']['image-grid--small']; ?>" alt="<?php echo $step['text']; ?>" class="how-it-works__icon" loading="lazy">
                            <p class="how-it-works__text"><?php echo $step['text']; ?></p>

                            <?php if ($step_counter != $num_steps) : ?>
                                <img alt="" src="<?php images_folder(); ?>icons/wave-arrow.svg" class="how-it-works__arrow" loading="lazy">
                            <?php endif; ?>
                        </div>
                    <?php 
                $step_counter++;
                endforeach; 
            ?>

        </div>
    </div>
</section>


<!-- What do I get -->
<?php
    $data = get_field('what_do_i_get')['img_grid_small'];
    render_module('img_grid_small', $data);
?>


<!-- Examples -->
<?php 
    $data = get_field('examples')['img_grid_big'];
    render_module('img_grid_big', $data);
?>


<!-- Rewards VIP Program -->
<section class="vip-program">
    <div class="vip-program__container | container js-hidden">
        <div class="row">

            <div class="vip-program__content-col">
                <div class="vip-program__content-inner">

                    <?php if (get_field('vip_subheading')) : ?>
                        <h3 class="vip-program__content-col__subheading"><?php the_field('vip_subheading'); ?></h3>
                    <?php endif; ?>

                    <?php if (get_field('vip_title')) : ?>
                        <h1 class="vip-program__content-col__title"><?php the_field('vip_title'); ?></h1>
                        <?php render_wave_divider('white'); ?>
                    <?php endif; ?>

                    <?php if (get_field('vip_text')) : ?>
                        <p class="vip-program__content-col__text"><?php the_field('vip_text'); ?></p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="vip-program__img-col">
                <img src="<?php echo get_field('vip_image')['sizes']['large']; ?>" alt="<?php echo get_field('vip_image')['alt']; ?>" loading="lazy">
            </div>

            <?php if ( count(get_field('vip_icons')) > 0 ) : ?>
                <div class="vip-program__features-col">
                    <?php foreach( get_field('vip_icons') as $icon ) : ?>
                        <div class="vip-program__feature">
                            <img src="<?php echo $icon['icon']['sizes']['image-grid--small']; ?>" alt="<?php echo $icon['text']; ?>" loading="lazy">
                            <p><?php echo $icon['text']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <img alt="" src="<?php images_folder(); ?>icons/vip-program-stamp.svg" alt="Big Fish VIP" class="vip-program__stamp" loading="lazy">
    </div>

</section>


<!-- Sign Up -->
<?php 
    $data = get_field('sign_up')['content_image'];
    render_module('content_image', $data);
?>


<!-- FAQs -->
<?php
    $data = get_field('faqs')['faqs'];
    render_module('faqs', $data);
?>


<?php get_footer(); ?>