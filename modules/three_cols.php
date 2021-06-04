<?php if (! $data['three_cols_off'] && count($data['cols']) > 0) : ?>
    <section <?php echo $id_string; ?> class="three-cols">
        
        <?php if ($data['title']) : ?>
        <h1 class="three-cols__title | u-px-mobile-15"><?php echo $data['title']; ?></h1>
        <?php endif; ?>

        <div class="three-cols__inner">

            <div class="three-cols__bg">
                <img src="<?php images_folder(); ?>borders/top_cta_yellow.svg" class="top">
                <div></div>
                <img src="<?php images_folder(); ?>borders/bottom_cta_yellow.svg" class="bottom">
            </div>

            <div class="container | u-px-mobile-30 js-hidden">
                <div class="row | justify-content-center">
                    <?php foreach( $data['cols'] as $col ) : ?>
                        <div class="three-cols__col | col-lg-4">
                            
                            <?php if ( $col['heading'] ) : ?>
                                <h2 class="three-cols__heading"><?php echo $col['heading']; ?></h2>
                            <?php endif; ?>
                            
                            <img src="<?php echo $col['image']['sizes']['three-cols']; ?>" alt="<?php echo $col['image']['alt']; ?>" class="three-cols__img" loading="lazy">
                            
                            <?php if ( $col['text'] ) : ?>
                                <p class="three-cols__text"><?php echo $col['text']; ?></p>
                            <?php endif; ?>
    
                            <?php if ( $col['link'] ) :
                                render_svg_button($col['link']['url'], $col['link']['title'], 'big', 'blue', 'yellow', null, $col['link']['target']);
                            endif; ?>
                                
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        
        <?php if ($data['leaf']) : 
            $leaf_class = ($data['title']) ? '' : 'has-neg-margin';
            ?>
            <img src="<?php images_folder(); ?>small-leaf.png" class="three-cols__leaf | <?php echo $leaf_class; ?> js-prlx" loading="lazy">
        <?php endif; ?>

    </section>

<?php endif; ?>