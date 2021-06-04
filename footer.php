	</div><!-- #content -->

	<img class="footer__top" src="<?php images_folder(); ?>borders/top_blue--footer.svg">
	<footer id="site-footer" class="footer | u-px-mobile-15">
		<div class="container">
			<div class="row">
				<div class="footer__menu | col-lg-3">
					<?php 
						$fmenu = get_field('footer_menu', 'option'); 

						if ( count($fmenu) > 0 ) {
							foreach ( $fmenu as $link ) {
								?>
									<a href="<?php echo $link['link']['url']; ?>" class="footer__menu__link" title="<?php echo $link['link']['title']; ?>"><?php echo $link['link']['title']; ?></a>
								<?php 
							}
						}
					?>
					<a href="https://www.ignitehospitality.com/" class="footer__ignite pt-3" target="_blank" title="Ignite Hospitality">Website by Ignite</a>
				</div>
				
				<div class="footer__newsletter | col-lg-8 col-xl-7">
					<h3><?php the_field('newsletter_text', 'option'); ?></h3>
					<?php include('components/mailchimp.php'); ?>
				</div>
				
				<div class="footer__socials | col-lg-1 offset-xl-1">
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
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php  // Include mobile nav ?>
<?php  include('components/mobile-nav.php'); ?>

<?php wp_footer(); ?>

</body>
</html>
