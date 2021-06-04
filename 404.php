<?php get_header(); ?>

<?php
	$data = get_field('top_banner', 'options')['top_banner'];
	$data['title'] = '404 Error';
    render_module('top_banner', $data);
?>

<section class="404-content | mb-4">
    <div class="container">
        <div class="row | justify-content-center text-center pb-4">
            <div class="col-md-8 | mb-4 pb-4">
				<p>This page could not be found.</p>
				<?php render_svg_button(get_site_url(), 'Return Home', 'big', 'blue', 'yellow'); ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>