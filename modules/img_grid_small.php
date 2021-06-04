<?php 
if ( ! $data['img_grid_off'] ) : 
    $container_class = ( count($data['items']) < 5 ) ? 'has-one-row' : '';
    ?>
        <section <?php echo $id_string; ?> class="image-grid-small | text-center <?php echo $container_class; ?>">
            <div class="image-grid-small__bg | u-fluid"></div>
            
            <?php if ($data['title']) : ?>
                <h1 class="image-grid-small__title u-px-mobile-30 | js-hidden"><?php echo $data['title']; ?></h1>
            <?php endif; ?>
                
            <div class="container | u-pos-rel js-hidden">
                <div class="image-grid-small__inner | row">
                    <?php 
                        foreach( $data['items'] as $f ) { 
                            ?>
                                <div class="image-grid-small__item">
                                    <img class="u-rad-50" src="<?php echo $f['image']['sizes']['image-grid--small']; ?>" alt="<?php echo $f['image']['alt']; ?>" loading="lazy">
                                    <p><?php echo $f['text']; ?></p>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </section>
    <?php 
endif; ?>