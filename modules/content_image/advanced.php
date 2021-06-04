<?php 
    // Change container class depending on number of buttons
    if ( ! $data['add_button'] && ! $data['add_extra_button'] ) { // If no button
        $buttons = 'no-buttons';
    } else if ( $data['add_button'] && ! $data['add_extra_button'] ) { // If one button
        $buttons = 'has-button';
    } else if ($data['add_button'] && $data['add_extra_button'] ) { // If both buttons
        $buttons = 'has-buttons';
    }

    // Add rotation animation classes, depending on text/image alignment.
    $img_col_rotation = 'js-rotate-clock';
    $text_col_rotation = 'js-rotate-anticlock';
    if ( $data['layout'] == 'text_right' ) {
        $img_col_rotation = 'js-rotate-anticlock';
        $text_col_rotation = 'js-rotate-clock';
    }
?>

<section <?php echo $id_string; ?> class="con-img | <?php echo $align_class; ?> js-hidden">
    <div class="container | js-rotate-trigger">
        <div class="row">
            
            <div class="con-img__content-col con-img__content-col--<?php echo $data['box_colour'] . ' | ' . $buttons . ' ' . $text_col_rotation; ?>">
                <div class="con-img__content-inner">
                    <?php if ($data['title']) : ?>
                        <h2 class="con-img__content-col__title"><?php echo $data['title']; ?></h2>
                        <?php
                            if ($data['box_colour'] == 'blue') {
                                render_wave_divider('white');
                            } else {
                                render_wave_divider('blue');
                            }
                        ?>
                    <?php endif; ?>
                    <?php if ($data['subheading']) : ?>
                        <h3 class="con-img__content-col__subheading"><?php echo $data['subheading']; ?></h3>
                    <?php endif; ?>
                    <div class="con-img__content-col__content | c-wysiwyg"><?php echo $data['content']; ?></div>
                </div>
                <?php // Render first button
                    if ( $data['add_button'] && $data['link'] ) {
                        $link = $data['link']['url'];
                        $text = $data['link']['title'];
                        $target = $data['link']['target'];
                        $button_size = ( $data['button_size'] ) ? 'big' : 'small';

                        if ($data['tracking_id']) {
                            render_svg_button($link, $text, 'small', 'blue', 'yellow', $data['tracking_id'], $target);
                        } else {
                            render_svg_button($link, $text, 'small', 'blue', 'yellow', null, $target);
                        }
                    }
                    
                    // Render second button
                    if ( $data['add_extra_button'] && $data['button_2'] ) {
                        $link = $data['button_2']['url'];
                        $text = $data['button_2']['title'];
                        $target = $data['button_2']['target'];
                        $button_size = ( $data['button_2_size'] ) ? 'big' : 'small';

                        render_svg_button($link, $text, 'small', 'blue', 'yellow', null, $target);
                    }
                ?>
            </div>

            <div class="con-img__img-col | <?php echo $img_col_rotation; ?>">
                <img src="<?php echo $data['image']['sizes']['large']; ?>" alt="<?php echo $data['image']['alt']; ?>" loading="lazy">
            </div>

        </div>
    </div>

    <?php if ($data['leaf']) : ?>
        <img src="<?php images_folder(); ?>small-leaf.png" class="con-img__leaf | js-prlx" loading="lazy">
    <?php endif; ?>

</section>