<?php
/* Psuedo pagination */
// Query for all matching posts, get number of pages (round up totalposts/posts_per_page)
// foreach each page, create four links with data-attributes for the page they represnset.

// When clicking on page number, run same blog filter again but with offset set for the number of pages.
// Regenerate the page numbers after.

/*
function setup_pagination($query) {

    // If no query passed or only one page in query, do nothing
    if ( $query == null || $query->max_num_pages <= 1 ) {
        return;
    }

    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    $max   = intval( $query->max_num_pages );

    // Add current page to the array
    if ( $paged >= 1 ) {
        $links[] = $paged;
    }

    // Add the pages around the current page to the array
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    ?>
        <div class="pagination">
            <ul>
                <?php 
                    // Override REQUEST_URI, so that get_pagenum_link doesn't look for wp ajax url.
                    $curr_page = '/whats-new';
                    $req_uri = $_SERVER['REQUEST_URI'];
                    $_SERVER['REQUEST_URI'] = $curr_page;

                    // Previous Post Link
                    if ( get_previous_posts_link() ) {
                        ?>
                            <li><?php echo get_previous_posts_link('Prev'); ?></li>
                        <?php
                    }

                    // Link to first page, plus ellipses if necessary
                    if ( ! in_array( 1, $links ) ) {
                        $class = (1 == $paged) ? ' class="active"' : '';
                        ?>
                            <li <?php echo $class; ?>>
                                <a href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>">1</a>
                            </li>
                        <?php
                    }

                    // Link to current page, plus 2 pages in either direction as needed
                    sort( $links );
                    foreach ( $links as $link ) {
                        $class = ($paged == $link) ? ' class="active"' : '';
                        var_dump(get_pagenum_link($link));
                        ?>
                            <li <?php echo $class; ?>>
                                <a href="<?php echo esc_url( get_pagenum_link( $link ) ); ?>"><?php echo $link; ?></a>
                            </li>
                        <?php
                    }

                    // Link to last page, plus ellipses as needed
                    if ( ! in_array( $max, $links ) ) {
                        if ( ! in_array( $max - 1, $links ) ) {
                            ?>
                                <li>...</li>
                            <?php
                        }

                        $class = ($paged == $max) ? ' class="active"' : '';

                        ?>
                            <li <?php echo $class; ?>>
                                <a href="<?php echo esc_url( get_pagenum_link( $max ) ); ?>"><?php echo $max; ?></a>
                            </li>
                        <?php
                    }

                    // Get next posts link
                    if ( get_next_posts_link() ) {
                        ?>
                            <li><?php echo get_next_posts_link('Next'); ?></li>
                        <?php
                    }

                    // Reset REQUEST_URI
                    $_SERVER['REQUEST_URI'] = $req_uri;
                ?>
            </ul>
        </div>
    <?php
} */



/**
 * Render post item for post grid 
 */

function render_post_item() {
    $img = get_field('thumb', $post->ID);
    ?>
        <div class="post-grid__item | col-md-6 col-lg-4">
            <h2 class="post-grid__item-title | js-match-height"><?php the_title(); ?></h2>
            <a class="post-grid__item-image" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" loading="lazy">
            </a>
            <div class="post-grid__item-details">
                <p class="date"><?php echo get_the_date('j/n/Y'); ?></p>
                <p class="description"><?php echo get_field('post_excerpt', $post->ID); ?></p>
                <?php render_svg_button(get_the_permalink(), 'Read more', 'small', 'blue', 'yellow'); ?>
            </div>
        </div>
    <?php
}



/**
 * Filter Blog
 */

add_action('wp_ajax_filter_blog', 'filter_blog');
add_action('wp_ajax_nopriv_filter_blog', 'filter_blog');

function filter_blog() {

    $tags = $_POST['tag_ids'];
    $sortby = $_POST['sortby'];
    if ($sortby == '') {
        $sortby = 'date';
    }
    $order = ($sortby == 'date') ? 'DESC' : 'ASC';

    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'paged' => $paged,
        'tag__in' => $tags,
        'order' => $order,
        'orderby' => $sortby,
    );

    ob_start();

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while($query->have_posts()) :
            $query->the_post();
            render_post_item();
        endwhile;
    endif;

    // setup_pagination($query);
    $html = ob_get_clean();
    
    wp_reset_postdata();

    echo $html;

    wp_die();
}

?>