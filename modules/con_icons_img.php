<?php if ( ! $data['section_off'] ) : ?>
    <section class="con-icons-img">
        <div class="container-fluid | u-px-mobile-0">

            <?php // Background images
                $images = $data['images']; 
                if ( ! empty($images['image_1']) ) {
                    ?>
                        <img class="con-icons-img__img1 | js-hidden js-hidden--no-slide" src="<?php echo $images['image_1']['sizes']['half-width']; ?> " alt="<?php echo $images['image_1']['alt']; ?>" loading="lazy">
                    <?php
                }
                if ( ! empty($images['image_2']) ) {
                    ?>
                        <img class="con-icons-img__img2 | js-hidden js-hidden--no-slide" src="<?php echo $images['image_2']['sizes']['half-width']; ?> " alt="<?php echo $images['image_2']['alt']; ?>" loading="lazy">
                    <?php
                }
            ?>

            <div class="container js-hidden">
                <div class="row">
                    <div class="col-lg-9 offset-lg-2 con-icons-img__content-container">

                        <!-- <img class="rewards__roundel" src="<?php images_folder(); ?>icons/rewards-roundel.svg" alt="Pacific Catch Rewards"> -->
                        
                        <div class="con-icons-img__content">
                            <h1 class="con-icons-img__title"><?php echo $data['title']; ?></h1>
                            <?php render_wave_divider('white'); ?>
                            <div class="con-icons-img__text | c-wysiwyg"><?php echo $data['content'];; ?></div>
                            <?php 
                                if ( $data['link'] ) {
                                    render_svg_button($data['link']['url'], $data['link']['title'], 'small', 'blue', 'white', null, $data['link']['target']); 
                                }
                            ?>
                        </div>
                        
                        <?php $icons = $data['icons'];
                        if ( ! empty($icons) ) : ?>
                            <div class="con-icons-img__icons">
                                <?php foreach( $icons as $i ) : ?>
                                    <div class="icon-container">
                                        <div class="icon" style="background-image: url('<?php echo $i['icon']['url']; ?>');"></div>
                                        <p><?php echo $i['text']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <img src="<?php images_folder(); ?>leaf--rewards.png" class="con-icons-img__leaf | js-prlx--rotate" loading="lazy">
        </div>
    </section>
<?php endif; ?>