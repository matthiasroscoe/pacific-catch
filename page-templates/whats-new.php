<?php
/* Template Name: What's New */

get_header(); 
?>

<!-- Hero -->
<?php
    $data = get_field('top_banner')['top_banner'];
    render_module('top_banner', $data);
?>


<!-- Highlighted Posts -->
<?php
if (! get_field('turn_off_highlighted_posts')) :
    // Get menu_items selected as hero dish.
    $items = get_posts(array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'numberposts' => -1,
            ));

    $h_posts = array();
    foreach ($items as $item) {
        if (get_field('highlighted_post', $item->ID)) {
            $h_posts[] = array(
                'ID' => $item->ID,
                'title' => get_the_title($item->ID),
                'image' => get_field('thumb', $item->ID)['sizes']['half-width'],
                'description' => get_field('post_excerpt', $item->ID),
            );
        }
    }

    if ( count($h_posts) > 0 ) :
        ?>
            <section class="hl-posts">
                <div class="hl-posts__bg">
                    <img src="<?php images_folder(); ?>borders/top_blue--highlighted-posts.svg" class="hl-posts__bg-top">
                    <div></div>
                    <img src="<?php images_folder(); ?>borders/bottom_blue--highlighted-posts.svg" class="hl-posts__bg-bottom">
                </div>
                <div class="hl-posts__inner | js-hl-posts">
                    <?php foreach ( $h_posts as $post ) : ?>
                        <div class="container">
                            <div class="hl-posts__slide | d-flex">
                                <div class="hl-posts__text-col | col-12 col-md-5 col-xl-5 offset-xl-1">
                                    <h3 class="hl-posts__subtitle">Highlights</h3>
                                    <h1 class="hl-posts__title"><?php echo $post['title']; ?></h1>
                                    <?php render_wave_divider('white'); ?>
                                    <p class="hl-posts__text"><?php echo $post['description']; ?></p>
                                    <?php render_svg_button(get_the_permalink($post['ID']),'Read more', 'small', 'blue', 'yellow'); ?>
                                </div>
                                <div class="hl-posts__img-col | col-12 col-md-6 offset-md-1 col-xl-6 offset-xl-0">
                                    <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" loading="lazy">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="container hl-posts__slider-nav">
                    <div class="row">
                        <div class="col-lg-5 col-xl-4 offset-xl-1"><?php render_wave_nav('white'); ?></div>
                    </div>
                </div>
                
            </section>
        <?php
    endif;
endif;
?>


<?php // What's New Filter
    $tags = get_terms('post_tag');
?>
<section class="wn-filter">
    <div class="container">
        <div class="row">
        <div class="col-12">
                <p class="filterby">Filter by</p>
            </div>
            <div class="wn-filter__tags | col-md-9 col-lg-10">
                
                <select name="wn-tags" id="wn-tags-mobile" class="wn-filter__tags-mobile js-wn-tags-select js-selectric | u-mobile-only">
                    <option value="" disabled selected>Select Tag</option>
                    <option value="all">Show All</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>
                    <?php endforeach; ?>
                </select>
                    
                <div class="wn-filter__tags-desktop | u-hide-mobile">
                    <div class="wn-tags">
                        <?php foreach ($tags as $tag) : ?>
                            <a class="wn-tag | js-tag" href="#" data-tag="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <div class="wn-filter__sortby | col-md-3 col-lg-2">
                <select name="wn-sortby" class="c-select--yellow js-sortby js-selectric">
                    <option value="date" disabled selected>Sort by</option>
                    <option value="date">Newest</option>
                    <option value="title">A to Z</option>
                </select>
            </div>
        </div>
    </div>
</section>

<section class="post-grid">
    <div class="container">
        <div class="js-post-grid | row">
            <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'paged' => $paged,
                    'orderby' => 'date',
                );

                $query = new WP_Query($args);
                
                if ($query->have_posts()) : 
                    while($query->have_posts()) : 
                        $query->the_post();
                            render_post_item();
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
            <div class="post-grid__pagination | col-12">
                <?php // Display pagination
                    if (function_exists('setup_pagination')) {
                        setup_pagination($query);
                    }
                ?>
            </div>
        </div>
    </div>
</section>


<!-- CTA -->
<?php
    $data = get_field('three_cols')['three_cols'];
    render_module('three_cols', $data);
?>


<?php get_footer(); ?>