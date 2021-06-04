<?php 
/* Page Template: Simple Page */

get_header();
?>

<?php
    $data = get_field('top_banner')['top_banner'];
    render_module('top_banner', $data);
?>

<section class="simple-page-content | u-px-mobile-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="c-wysiwyg">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>