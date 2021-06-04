<?php if (! $data['section_off'] ) : ?>
    <section class="highlights-slider | u-px-mobile-15">

        <img src="<?php images_folder(); ?>small-leaf.png" class="highlights-slider__flower | js-prlx--rotate" loading="lazy">
        
        <div class="highlights-slider__slider-container | container u-pos-rel js-hidden pt-0">
            
            <div class="row">
                <div class="highlights-slider__slider | col-lg-7">
                    <img class="highlights-slider__bg-leaf | u-abs-center" src="<?php images_folder(); ?>hero-dish-leaf.png">
                    <div class="js-dishes-slider">
                        <?php 
                            foreach( $data['slides'] as $slide ) { 
                                $is_cropped = ( $slide['crop_image'] ) ? 'is-cropped ' : '';
                                ?>
                                <div class="highlights-slider__slide">
                                    <div class="img-container | u-pos-rel d-flex justify-content-center align-items-center">
                                        <img class="highlights-slider__dish-img <?php echo $is_cropped; ?>| u-pos-rel" rel="preload" alt="<?php echo $slide['image']['alt']; ?>" loading="lazy"
                                            src="<?php echo $slide['image']['sizes']['hero-dish']; ?>">
                                    </div>
                                    <div class="d-block highlights-slider__dish-details">
                                        <h2 class="dish-title js-match-height"><?php echo $slide['title']; ?></h2>
                                        <p class="dish-country"><?php echo $slide['subtitle']; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <?php render_wave_nav(); ?>
                </div>
                
                <div class="highlights-slider__content | col-lg-5">
                    <?php if ( $data['title'] ) : ?>
                        <h2 class="highlights-slider__title"><?php echo $data['title']; ?></h2>
                    <?php endif; ?>
                    
                    <?php if ( $data['text'] ) : ?>
                        <p class="highlights-slider__text"><?php echo $data['text']; ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty($data['buttons']) ) :?>
                        <div class="highlights-slider__buttons">
                            <?php foreach($data['buttons'] as $button) {
                                $link = $button['link'];
                                render_svg_button($link['url'], $link['title'], 'small', 'blue', 'yellow', null, $link['target']);
                            } ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>
<?php endif; ?>