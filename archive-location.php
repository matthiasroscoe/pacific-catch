<?php get_header(); ?>

<?php
    $data = get_field('top_banner', 'options')['top_banner'];
    render_module('top_banner', $data);
?>

<section class="toggle-location-view">
    <div class="container">
        <div class="row | justify-content-center">
            <div class="view-toggle | js-list-view is-active">
                <h2>List View </h2>
            </div>
            <div class="view-toggle | js-map-view">
                <h2>Map View</h2>
            </div>
        </div>
    </div>
</section>

<div class="js-list-view-container">
    <section class="find-loc">
        <img alt="" src="<?php images_folder(); ?>borders/top_white.svg" class="find-loc__top | d-block">
        <div class="find-loc__inner | u-px-mobile-15">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <p class="find-loc__text">Use the search bar below to find the location closest to you.</p>
                        <form class="find-loc__search | js-search-location" action="#">
                            <input type="text" name="zipcode" placeholder="Your zipcode here" class="find-loc__zipcode | js-zipcode">
                            <input value="" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img alt="" src="<?php images_folder(); ?>borders/bottom_white.svg" class="find-loc__bottom">
        <img alt="" src="<?php images_folder(); ?>leaf_1.png" class="find-loc__leaf | js-prlx--rotate" loading="lazy">
    </section>

    <section class="locations-grid">
        <img alt="" src="<?php images_folder(); ?>leaf--yellow.svg" class="locations-grid__leaf-1 | js-prlx" loading="lazy">
        <img alt="" src="<?php images_folder(); ?>leaf--white.svg" class="locations-grid__leaf-2 | js-prlx--rotate" loading="lazy">
        <div class="container | js-hidden">
            <div class="row js-locations-container">
                <?php 
                    if ($args == null) {
                        $args = array(
                            'post_type' => 'location',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'title',
                            'order' => 'ASC'
                        );
                    }
                
                    $loop = new WP_Query($args);
                
                    if ($loop->have_posts()) : 
                        while($loop->have_posts()) : $loop->the_post();
                            global $post;
                            $id = $post->ID;
                            render_location_item($id);
                            
                        endwhile;
                    endif;

                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
</div>


<div class="js-map-view-container | u-px-mobile-30">
    <section class="locations-map | container">
        <div class="row">
            <?php // Store map data as data attribute for easy js access. ?>
            <div class="u-hide js-map-data" data-map='<?php echo get_all_locations_map_data(); ?>'></div>
            <div class="col-xl-10 offset-xl-1 locations-map__map-container | js-all-locations-map"></div>
            <script src="<?php echo get_stylesheet_directory_uri(); ?>/library/js/maps/archive-location-map.js"></script>
        </div>
    </section>
</div>



<!-- CTA -->
<?php
    $data = get_field('cta', 'option')['call_to_action'];
    render_module('call_to_action', $data);
?>


<?php get_footer(); ?>