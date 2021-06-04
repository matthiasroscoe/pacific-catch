<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 */

if ( ! function_exists( 'time_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function time_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'pac_catch' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'date_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function date_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'pac_catch' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'render_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function render_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;



/**
 * Render Wave Navigation
 * Used with flickity sliders
 */

function render_wave_nav($colour = 'blue') { ?>
	<?php $wave_colour = ($colour == 'white') ? '-white' : ''; ?>
	
	<div class="c-wave-nav u-pos-rel">
		<img src="<?php images_folder(); ?>icons/wave<?php echo $wave_colour; ?>.svg" class="static u-pos-abs">
		<div class="progress u-pos-abs">
			<img src="<?php images_folder(); ?>icons/wave<?php echo $wave_colour; ?>.svg">
		</div>
	</div>
<?php }


/**
 * Render wave dividers
 * @param Colour. 'white' or 'blue'
 */

function render_wave_divider($colour = 'blue') {
	if ($colour == 'blue') {
		?>
			<img src="<?php images_folder(); ?>icons/wave-divider--blue.svg" class="c-wave-divider" loading="lazy">
		<?php
	}
	if ($colour == 'white') {
		?>
			<img src="<?php images_folder(); ?>icons/wave-divider--white.svg" class="c-wave-divider" loading="lazy">
		<?php
	}
}


/**
 * Render buttons
 * @param Link
 * @param ButtonText
 * @param ButtonSize. 'small' or 'big'
 * @param SVGColour. 'blue', 'yellow', or 'white'
 * @param SVGHoverColour. 'blue', 'yellow', or 'white'
 */

function render_svg_button($link = null, $text = 'Find out more', $size = 'small', $colour = 'blue', $hover = 'yellow', $id = null, $target = null) {
	$id_str = '';
	if ($id != null) {
		$id_str = 'id="'.$id.'"';
	}
	if ($target == null) {
		$target = '_self';
	}
	
	$btn_classList = "c-btn--${size} c-btn--${colour} c-btn--hov-${hover}";
	if ( $link != null ) {
		?>
			<a <?php echo $id_str; ?> href="<?php echo $link; ?>" target="<?php echo $target; ?>" class="c-btn <?php echo $btn_classList; ?>"><?php echo $text; ?></a>
		<?php
	}
}


/**
 * Button shortcode.
 * Used in CMS wysiwyg editors
 */

function svg_button_shortcode($atts = array()) {
	
	// default params
	extract(shortcode_atts(array(
		'link' => '#',
		'text' => 'Find out more',
	), $atts));

	return '<a href="'.$link.'" class="c-btn c-btn--big c-btn--blue c-btn--hov-yellow">'.$text.'</a>';
}

add_shortcode('button', 'svg_button_shortcode');

?>