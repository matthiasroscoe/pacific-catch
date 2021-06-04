<?php 

/**
 * Menu AJAX filter
 */

add_action('wp_ajax_menu_filter', 'menu_filter');
add_action('wp_ajax_nopriv_menu_filter', 'menu_filter');

function menu_filter() {

    $dietInfoIds = $_POST['diet_info'];
    $menuTypeIds = $_POST['menu_types'];

    // Get menu type terms
    if ($menuTypeIds == null) {
        $menu_types = get_terms('menu_types');
    } else {
        $menu_types = get_terms(array(
            'taxonomy' => 'menu_types',
            'include' => $menuTypeIds,
        ));
    }

    ob_start();
    $empty_row_counter = 0;
    foreach($menu_types as $type) {
        ?>
        <div class="container">
            <div class="menu-items__menu-type | js-menu-type-row is-active row" data-menu-type="<?php echo $type->term_id; ?>">
                <?php
                    $args = array(
                        'post_type' => 'menu_items',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                    );

                    if ($dietInfoIds != null ) {
                        $args['tax_query'] = array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'menu_types',
                                'field' => 'term_id',
                                'terms' => $type->term_id,
                            ),
                            array(
                                'taxonomy' => 'dietary_info',
                                'field' => 'term_id',
                                'terms' => $dietInfoIds,
                            )
                        );
                    } else {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'menu_types',
                                'field' => 'term_id',
                                'terms' => $type->term_id,
                            )
                        );
                    }

                    $query = new WP_Query($args);
                    if ($query->have_posts()) : 
                        ?>
                            <div class="col-12">
                                <h2 class="menu-items__subheading"><?php echo $type->name; ?></h2>
                            </div>
                        <?php
                            while($query->have_posts()) : 
                                $query->the_post();
                                $img = get_field('image', $post->ID);

                                $post_dietary_info = get_the_terms($post->ID, 'dietary_info');
                                if (! empty($post_dietary_info)) {
                                    $diet_info = array_shift($post_dietary_info);
                                }
                                ?>
                                    <div class="menu-items__item js-menu-item is-active | col-lg-3" data-dietary-info="<?php echo $diet_info->term_id; ?>">
                                        <a class="d-block" href="<?php echo get_field('appfront_link','option'); ?>" target="_blank">    
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
                    else: 
                        $empty_row_counter++;
                    endif;

                    wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }

    if ($empty_row_counter == count($menu_types)) {
        // No posts found 
        ?>
            <div class="no-items text-center mb-4 pb-4">
                <h1>No items found</h1>
                <p class="mb-4 pb-4">Try the filter again.</p>
            </div>
        <?php
    }

    $html = ob_get_clean();

    echo $html;

    wp_die();
}


?>