
<?php 
    $row_class = '';
    $img_col_class = 'offset-lg-1';
    if ( $data['layout'] == 'text_right') {
        $row_class = 'con-img-simple__row--reversed';
        $img_col_class = '';
    }
?>

<section class="con-img-simple | u-pos-rel">

    <!-- Background leaf -->
    <img src="<?php images_folder(); ?>leaf--white.svg" class="con-img-simple__leaf | js-prlx" loading="lazy">

    <div class="container | u-px-mobile-30 js-hidden">
        
        <div class="con-img-simple__row | row <?php echo $row_class; ?>">
            <div class="con-img-simple__text-col | col-lg-4 offset-lg-1">
                <h2 class="con-img-simple__heading"><?php echo $data['title']; ?></h2>
                <div class="con-img-simple__content | c-wysiwyg"><?php echo $data['content']; ?></div>
                <?php // Render first button
                    if ( $data['add_button'] && $data['link'] ) {
                        $link = $data['link']['url'];
                        $target = $data['link']['target'];
                        $text = $data['link']['title'];
                        $button_size = ( $data['button_size'] ) ? 'big' : 'small';

                        render_svg_button($link, $text, 'small', 'blue', 'yellow', null, $target);
                    }
                ?>
            </div>
            <div class="con-img-simple__img-col <?php echo $img_col_class; ?> | col-lg-6">
                <img src="<?php echo $data['image']['sizes']['half-width']; ?>" alt="<?php echo $data['image']['alt']; ?>" loading="lazy">
            </div>
        </div>

    </div>

</section>