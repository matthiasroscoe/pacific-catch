<section <?php echo $id_string; ?> class="insta">
    <div class="container | js-hidden">
        <div class="row justify-content-between">
            <div class="insta__hashtag | col-6">
                <h2>#oceanlover</h2>
            </div>
            <div class="insta__handle | col-6">
                <a href="<?php echo get_field('instagram', 'option'); ?>" target="_blank">@pacificcatch</a>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0 | js-hidden">
        <div class="insta__feed">
            <?php echo do_shortcode('[instagram-feed]'); ?>
        </div>
    </div>
</section>