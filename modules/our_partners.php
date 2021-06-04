<?php if (! $data['section_off']) : ?>
    <img class="our-partners__top" src="<?php images_folder(); ?>borders/wave-border-top.svg">
    <section <?php echo $id_string; ?> class="our-partners">
        <div class="container | js-hidden">
            <div class="row">
                <div class="our-partners__content | col-lg-6">
                    <h1 class="our-partners__title"><?php echo $data['title']; ?></h1>
                    <?php render_wave_divider('white'); ?>
                    <p class="our-partners__text"><?php echo $data['text']; ?></p>
                </div>
                <?php if ( count($data['logos']) > 0 ): ?>
                    <div class="our-partners__logos | col-lg-10 col-xl-9 col-xxl-8">
                        <?php foreach ( $data['logos'] as $logo ) : 
                            if ( ! empty($logo['link']) ) :
                                ?>
                                    <a class="our-partners__logos__link" href="<?php echo $logo['link']; ?>" title="<?php echo $logo['logo']['alt']; ?>" target="_blank" aria-label="View our partner's site">
                                        <img src="<?php echo $logo['logo']['sizes']['medium']; ?>" alt="<?php echo $logo['logo']['alt']; ?>" loading="lazy">
                                    </a>
                                    <?php
                            else :
                                ?>
                                    <img src="<?php echo $logo['logo']['sizes']['medium']; ?>" alt="<?php echo $logo['logo']['alt']; ?>" loading="lazy">
                                <?php
                            endif;
                        endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <img src="<?php images_folder(); ?>small-leaf.png" class="our-partners__leaf | js-prlx" loading="lazy">
    </section>
    <img class="our-partners__bottom" src="<?php images_folder(); ?>borders/wave-border-bottom.svg">
<?php endif; ?>