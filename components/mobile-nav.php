<div class="nav">
    <div class="nav__close-container | container">
        <a href="#" class="nav__close | js-nav-toggle">&times;</a>
    </div>
    <div class="nav__inner">
        
        <div class="nav__menu">
            <?php 
                $links = get_field('nav_menu', 'option');
                foreach( $links as $link ) {
                    $link = $link['link'];
                    ?>
                        <a class="nav__link" href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a>
                    <?php
                }
            ?>
        </div>

        <div class="nav__socials">
            <?php if ( get_field('instagram', 'option') ) : ?>
                <a href="<?php the_field('instagram', 'option'); ?>" target="_blank" class="c-social-link">
                    <img class="default" src="<?php images_folder(); ?>buttons/social-ig.svg" alt="Instagram">
                    <img class="hover" src="<?php images_folder(); ?>buttons/social-ig-hov.svg" alt="Instagram">
                </a>
            <?php endif; ?>

            <?php if ( get_field('facebook', 'option') ) : ?>
                <a href="<?php the_field('facebook', 'option'); ?>" target="_blank" class="c-social-link">
                    <img class="default" src="<?php images_folder(); ?>buttons/social-fb.svg" alt="Facebook">
                    <img class="hover" src="<?php images_folder(); ?>buttons/social-fb-hov.svg" alt="Facebook">
                </a>
            <?php endif; ?>

            <?php if ( get_field('twitter', 'option') ) : ?>
                <a href="<?php the_field('twitter', 'option'); ?>" target="_blank" class="c-social-link">
                    <img class="default" src="<?php images_folder(); ?>buttons/social-twitter.svg" alt="Twitter">
                    <img class="hover" src="<?php images_folder(); ?>buttons/social-twitter-hov.svg" alt="Twitter">
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>