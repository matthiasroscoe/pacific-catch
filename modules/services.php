<?php

if (! $data['services_off']) :
    $first_row = $data['services_1'];
    $second_row = $data['services_2'];

    $container_class = '';
    if (! $data['subheading_1'] && ! $data['subheading_2'] ) {
        $container_class = 'no-subheadings';
    }

    if ( count($first_row) > 0 ) : ?>

    <section <?php echo $id_string; ?> class="services | <?php echo $container_class; ?>">

        <div class="services__bg | u-fluid"></div>

        <?php $title_class = ($data['subheading_1']) ? '' : 'has-large-margin'; ?>
        <h1 class="services__title | <?php echo $title_class; ?> u-px-mobile-30 js-hidden"><?php echo $data['title']; ?></h1>
        <div class="container-fluid js-hidden">
            <div class="container"> 
                <div class="services__inner | row">
                    
                    <?php if ( $data['subheading_1'] ) : ?>
                        <div class="col-12">
                            <h2 class="services__subheading services__subheading--1"><?php echo $data['subheading_1']; ?></h2>
                        </div>
                    <?php endif; ?>
                    
                    <?php foreach ( $first_row as $service ) : ?>
                        <div class="services__service services__service--1 | col-lg-4">
                            <img class="services__image | u-rad-50" src="<?php echo $service['image']['sizes']['service']; ?>" alt="<?php echo $service['image']['url']; ?>" loading="lazy">
                            <p><?php echo $service['text']; ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>

                <?php $row_class = ($data['subheading_1'])  ? '' : 'has-top-margin'; ?>
                <div class="services__inner | row <?php echo $row_class; ?>">
                    
                    <?php if ( $data['subheading_2'] ) : ?>
                        <div class="col-12">
                            <h2 class="services__subheading services__subheading--2"><?php echo $data['subheading_2']; ?></h2>
                        </div>
                    <?php endif; ?>
                        
                    <?php
                    if ( count($second_row) > 0 ) :
                        foreach ( $second_row as $service ) : ?>
                            <div class="services__service services__service--2 | col-lg-4">
                                <img class="services__image | u-rad-50" src="<?php echo $service['image']['sizes']['service']; ?>" alt="<?php echo $service['image']['url']; ?>" loading="lazy">
                                <p><?php echo $service['text']; ?></p>
                            </div>
                        <?php endforeach;
                    endif;
                    ?>

                </div>
            </div>
        </div>
    </section>

    <?php endif; 
    
endif;?>