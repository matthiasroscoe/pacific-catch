<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="format-detection" content="telephone=no">
	<meta name="format-detection" content="date=no">
	<meta name="format-detection" content="address=no">
	<meta name="format-detection" content="email=no">

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/compressed/favicon.png">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>

	<?php // Bootstrap Grid & Normalize ?>
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- FB domain verification for colibri -->
	<meta name="facebook-domain-verification" content="y1wowd2a1rsg6z6wu2ghkv7f0odd4g" />

	<?php
      if ( get_field('page_schema') ) {
        the_field('page_schema');
      }
    ?>

	<?php // Add ACF defined code to head.
		if(get_field('head_code', 'option')){
			the_field('head_code', 'option');
		}
	?>

</head>

<body <?php body_class(); ?>>

<?php // Add ACF defined code to opening body tag.
	if(get_field('after_body_code', 'option')){
		the_field('after_body_code', 'option');
	}
?>

<div id="page" class="site">

	<header id="site-header" >
		<div class="container | u-pos-rel">
			<div class="row | align-items-center justify-content-between">

				<div class="left-menu | col u-hide-tablet">
					<div class="left-menu__inner">
						<?php // Left menu items
							$lmenu = get_field('left_menu', 'option');
							if ( count($lmenu) > 0 ) {
								foreach ( $lmenu as $link ) {
									$link = $link['link'];
									?>
										<a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>" class="left-menu__link"><?php echo $link['title']; ?></a>
									<?php
								}
							}
						?>
					</div>
				</div>

				<?php if(get_field('site_logo', 'option')): ?>
					<div id="site-logo" class="col">
						<a href="<?php echo get_site_url(); ?>" title="Pacific Catch">
							<img class="logo" src="<?php the_field('site_logo', 'option') ?>" alt="Pacific Catch">
						</a>
					</div>
				<?php endif; ?>

				<div class="right-menu | col">
					<?php if ( get_field('appfront_link', 'option') ) : ?>
						<a class="takeout-delivery" target="_blank" href="<?php the_field('appfront_link', 'option'); ?>">Order Online</a>
					<?php endif; ?>
					
					<?php if ( get_field('opentable_link', 'option') ) : ?>
						<a class="book-now" href="<?php the_field('opentable_link', 'option'); ?>">Book Table</a>
					<?php endif; ?>
					
					<div class="hamburger">
						<div class="hamburger__inner | js-nav-toggle">
							<div class="line line-1"></div>
							<div class="line line-2"></div>
							<div class="line line-3"></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</header>

	<div id="content" class="site-content">
