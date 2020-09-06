<?php

add_action('init', 'trucking_kingcomposer_init');
function trucking_kingcomposer_init() {
    if ( function_exists( 'kc_add_icon' ) ) {
    	$css_folder = trucking_get_css_folder();
		$min = trucking_get_asset_min();
        kc_add_icon( $css_folder . '/font-monia'.$min.'.css' );
    }
 
}