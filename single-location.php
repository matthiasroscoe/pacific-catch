<?php get_header(); ?>

<!-- Hero Section -->
<?php 
    $data = get_field('hero')['hero'];
    render_module('hero', $data); 
?>

<!-- Introduction --> 
<section class="location-intro">
    <img class="location-intro__top" src="<?php images_folder(); ?>borders/top_white.svg">
    <div class="location-intro__container | container-fluid u-px-mobile-30">
        <div class="row justify-content-center js-hidden">
            <div class="col-lg-6">
                <?php if ( get_field('subheading') ) : ?>
                    <h2 class="location-intro__title"><?php the_field('subheading'); ?></h2>
                <?php endif; ?>

                <?php if ( get_field('description') ) : ?>
                    <p class="location-intro__text"><?php the_field('description'); ?></p>
                <?php endif; ?>

                <h3 class="location-intro__hours-title">Hours</h3>
                <p class="location-intro__hours-text"><?php the_field('opening_hours'); ?></p>

                <?php if ( get_field('happy_hour') ) : ?>
                    <div class="location-intro__happy-hour">
                        <img src="<?php images_folder(); ?>icons/cocktail.svg" alt="Happy Hour" loading="lazy">
                        <p>Happy Hour: <?php the_field('happy_hour_text'); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ( get_field('360_view') ) : ?>
                    <a class="c-arrow-link" href="<?php the_field('360_view'); ?>" target="_blank">
                        <span>360' View</span>
                        <img src="<?php images_folder(); ?>icons/arrow-right--blue.svg">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <img src="<?php images_folder(); ?>leaf_1.png" class="location-intro__leaf | js-prlx" loading="lazy">
    <img class="location-intro__bottom" src="<?php images_folder(); ?>borders/bottom_white.svg">
</section>


<!-- Features -->
<?php $data = get_field('features');
if ( $data ) : ?>
    <section class="image-grid-small | text-center">
        <div class="image-grid-small__bg | u-fluid"></div>
        
        <?php if (get_field('features_title')) : ?>
            <h1 class="image-grid-small__title | js-hidden"><?php the_field('features_title'); ?></h1>
        <?php endif; ?>

        <div class="container | u-pos-rel js-hidden">
            <div class="image-grid-small__inner | row">
                <?php 
                    // Get featured images from Locations Options page
                    $features_images = get_field('features_images', 'option');

                    // Match selected features with all location features
                    $features_to_show = array();
                    $i = 0;
                    foreach( $data as $feature ) {
                        foreach( $features_images as $fi ) {
                            if ( in_array($feature, $fi) ) {
                                $features_to_show[$i] = $fi;
                            }
                        }
                        $i++;
                    }

                    // Display grid items
                    foreach( $features_to_show as $f ) {
                        ?>
                            <div class="image-grid-small__item">
                                <img class="u-rad-50" src="<?php echo $f['image']['sizes']['image-grid--small']; ?>" alt="<?php echo $f['image']['alt']; ?>" loading="lazy">
                                <p><?php echo $f['text']; ?></p>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
        
    </section>
<?php endif; ?>


<!-- Find us -->
<section class="find-us">
    
    <img src="<?php images_folder(); ?>leaf--yellow.svg" class="find-us__leaf | js-prlx--rotate" loading="lazy">

    <div class="container | u-px-mobile-30 js-hidden">
        <div class="row">
            
            <div class="find-us__map-col | col-lg-7 col-xl-6 offset-xl-1">
                <div id="find-us-map" data-lat="<?php echo get_field('google_maps_link')['lat']; ?>" data-lng="<?php echo get_field('google_maps_link')['lng']; ?>"></div>
                <?php $encoded_address = urlencode(strip_tags(get_field('address'))); ?>
                <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/maps/single-location-map.js"></script>
                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $encoded_address; ?>" target="_blank">Get direction with Google Maps</a>
            </div>

            <div class="find-us__text-col | col-lg-4 offset-lg-1 col-xl-3">
                
                <?php if ( get_field('address') ) : ?>
                    <div class="address">
                        <h2>Address</h2>
                        <p><?php the_field('address'); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ( get_field('gen_manager') || get_field('chef') ) : ?>
                    <div class="team">
                        <h3>Our team</h3>
                        <?php if ( get_field('gen_manager') ) : ?>
                            <p class="team-title">General Manager:</p>
                            <p><?php echo the_field('gen_manager'); ?></p>
                        <?php endif; ?>
                        <?php if ( get_field('chef') ) : ?>
                            <p class="team-title">Chef:</p>
                            <p><?php echo the_field('chef'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_field('email_address') ) : ?>
                    <div class="email">
                        <h3>Email us</h3>
                        <a href="mailto:<?php the_field('email_address'); ?>" target="_blank"><?php the_field('email_address'); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ( get_field('telephone') ) : ?>
                    <div class="phone">
                        <h3>Call Us</h3>
                        <a href="tel:<?php the_field('telephone'); ?>"><?php the_field('telephone'); ?></a>
                    </div>
                <?php endif; ?>

                <?php if ( get_field('booking_link') ) {
                    render_svg_button(get_field('booking_link'), 'Book Now', 'small', 'white', 'yellow');
                } ?>

            </div>

        </div>
    </div>
</section>


<!-- Catering & Private Events -->
<?php 
    $data = get_field('content_image')['content_image'];
    render_module('content_image', $data);
?>


<!-- Our Food, Rewards, About Us -->
<?php
    $data = get_field('three_cols')['three_cols'];
    render_module('three_cols', $data);
?>

<?php get_footer(); ?>