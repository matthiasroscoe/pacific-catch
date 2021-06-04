<?php get_header(); ?>

<!-- Hero Video -->
<?php 
    $data = get_field('hero')['hero'];
    render_module('hero', $data); 
?>

<!-- Hero Dishes -->
<?php if (! get_field('hd_section_off')) : ?>
<section class="highlights-slider highlights-slider--front | u-px-mobile-15">
    
    <div class="highlights-slider__bg-text" style="width: 100vw;">
        <?php 
            $dishes = get_field('hero_dishes');
            $z = 0;
            foreach( $dishes as $dish ) {
                $country = $dish['country'];
                $is_active = ($z == 0) ? ' is-active' : '';
                ?>
                    <h1 class="js-lettering<?php echo $is_active; ?>" data-slide="<?php echo $z; ?>"><?php echo $country; ?></h1>
                <?php
                $z++;
            }
        ?>
    </div>

    <img alt="" src="<?php images_folder(); ?>small-leaf.png" class="highlights-slider__flower | js-prlx--rotate" loading="lazy">
    
    <div class="highlights-slider__slider-container | container u-pos-rel js-hidden">
        
        <div class="row">
            <div class="highlights-slider__slider | col-lg-7">
                <img alt="" class="highlights-slider__bg-leaf | u-abs-center" src="<?php images_folder(); ?>hero-dish-leaf.png">
                <div class="js-dishes-slider">
                    <?php 
                        foreach( $dishes as $dish ) { 
                            $is_cropped = ( $dish['crop_image'] ) ? 'is-cropped ' : '';
                            ?>
                            <div class="highlights-slider__slide">
                                <div class="img-container | u-pos-rel d-flex justify-content-center align-items-center">
                                    <img class="highlights-slider__dish-img <?php echo $is_cropped; ?>| u-pos-rel" rel="preload" alt="<?php echo $dish['img']['alt']; ?>" loading="lazy"
                                        src="<?php echo $dish['image']['sizes']['hero-dish']; ?>">

                                    <!-- <img class="highlights-slider__dish-img <?php echo $is_cropped; ?>| u-pos-rel" rel="preload" alt="<?php echo $dish['img']['alt']; ?>" loading="lazy"
                                        srcset="<?php echo $dish['image']['sizes']['medium']; ?> 300w,
                                                <?php echo $dish['image']['sizes']['half-width']; ?> 600w"
                                        sizes="(min-width:992px) 600px,
                                               300px"
                                    > -->
                                </div>
                                <a href="<?php get_site_url(); ?>/menus/" class="d-block highlights-slider__dish-details highlights-slider__dish-details--front">
                                    <img alt="" src="<?php images_folder(); ?>fish.svg" class="fish">
                                    <h2 class="dish-title dish-title--front js-match-height"><?php echo $dish['name']; ?></h2>
                                    <p class="dish-country">Region of Inspiration: <?php echo $dish['country']; ?></p>
                                </a>
                            </div>
                            <?php
                        }
                    ?>
                </div>
                <?php render_wave_nav(); ?>
            </div>
            
            <div class="highlights-slider__content | col-lg-5">
                <?php if ( get_field('hd_title') ) : ?>
                    <h2 class="highlights-slider__title"><?php the_field('hd_title'); ?></h2>
                <?php endif; ?>
                
                <?php if ( get_field('hd_text') ) : ?>
                    <p class="highlights-slider__text"><?php the_field('hd_text'); ?></p>
                <?php endif; ?>

                <div class="highlights-slider__buttons">
                    <?php // Render buttons
                        if ( in_array('menus', get_field('hd_buttons')) ) {
                            render_svg_button(get_the_permalink(634), 'Explore the menus', 'small', 'blue', 'yellow');
                        }                    
                        if ( in_array('food', get_field('hd_buttons')) ) {
                            render_svg_button(get_the_permalink(490), 'Read more about our food', 'big', 'blue', 'yellow');
                        }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- What's New Sections -->
<?php 
    $whats_new = get_field('whats_new');
    if ( count($whats_new) > 0 ) : 
        ?>
            <section class="whats-new">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1 class="whats-new__primary-title | js-hidden">What's New</h1>
                        </div>
                    </div>
                </div>

                <?php 
                $z = 1;
                foreach( $whats_new as $wn ) : 
                    $container_class = 'whats-new__container--odd';
                    $img_col_rotation = 'js-rotate-anticlock';
                    $text_col_rotation = 'js-rotate-clock';
                    if ($z % 2 == 0) {
                        $container_class = 'whats-new__container--even';
                        $img_col_rotation = 'js-rotate-clock';
                        $text_col_rotation = 'js-rotate-anticlock';
                    }
                    ?>
                    <div class="container-fluid whats-new__container <?php echo $container_class; ?> | js-rotate-trigger">
                        <div class="row | u-pos-rel">
                            <div class="whats-new__img-col <?php echo $img_col_rotation; ?>">
                                <img src="<?php echo $wn['image']['sizes']['large']; ?>" alt="<?php echo $wn['image']['alt']; ?>" loading="lazy">
                            </div>
                            <div class="whats-new__content-col <?php echo $text_col_rotation; ?>">
                                <div class="whats-new__icon"></div>
                                <div class="whats-new__content-inner">
                                    <h2 class="whats-new__title"><?php echo $wn['title']; ?></h2>
                                    <?php render_wave_divider('blue'); ?>
                                    <p class="whats-new__text"><?php echo $wn['text']; ?></p>
                                </div>
                                <?php // Render button
                                    if ( $wn['link'] ) {
                                        $link = $wn['link']['url'];
                                        $text = $wn['link']['title'];
                                        $target = $wn['link']['target'];
                                    }
                                    $button_size = ( $wn['button_size'] ) ? 'big' : 'small';
                                    render_svg_button($link, $text, $button_size, 'blue', 'yellow', null, $target);
                                ?>
                            </div>
                        </div>
                    </div>
                <?php $z++;
                endforeach; ?>
                <img src="<?php images_folder(); ?>leaf_1.png" class="whats-new__leaf | js-prlx--rotate" loading="lazy">
            </section>
        <?php 
    endif; 
?>


<!-- Rewards --> 
<?php if ( ! get_field('rewards_section_off') ) : ?>
    <section class="rewards">
        <div class="container-fluid | u-px-mobile-0">

            <?php // Background images
                $images = get_field('rewards_images'); 
                if ( ! empty($images['image_1']) ) {
                    ?>
                        <img class="rewards__img1 | js-hidden js-hidden--no-slide" src="<?php echo $images['image_1']['sizes']['large']; ?> " alt="<?php echo $images['image_1']['alt']; ?>" loading="lazy">
                    <?php
                }
                if ( ! empty($images['image_2']) ) {
                    ?>
                        <img class="rewards__img2 | js-hidden js-hidden--no-slide" src="<?php echo $images['image_2']['sizes']['large']; ?> " alt="<?php echo $images['image_2']['alt']; ?>" loading="lazy">
                    <?php
                }
            ?>

            <div class="container js-hidden">
                <div class="row">
                    <div class="col-lg-9 offset-lg-2 rewards__content-container">

                        <div class="rewards__roundel">
                            <img alt="" class="rewards__roundel__text | js-rotate-scroll" src="<?php images_folder(); ?>icons/roundel--text-white.svg" loading="lazy">
                            <img alt="" class="rewards__roundel__fish" src="<?php images_folder(); ?>icons/fish-white.svg" loading="lazy">
                        </div>
                        
                        <div class="rewards__content">
                            <h1 class="rewards__title"><?php echo get_field('rewards_title'); ?></h1>
                            <?php render_wave_divider('white'); ?>
                            <div class="rewards__text | c-wysiwyg"><?php echo get_field('rewards_content'); ?></div>
                            <?php 
                                if ( get_field('rewards_link') ) {
                                    render_svg_button(get_field('rewards_link'), 'Find out more', 'small', 'blue', 'white'); 
                                }
                            ?>
                        </div>
                        
                        <?php $features = get_field('rewards_features');
                        if ( count($features) > 0 ) : ?>
                            <div class="rewards__features">
                                <?php foreach( $features as $f ) : ?>
                                    <div class="feature">
                                        <div class="icon" style="background-image: url('<?php echo $f['icon']['url']; ?>');"></div>
                                        <p><?php echo $f['text']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <img alt="" src="<?php images_folder(); ?>leaf--rewards.png" class="rewards__leaf | js-prlx--rotate" loading="lazy">
    </section>
<?php endif; ?>


<!-- Our Partners -->
<?php 
    $data = get_field('our_partners')['our_partners'];
    render_module('our_partners', $data); 
?>


<!-- Instagram Feed -->
<?php include('modules/instagram.php'); ?>


<?php get_footer(); ?>