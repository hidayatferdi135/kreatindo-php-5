<?php

$atts  = array_merge( array(
	'addresses' => '',
	'advanced' => '',
	'marker_icon' => '',
	'map_height' => '',
	'map_zoom' => '',
	'map_style' => '',
	'map_key' => ''
), $atts);
extract( $atts );

if ( !empty($addresses) && class_exists('Apus_Google_Maps_Styles') ):
	$js_folder = trucking_get_js_folder();
	$min = trucking_get_asset_min();

	wp_enqueue_script('gmap-api', '//maps.google.com/maps/api/js?sensor=true&amp;key='.$map_key);
	wp_enqueue_script( 'trucking-google-script', $js_folder.'/google-script'.$min.'.js', array( 'jquery', 'gmap-api' ) );

	$data_marker = '';
	if ( $advanced == 'yes' && $marker_icon ) {
		$img = wp_get_attachment_image_src($marker_icon,'full');
		if (isset($img[0]) && $img[0]) {
			$data_marker = 'data-marker_icon="'.esc_url($img[0]).'"';
		}
	}
	$style = '';
	if ($map_style) {
		$style = Apus_Google_Maps_Styles::get_style($map_style);
	}
	$css = '';
	if ($map_height) {
		$css = 'style="height: '.esc_attr($map_height).'px"';
	}
	$key = apus_themer_random_key();
	$first_item = '';
?>
	<div class="widget widget-google-map">
		<?php $count = 0; foreach ($addresses as $address) {
			if ($count == 0) {
				$first_item = $address;
			}
		?>

			<div class="google-map-item-wrapper" data-latitude="<?php echo esc_attr($address->latitude); ?>" data-longitude="<?php echo esc_attr($address->longitude); ?>"></div>
		<?php $count++; } ?>
		<div id="widget-google-map<?php echo esc_attr($key); ?>" class="google-map-wrapper" <?php echo trim($css); ?>
			data-latitude="<?php echo esc_attr($first_item->latitude); ?>" data-longitude="<?php echo esc_attr($first_item->longitude); ?>"
			<?php echo trim($data_marker); ?> data-zoom="<?php echo esc_attr($map_zoom); ?>" data-style="<?php echo esc_attr($style); ?>">
		</div>
		
	</div>

<?php endif; ?>