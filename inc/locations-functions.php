<?php

/**
 * Get distance by comparing lat & long
 */

function get_distance_by_coords( $origin, $destination, $unit = 'M' ){

	$theta = $origin['lng'] - $destination['lng'];
	$dist = sin(deg2rad($origin['lat'])) * sin(deg2rad($destination['lat'])) +  cos(deg2rad($origin['lat'])) * cos(deg2rad($destination['lat'])) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	if ($unit == "K") {
	    return ($miles * 1.609344);
	} else if ($unit == "N") {
	    return ($miles * 0.8684);
	} else {
	    return $miles;
	}

	return $distance;

}


/**
 * Display location grid item
 * Used on archive page template
 */

function render_location_item($id) {
	?>
		<div class="locations-grid__item | col-md-6 col-lg-4">
			<h2><?php echo get_the_title($id); ?></h2>
			<a href="<?php the_permalink($id); ?>" class="locations-grid__item-image" aria-label="Go to <?php echo get_the_title($id); ?>">
				<img src="<?php echo get_field('thumb', $id)['sizes']['locations-thumb']; ?>" alt="<?php echo get_field('thumb', $id)['alt']; ?>" loading="lazy">
			</a>
			<p class="address"><?php the_field('address', $id); ?></p>
			<?php render_svg_button(get_permalink($id), 'Read more', 'big', 'blue', 'yellow'); ?>
		</div>
	<?php
 }




/**
 * Display locations by nearest distance to given co-ordinates.
 */

add_action('wp_ajax_sort_locations_by_distance', 'sort_locations_by_distance');
add_action('wp_ajax_nopriv_sort_locations_by_distance', 'sort_locations_by_distance');

function sort_locations_by_distance() {
	
	$user_lat_long = $_POST['latLong'];

	if (! empty($user_lat_long)) {

		// Create array to store distances
		$location_distances = array();

		// Get all active locations
		$locations = get_posts(array(
			'post_type' => 'location',
			'post_status' => 'publish',
			'numberposts' => -1
		));

		// Loop through locations and calculate distance to user zipcode
		$i = 0;
		foreach( $locations as $loc ) {
			$loc_lat_long = get_field('google_maps_link', $loc->ID);
			$distance = get_distance_by_coords($user_lat_long, $loc_lat_long);

			$location_distances[$i] = array(
				'ID' => $loc->ID,
				'distance' => $distance,
			);
			$i++;
		}

		// Re-order locations by nearest to user zipcode
		function compare_distance($a, $b) {
			return $a['distance'] - $b['distance'];
		}		
		usort($location_distances, 'compare_distance');

		// Generate location grid HTML
		ob_start();
		foreach($location_distances as $loc) {
			render_location_item($loc['ID']);
		}
		$html = ob_get_clean();
		
		// Send the html back over to js to be rendered.
		return wp_send_json($html);
	} 

	wp_die();
}



/**
 * Get all locations map data
 * Used on 'Map View' toggle on locations archive page
 */

function get_all_locations_map_data() {
    
    // Get all active locations
    $locations = get_posts(array(
        'post_type' => 'location',
        'post_status' => 'publish',
        'numberposts' => -1
    ));

    // Create array to store map data
    $map_data = array();

    $i = 0;
    foreach($locations as $loc) {
        $id = $loc->ID;

        if ( get_field('google_maps_link', $id) ) {
			$title = get_the_title($id);
			$address = get_field('address', $id);
			$url = get_permalink($id);

            $map_data[$i] = array(
                'lat' => get_field('google_maps_link', $id)['lat'],
                'lng' => get_field('google_maps_link', $id)['lng'],
				'content' => "<h1>${title}</h1><p>${address}</p><a href=".$url.">Read more</a>",
            );
        }

        $i++;
    }

    return json_encode($map_data);
}


?>