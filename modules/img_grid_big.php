<?php if ( ! $data['img_grid_off'] ) : ?>
    <section <?php echo $id_string; ?> class="image-grid-big | text-center">
        
        <?php if ($data['background'] == 'blue') : ?>
            <img src="<?php images_folder(); ?>leaf--bg.svg" class="image-grid-big__leaf" loading="lazy">
        <?php elseif ($data['background'] == 'yellow') : ?>
            <img src="<?php images_folder(); ?>leaf--yellow.svg" class="image-grid-big__leaf image-grid-big__leaf--yellow" loading="lazy">
        <?php endif; ?>
        
        <div class="image-grid-big__title-container | js-hidden">
            <?php 
                if ($data['title']) {
                    ?>
                        <h1 class="image-grid-big__title"><?php echo $data['title']; ?></h1>
                    <?php
                }    

                if ($data['subheading']) {
                    ?>
                        <p class="image-grid-big__subheading"><?php echo $data['subheading']; ?>
                    <?php
                }
            ?>
        </div>
        <div class="container js-hidden">
            <div class="image-grid-big__inner | row">
                <?php 
                    $col_class = 'col-lg-4';
                    if (count($data['items']) == 4 || count($data['items']) >= 7) {
                        $col_class = 'col-lg-3';
                    }

                    foreach( $data['items'] as $item ) {
                        $item_class = ($item['overlay_text']) ? 'has-text' : '';
                        ?>
                            <div class="image-grid-big__item <?php echo $item_class; ?> | col-md-6 <?php echo $col_class; ?>">
                                <div class="image-grid-big__image-container">
                                    
                                    <?php 
                                        if($item['link']['url'] > ''){
                                            ?>
                                                <a href="<?php echo $item['link']['url']; ?>" target="<?php echo $item['link']['target']; ?>" class="d-block">
                                            <?php
                                        }
                                    ?>
                                    

                                    <img src="<?php echo $item['image']['sizes']['three-cols']; ?>" alt="<?php echo $item['image']['alt']; ?>" loading="lazy">
                                    <?php if ($item['overlay_text']) : ?>
                                        <h3 class="u-abs-center"><?php echo $item['overlay_text']; ?></h3>
                                    <?php endif; ?>

                                    <?php 
                                        if($item['link']['url'] > ''){
                                            ?>
                                                </a>
                                            <?php
                                        }
                                    ?>

                                </div>
                                <p class="image-grid-big__text"><?php echo $item['text']; ?></p>
                                <?php 
                                    if ($item['link']) {
                                        $link = $item['link'];
                                        render_svg_button($link['url'], $link['title'], 'small', 'blue', 'yellow', null, $link['target']);
                                    }
                                ?>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>

    </section>
<?php endif; ?>


