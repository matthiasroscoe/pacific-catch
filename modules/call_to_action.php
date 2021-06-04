<?php 
if (! $data['cta_off']) :

    if ( $data['bg_colour'] == 'yellow' ) {
        $text_colour = 'text-navy';
        $btn_colour = 'blue';
        $btn_colour_hover = 'yellow';
    } else if ( $data['bg_colour'] == 'blue' ) {
        $text_colour = 'text-white';
        $btn_colour = 'white';
        $btn_colour_hover = 'yellow';
    }
    
    $container_class = ( $data['text'] ) ? 'has-description' : '';
    ?>

    <section <?php echo $id_string; ?> class="cta cta--<?php echo $data['bg_colour']; ?> | u-pos-rel">

        <img src="<?php images_folder(); ?>small-leaf.png" class="cta__leaf | js-prlx--rotate" loading="lazy">
        <img src="<?php images_folder(); ?>borders/top_cta_<?php echo $data['bg_colour']; ?>.svg" class="cta__top">

        <div class="container-fluid <?php echo $container_class; ?>">
            <div class="container | js-hidden">
                <div class="row">
        
                    <div class="cta__img-col cta__img-col--1 | col-lg-4 u-hide-mobile">
                        <?php if ( $data['image_1'] ) : ?>
                            <img src="<?php echo $data['image_1']['sizes']['three-cols']; ?>" alt="<?php echo $data['image_1']['alt']; ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
        
                    <div class="cta__text-col | text-center col-lg-4">
                        <h1 class="cta__title"><?php echo $data['title']; ?></h1>
                        <?php render_wave_divider($btn_colour); ?>
                        <?php if ( $data['text'] ) : ?>
                            <p class="cta__text"><?php echo $data['text']; ?></p>
                        <?php endif; ?>
                        <?php
                            if ( $data['button'] ) {
                                render_svg_button($data['button']['url'], $data['button']['title'], 'big', $btn_colour, $btn_colour_hover, $data['tracking_id']);
                            } 
                        ?>
                    </div>
        
                    <div class="cta__img-col cta__img-col--2 | col-lg-4 u-hide-mobile">
                        <?php if ( $data['image_2'] ) : ?>
                            <img src="<?php echo $data['image_2']['sizes']['three-cols']; ?>" alt="<?php echo $data['image_2']['alt']; ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
        
                </div>
            </div>
        </div>

        <img src="<?php images_folder(); ?>borders/bottom_cta_<?php echo $data['bg_colour']; ?>.svg" class="cta__bottom">

    </section>

<?php endif; ?>