<?php

if ( !function_exists( 'trucking_footer_metaboxes' ) ) {
	function trucking_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'trucking' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'lighting' => esc_html__('Lighting', 'trucking'),
					'dark' => esc_html__('Dark', 'trucking')
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'trucking' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'trucking_footer_metaboxes' );
