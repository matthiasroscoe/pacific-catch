<?php
// Display video or image carousel 
if ($data['media_type'] == 'video') :    
    ?>
    <section <?php echo $id_string; ?> class="hero video">
        <div class="container">
            <div class="video-row | row u-pos-rel">
                <video class="video js-hero-vid" autoplay playsinline muted loop loading="lazy" data-mobile-src="<?php echo $data['vid_mobile']['url']; ?>" data-desktop-src="<?php echo $data['vid_desktop']['url']; ?>">
                </video>
                <h1 class="hero__title | u-abs-center u-px-mobile-30"><?php echo $data['title']; ?></h1>
            </div>
            <?php // Display badge
                if ( get_post_type() == 'location' ) {
                    global $post;
                    $badge = get_field('badge', $post->ID)['url'];
                    if ($badge) : ?>
                        <img src="<?php echo $badge; ?>" alt="<?php the_title(); ?>" class="hero__stamp u-img-auto">
                    <?php endif;
                } 
            ?>
        </div>
    </section>
<?php else: ?>
    <section class="hero carousel">
        <div class="container">
            <div class="row">
                <div class="carousel js-hero-carousel">
                    <?php 
                        $images = $data['carousel'];
                        foreach ( $images as $img ) {
                            $img = $img['image'];
                            ?>
                                <img src="<?php echo $img['sizes']['max-grid']; ?>" alt="<?php echo $img['alt']; ?>">
                            <?php
                        }
                    ?>
                </div>
                <?php 
                    if ( count($images) > 1 ) {
                        render_wave_nav('white');
                    }
                ?>
                <h1 class="hero__title | u-abs-center u-px-mobile-30"><?php echo $data['title']; ?></h1>
            </div>
            <?php // Display badge
                if ( get_post_type() == 'location' ) {
                    global $post;
                    $badge = get_field('badge', $post->ID)['url'];
                    if ($badge) : ?>
                        <img src="<?php echo $badge; ?>" alt="<?php the_title(); ?>" class="hero__stamp u-img-auto" loading="lazy">
                    <?php endif;
                } 
            ?>
        </div>
    </section>


<?php endif; ?>