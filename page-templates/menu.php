<?php
/* Template Name: Menu */

get_header(); 
?>

<!-- Hero -->
<?php
    $data = get_field('top_banner_menu')['top_banner'];
    render_module('top_banner', $data);
?>


<!-- CTA -->
<?php
    $data = get_field('content_image')['content_image'];
    render_module('content_image', $data);
?>



<?php // Menu Filter
    $menu_types = get_terms('menu_types');
    $dietary_info = get_terms('dietary_info');
?>

<section class="menu-filter-mobile | u-mobile-only">
    <h1 class="menu-filter-mobile__title">Browse our menus</h1>

    <?php if (! empty( get_field('menu_pdfs') ) ) : ?>
        <div class="menu-filter__menu-pdfs | js-filter-control u-px-mobile-30 u-mobile-only">
            <?php foreach( get_field('menu_pdfs') as $menu ) : ?>
                <a href="<?php echo $menu['file']; ?>" target="_blank" title="<?php echo $menu['name']; ?>"><?php echo $menu['name']; ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <select name="menu_types" id="menu-types-mobile" class="js-menu-type-select js-filter-control js-selectric" title="Select menu type">
        <option value="" disabled selected>Select From</option>
        <option value="all">Show All</option>
        <?php foreach ($menu_types as $type) : ?>
            <option value="<?php echo $type->term_id; ?>"><?php echo $type->name; ?></option>
        <?php endforeach; ?>
    </select>
</section>

<section class="menu-filter">
    <div class="container | js-hidden">
        <h1 class="menu-filter__title | u-hide-mobile">Browse our menus</h1>
        <div class="row">
            
            <?php if (! empty( get_field('menu_pdfs') ) ) : ?>
                <div class="menu-filter__menu-pdfs | js-filter-control col-12 u-hide-mobile">
                    <?php foreach( get_field('menu_pdfs') as $menu ) : ?>
                        <a href="<?php echo $menu['file']; ?>" target="_blank" title="<?php echo $menu['name']; ?>"><?php echo $menu['name']; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="menu-filter__menu-types | js-filter-control col-12 u-hide-mobile">
                <?php foreach ($menu_types as $type) : ?>
                    <a class="menu-type | js-menu-type" href="#" data-menu-type="<?php echo $type->term_id; ?>"><?php echo $type->name; ?></a>
                <?php endforeach; ?>
            </div>
            
            <?php if ( ! empty($dietary_info) ) : ?>
                <div class="col-12 u-px-mobile-30">
                    <p class="filterby">Filter by</p>
                </div>
            <?php endif; ?>
            
            <div class="menu-filter__dietary-info | js-filter-control col-12 u-px-mobile-30">
                <?php foreach ($dietary_info as $info) : ?>
                    <div class="dietary-info">
                        <input type="checkbox" name="<?php echo $info->name; ?>" class="js-dietary-info" data-dietary-info="<?php echo $info->term_id; ?>">
                        <span><?php echo $info->name; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<section class="menu-items | js-menu-items">

    <?php 
        foreach ( $menu_types as $type ) :

            // If menu type has items
            if ( $type->count > 0 ) : ?>
                
                <div class="container">
                    <div class="menu-items__menu-type | js-menu-type-row is-active row" data-menu-type="<?php echo $type->term_id; ?>">
                        <div class="col-12">
                            <h2 class="menu-items__subheading"><?php echo $type->name; ?></h2>
                        </div>
                        <?php
                            $args = array(
                                'post_type' => 'menu_items',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'menu_types',
                                        'field' => 'term_id',
                                        'terms' => $type->term_id,
                                    )
                                )
                            );

                            $query = new WP_Query($args);
                            if ($query->have_posts()) : 
                                while($query->have_posts()) : 
                                    $query->the_post();
                                    $img = get_field('image', $post->ID);

                                    $post_dietary_info = get_the_terms($post->ID, 'dietary_info');
                                    if (! empty($post_dietary_info)) {
                                        $diet_info = array_shift($post_dietary_info);
                                    }
                                    ?>
                                        <div class="menu-items__item js-menu-item is-active | col-lg-3" data-dietary-info="<?php echo $diet_info->term_id; ?>">
                                            <a class="d-block" href="<?php echo get_field('appfront_link','option'); ?>" target="_blank" aria-label="Order <?php the_title(); ?>">
                                                <img class="d-block" src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
                                            </a>
                                            <div class="menu-items__item-details">
                                                <p class="title"><?php the_title(); ?></p>
                                                <p class="description"><?php echo get_field('description', $post->ID); ?></p>
                                                <!-- <span class="price"><?php echo get_field('price', $post->ID); ?></span> -->
                                            </div>
                                        </div>
                                    <?php
                                endwhile;
                            endif;

                            wp_reset_postdata();
                        ?>
                    </div>
                </div>

            <?php endif; 
        endforeach; 
    ?>
        
</section>



<!-- Hero Dishes -->
<?php
    
    // Get menu_items selected as hero dish.
    $items = get_posts(array(
                'post_type' => 'menu_items',
                'post_status' => 'publish',
                'numberposts' => -1,
            ));

    $hero_dishes = array();
    foreach ($items as $item) {
        if (get_field('hero_dish', $item->ID)) {
            $hero_dishes[] = array(
                'ID' => $item->ID,
                'title' => get_the_title($item->ID),
                'image' => get_field('image', $item->ID)['sizes']['half-width'],
                'inspiration' => get_field('inspiration', $item->ID),
                'description' => get_field('description', $item->ID)   
            );
        }
    }

    if ( count($hero_dishes) > 0 && ! get_field('turn_hero_dishes_off') ) :
        ?>
            <section class="hl-posts">
                <div class="hl-posts__bg">
                    <img alt="" src="<?php images_folder(); ?>borders/top_blue--highlighted-posts.svg" class="hl-posts__bg-top">
                    <div></div>
                    <img alt="" src="<?php images_folder(); ?>borders/bottom_blue--highlighted-posts.svg" class="hl-posts__bg-bottom">
                </div>
                <div class="hl-posts__inner | js-hl-posts js-hidden">
                    <?php foreach ( $hero_dishes as $post ) : ?>
                        <div class="container">
                            <div class="hl-posts__slide | d-flex">
                                <div class="hl-posts__text-col | col-12 col-md-5 col-xl-5 offset-xl-1">
                                    <h3 class="hl-posts__subtitle">Hero Dishes</h3>
                                    <h1 class="hl-posts__title"><?php echo $post['title']; ?></h1>
                                    <?php render_wave_divider('white'); ?>
                                    <?php if ($post['inspiration'] != '') : ?>
                                        <p class="hl-posts__region">Region of inspiration: <?php echo $post['inspiration']; ?></p>
                                    <?php endif; ?>
                                    <p class="hl-posts__text"><?php echo $post['description']; ?></p>
                                </div>
                                <div class="hl-posts__img-col | col-12 col-md-6 offset-md-1 col-xl-6 offset-xl-0">
                                    <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
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

?>


<?php get_footer(); ?>