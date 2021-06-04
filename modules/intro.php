<?php if (! $data['intro_off']) : ?>

<section <?php echo $id_string; ?> class="intro <?php if ($data['extra_images']) { echo 'intro--advanced'; } ?>">
    <img class="intro__top" src="<?php images_folder(); ?>borders/top_yellow.svg">
    <div class="intro-container | container-fluid u-px-mobile-30">

        <?php if ($data['extra_images']) : ?>
            <?php if ($data['image_1']) : 
                $img = $data['image_1']; ?>
                <img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" class="intro--advanced__img1 | u-pos-abs js-prlx--rotate" loading="lazy">
            <?php endif; ?>
            <?php if ($data['image_2']) : 
                $img = $data['image_2']; ?>
                <img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" class="intro--advanced__img2 | u-pos-abs js-prlx--rotate" loading="lazy">
            <?php endif; ?>
            <?php if ($data['image_3']) : 
                $img = $data['image_3']; ?>
                <img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['alt']; ?>" class="intro--advanced__img3 | u-pos-abs js-prlx--rotate" loading="lazy">
            <?php endif; ?>
        <?php endif; ?>

        <div class="row justify-content-center js-hidden">
            <div class="text-center col-lg-7">
                <?php if ( $data['title'] ) : ?>
                    <h2 class="intro__title"><?php echo $data['title']; ?></h2>
                <?php endif; ?>

                <?php if ( $data['content'] ) : ?>
                    <div class="intro__content | c-wysiwyg"><?php echo $data['content'] ?></div>
                <?php endif; ?>

                <?php 
                    if ( $data['button'] ) {
                        render_svg_button($data['button']['url'], $data['button']['title'], 'big', 'blue', 'white', null, $data['button']['target']);
                    }
                ?>
            </div>
        </div>
    </div>
    <img src="<?php images_folder(); ?>leaf_1.png" class="intro__leaf | js-prlx" loading="lazy">
    <img class="intro__bottom" src="<?php images_folder(); ?>borders/bottom_yellow.svg">
</section>

<?php endif; ?>