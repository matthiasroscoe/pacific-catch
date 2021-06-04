<?php
/* Template Name: Careers */

get_header();
?>

<!-- Hero -->
<?php
    $data = get_field('hero')['hero'];
    render_module('hero', $data);
?>


<!-- Introduction -->
<?php
    $data = get_field('intro')['intro'];
    render_module('intro', $data);
?>


<!-- Our Culture -->
<?php 
    $data = get_field('our_culture')['content_image'];
    render_module('content_image', $data, 'con-img-1');
?>


<!-- Our Team -->
<?php if (! get_field('our_team_off') ) : ?>
    <div class="team | u-pos-rel">
        
        <?php if (get_field('team_title')) : ?>
            <h1 class="team__title | u-px-mobile-30"><?php the_field('team_title'); ?></h1>
        <?php endif; ?>

        <?php 
            $data = get_field('team_top')['content_image'];
            render_module('content_image', $data, 'team-con-img');
        ?>

        <!-- <div class="team__grid | container">
            <div class="row">

            </div>
        </div> -->

    </div>
<?php endif; ?>


<!-- Why work with us -->
<?php 
    $data = get_field('work_with_us')['content_image'];
    render_module('content_image', $data, 'con-img-3');
?>

<img class="careers-leaf | js-prlx--rotate" src="<?php images_folder(); ?>leaf--careers.png">

<!-- Ocean lovers -->
<?php 
    $data = get_field('ocean_lovers')['content_image'];
    render_module('content_image', $data, 'con-img-4');
?>


<!-- Benefits -->
<?php
    $data = get_field('con_icons_img')['con_icons_img'];
    render_module('con_icons_img', $data, 'benefits');
?>


<!-- Job CTA -->
<?php
    $data = get_field('call_to_action')['call_to_action'];
    render_module('call_to_action', $data);
?>


<?php get_footer(); ?>