<?php get_header(); ?>

<!-- Hero Section -->
<?php 
    $data = get_field('hero')['hero'];
    render_module('hero', $data); 
?>

<div class="container">
	<div class="row">
		<div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
			<p class="single-post-date">
				<?php echo get_the_date('j/n/Y'); ?>
			</p>
		</div>
	</div>
</div>

<?php 
	$data = get_field('text_editor')['wysiwyg'];
	render_module('wysiwyg', $data);
?>

<div class="container | mb-4">
	<div class="row">
		<div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
			<a class="single-post-back-to-blog" href="/whats-new" title="Back to What's New">Back to What's New</a>
		</div>
	</div>
</div>

<?php get_footer(); ?>