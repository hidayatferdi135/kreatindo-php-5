<?php

if ( !function_exists( 'trucking_page_metaboxes' ) ) {
	function trucking_page_metaboxes(array $metaboxes) {
		global $wp_registered_sidebars;
        $sidebars = array();

        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'trucking' )), trucking_get_header_layouts() );
        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'trucking' )), trucking_get_footer_layouts() );

		$prefix = 'apus_page_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Select Layout', 'trucking' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'trucking'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'trucking'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'trucking'),
					'left-main-right' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'trucking')
				)
			),
			array(
                'id' => $prefix.'fullwidth',
                'type' => 'select',
                'name' => esc_html__('Is Full Width?', 'trucking'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'trucking'),
                    'yes' => esc_html__('Yes', 'trucking')
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'trucking'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'trucking'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'trucking'),
                'options' => array(
                    'no' => esc_html__('No', 'trucking'),
                    'yes' => esc_html__('Yes', 'trucking')
                ),
                'default' => 'yes',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'trucking')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'trucking')
            ),
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'trucking'),
                'description' => esc_html__('Choose a header for your website.', 'trucking'),
                'options' => $headers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'transparent_header',
                'type' => 'select',
                'name' => esc_html__('Transparent Header ?', 'trucking'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'trucking'),
                    'yes' => esc_html__('Yes', 'trucking')
                )
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'trucking'),
                'description' => esc_html__('Choose a footer for your website.', 'trucking'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'trucking'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'trucking')
            )
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'trucking' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'trucking_page_metaboxes' );

if ( !function_exists( 'trucking_cmb2_style' ) ) {
	function trucking_cmb2_style() {
		wp_enqueue_style( 'trucking-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'trucking_cmb2_style' );


