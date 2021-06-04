<?php
/* Template Name: Reservation */

get_header(); 
?>

<!-- Hero -->
<?php
    $data = get_field('top_banner')['top_banner'];
    render_module('top_banner', $data);
?>


<!-- Reservation -->
<section class="reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-2 col-xl-6 offset-xl-3 mb-4">
                <h1>Choose your location below</h1>
                <select name="reservation" class="js-selectric js-reservation-select" title="Select Location">
                    <option value="" disabled selected>Select from</option>
                    
                    <?php 
                        $location = get_posts(array(
                            'post_type' => 'location',
                            'numberposts' => -1,
                            'post_status' => 'publish',
                        ));

                        foreach($location as $l) {
                            $link = get_field('booking_link', $l->ID);
                            if ($link) :
                                ?>
                                    <option value="<?php echo $link; ?>"><?php echo get_the_title($l->ID); ?></option>
                                <?php
                            endif;
                        }
                    ?>

                </select>

                <a id="reservations-submit" href="#" target="_blank" class="c-btn c-btn--big c-btn--blue c-btn--hov-yellow">Book Now</a>
            </div>
        </div>
    </div>
</section>



<!-- CTA -->
<?php
    $data = get_field('call_to_action')['call_to_action'];
    render_module('call_to_action', $data);
?>


<?php get_footer(); ?>