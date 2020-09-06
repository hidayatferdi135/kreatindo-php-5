<?php

	add_filter( 'apus_themer_kingcomposer_map_element_features_box', 'apus_themer_kingcomposer_map_element_features_box');
	function apus_themer_kingcomposer_map_element_features_box($args) {
		return array(
			'name' => esc_html__( 'Apus Features Box', 'trucking' ),
			'title' => esc_html__( 'Apus Features Box Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'Display Features Box.', 'trucking' ),
			'params' => array(
				array(
		            'type'            => 'group',
		            'label'            => esc_html__('Features Items', 'trucking'),
		            'name'            => 'features',
		            'params' => array(
		                array(
			                "type" => "text",
			                "class" => "",
			                "label" => esc_html__('Title','trucking'),
			                "name" => "title",
			            ),
			            array(
			                "type" => "textarea",
			                "class" => "",
			                "label" => esc_html__('Description', 'trucking'),
			                "name" => "description",
			            ),
						array(
							"type" => "icon_picker",
							"label" => esc_html__("Icon Font", 'trucking'),
							"name" => "icon",
							'relation'		=> array(
								'parent'	=> 'show_icon',
								'show_when' => 'yes',
							),
						),
						array(
							"type" => "attach_image",
							"description" => esc_html__("If you upload an image, icon will not show.", 'trucking'),
							"name" => "image",
							'label'	=> esc_html__('Image', 'trucking' )
						),
						array(
							"type" => "attach_image",
							"description" => esc_html__("If you upload an image, icon will not show.", 'trucking'),
							"name" => "image_hover",
							'label'	=> esc_html__('Image Hover', 'trucking' )
						),
		            ),
		        ),
		        array(
	                'name' => 'columns',
	                'label' => esc_html__( 'Number Column' ,'trucking' ),
	                'type' => 'number_slider',
	                'options' => array(
	                    'min' => 1,
	                    'max' => 6,
	                    'unit' => '',
	                    'show_input' => true
	                ),
	                'value' => 1
	            ),
	           	array(
	                "type" => "dropdown",
	                "label" => esc_html__('Style','trucking'),
	                "name" => 'style',
	                'options' 	=> array(
						'default' => esc_html__('Default ', 'trucking'), 
						'style_1' => esc_html__('Style 1 ', 'trucking')
					)
	            )
			)
		);
	}
	add_filter( 'apus_themer_kingcomposer_map_element_testimonials', 'apus_themer_kingcomposer_map_element_testimonials');
	function apus_themer_kingcomposer_map_element_testimonials($args) {
		$layouts = array(
			'grid' => esc_html__( 'Grid', 'trucking' ),
			'carousel' => esc_html__( 'Carousel', 'trucking' ),
			'list' => esc_html__( 'List', 'trucking' )
		);
		return array(
			'name' => esc_html__( 'Apus Testimonials', 'trucking' ),
			'title' => esc_html__( 'Apus Testimonials Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'List of testimonials with more layouts.', 'trucking' ),
			'params' => array(
				array(
					"type" => "text",
					"label" => esc_html__("Title", 'trucking'),
					"name" => "title",
					"admin_label"	=> true,
				),
		        array(
		            'type'            => 'group',
		            'label'            => esc_html__('Testimonial Items', 'trucking'),
		            'name'            => 'testimonials',
		            'params' => array(
		                array(
							"type" => "attach_image",
							"label" => esc_html__('Photo', 'trucking'),
							"name" => 'image',
							"value" => '',
						),
						array(
		                    'type' => 'text',
		                    'label' => esc_html__( 'Name', 'trucking' ),
		                    'name' => 'name',
		                    'admin_label' => true,
		                ),
		                array(
		                    'type' => 'text',
		                    'label' => esc_html__( 'Job', 'trucking' ),
		                    'name' => 'job',
		                    'admin_label' => true,
		                ),
		                array(
		                    'type' => 'textarea',
		                    'label' => esc_html__( 'Content', 'trucking' ),
		                    'name' => 'content',
		                    'admin_label' => true,
		                ),
		            ),
		        ),
	            array(
	                'name' => 'columns',
	                'label' => esc_html__( 'Grid Column' ,'trucking' ),
	                'type' => 'number_slider',
	                'options' => array(
	                    'min' => 1,
	                    'max' => 6,
	                    'unit' => '',
	                    'show_input' => true
	                ),
	                "admin_label" => true
	            ),
				array(
	                'name' => 'layout_type',
	                'label' => esc_html__( 'Layout Type' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => $layouts
	            ),
	            array(
		                'name' => 'style',
		                'label' => esc_html__( 'Style Items' ,'trucking' ),
		                'type' => 'select',
		                'admin_label' => true,
		                'options' => array(
		                    '' => esc_html__( 'Default' , 'trucking' ),
		                    'style1' => esc_html__( 'Small' , 'trucking' ),
		                )
		            ),
	            array(
				    'name' => 'topnav',
				    'label' => esc_html__( 'Top Next and Prev' ,'trucking' ),
				    'type' => 'select',  // USAGE CHECKBOX TYPE
				    'admin_label' => true,
				    'options' => array(    // REQUIRED
				        0 => esc_html__('No ', 'trucking'), 
				        1 => esc_html__('Yes ', 'trucking'), 
				    ),
				)
			)
		);
	}
	add_filter( 'apus_themer_kingcomposer_map_element_brands', 'apustheme_kingcomposer_element_brands');
	function apustheme_kingcomposer_element_brands($args) {
	    return array(
			'name' => esc_html__( 'Apus Brands', 'trucking' ),
			'title' => esc_html__( 'Apus Brands Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'List of brands with more layouts.', 'trucking' ),
			'params' => array(
				array(
					"type" => "text",
					"label" => esc_html__("Title", 'trucking'),
					"name" => "title",
					"admin_label"	=> true
				),
		        array(
		            'type' => 'group',
		            'label' => esc_html__('Brand Items', 'trucking'),
		            'name' => 'brands',
		            'params' => array(
		                array(
							"type" => "attach_image",
							"label" => esc_html__('Photo', 'trucking'),
							"name" => 'image',
						),
		                array(
		                    'type' => 'text',
		                    'label' => esc_html__( 'Link', 'trucking' ),
		                    'name' => 'link',
		                    'admin_label' => true,
		                )
		            ),
		        ),
	            array(
	                'name' => 'columns',
	                'label' => esc_html__( 'Grid Column', 'trucking' ),
	                'type' => 'number_slider',
	                'options' => array(
	                    'min' => 1,
	                    'max' => 6,
	                    'unit' => '',
	                    'show_input' => true
	                ),
	                "admin_label" => true,
	                'value' => 3
	            ),
	            array(
	                'name' => 'rows',
	                'label' => esc_html__( 'Rows', 'trucking' ),
	                'type' => 'number_slider',
	                'options' => array(
	                    'min' => 1,
	                    'max' => 6,
	                    'unit' => '',
	                    'show_input' => true
	                ),
	                "admin_label" => true,
	                'value' => 1
	            )
			)
		);
	}

	add_filter( 'apus_themer_kingcomposer_map_element_counter', 'apustheme_kingcomposer_counter');
	function apustheme_kingcomposer_counter($args) {
		return array(
			'name' => esc_html__( 'Apus Counter', 'trucking' ),
			'title' => esc_html__( 'Apus Counter Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'Display counter number.', 'trucking' ),
			'params' => array(
		        array(
					"type" => "text",
					"label" => esc_html__("Title", 'trucking'),
					"name" => "title",
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"label" => esc_html__("Description", 'trucking'),
					"name" => "description",
				),
				array(
					"type" => "text",
					"label" => esc_html__("Number", 'trucking'),
					"name" => "number",
				),
				array(
					"type" => "text",
					"label" => esc_html__("Sub Number", 'trucking'),
					"name" => "subnumber",
				),
				array(
					'name'		=> 'show_icon',
					'label'		=> esc_html__( 'Display Icon Or Image', 'trucking' ),
					'type'		=> 'toggle',
					'value'		=> 'no',
					'relation'	=> array(
						'parent'	=> 'layout',
						'show_when'	=> array( '1','2','4','5' )
					)
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'trucking'),
					"name" => "image",
					'label'	=> esc_html__('Image', 'trucking' ),
					'relation'	=> array(
						'parent'	=> 'show_icon',
						'show_when'	=> 'yes'
					)
				),
				array(
					'name'		=> 'icon',
					'label'		=> esc_html__( 'Icon', 'trucking' ),
					'type'		=> 'icon_picker',
					'relation'	=> array(
						'parent'	=> 'show_icon',
						'show_when'	=> 'yes'
					)
				),
			)
		);
	}

	add_filter( 'apus_themer_kingcomposer_map_element_google_map', 'apustheme_kingcomposer_google_map');
	function apustheme_kingcomposer_google_map($args) {
		$styles = array();
		if (is_admin()) {
			$full_styles = Apus_Google_Maps_Styles::styles();
			foreach ($full_styles as $style) {
				$styles[$style['slug']] = $style['title'];
			}
		}
		return array(
	        'name' => esc_html__( 'Apus Google Map', 'trucking' ),
	        'description' => esc_html__('Display Google Map ... in frontend', 'trucking'),
	        'icon' => 'sl-paper-plane',
	        'category' => 'Elements',
	        'params' => array(
	        	array(
		            'type' => 'group',
		            'label' => esc_html__('Address', 'trucking'),
		            'name' => 'addresses',
		            'params' => array(
		                array(
							'name' => 'latitude',
							'label' => esc_html__("Latitude", 'trucking'),
							'type' => 'text',
							'value' => '40.722701'
						),
						array(
							'name' => 'longitude',
							'label' => esc_html__("Longitude", 'trucking'),
							'type' => 'text',
							'value' => '-73.994701'
						),
		            ),
		        ),
				array(
					'name' => 'advanced',
					'label' => esc_html__("Use Custom Marker Icon", 'trucking'),
					'type' => 'toggle',
					'description' => esc_html__('If you want to custom marker icon', 'trucking')
				),
				array(
					"type" => "attach_image",
					"label" => esc_html__('Marker Icon', 'trucking'),
					"name" => 'marker_icon',
					'relation' => array(
						'parent' => 'advanced',
						'show_when' => 'yes'
					),
				),
				array(
					'name' => 'map_height',
					'label' => esc_html__("Map Height", 'trucking'),
					'type' => 'text',
					'value' => '500'
				),
				array(
					'name' => 'map_zoom',
					'label' => esc_html__("Map Zoom", 'trucking'),
					'type' => 'text',
					'value' => '14'
				),
				array(
	                'name' => 'map_style',
	                'label' => esc_html__( 'Map Style', 'trucking' ),
	                'type' => 'select',
	                'options' => $styles,
	                'value' => 'cool-grey'
	            ),
	            array(
					'name' => 'map_key',
					'label' => esc_html__("Map API Key", 'trucking'),
					'type' => 'text',
					'value' => 'AIzaSyAgLtmIukM56mTfet5MEoPsng51Ws06Syc'
				),
	        )
	    );
	}

	if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action('init', 'trucking_woocommerce_kingcomposer_map', 100 );
	    function trucking_woocommerce_kingcomposer_map() {
	    	global $kc;
	    	if ( !is_object($kc) ) {
		    	return;
		    }
	    	$kc->add_map( array('woo_products_package' => array(
	            'name' => esc_html__( 'Apus Products Package', 'trucking' ),
	            'description' => esc_html__('Display Products Package in frontend', 'trucking'),
	            'icon' => 'sl-paper-plane',
	            'category' => 'Woocommerce',
	            'params' => array(
	                array(
	                    'type'          => 'autocomplete',
	                    'label'         => esc_html__('Choose Products', 'trucking'),
	                    'name'          => 'product_special',
	                    'options'       => array(
	                        'multiple'      => true,
	                        'post_type'     => 'product',
	                    ),
	                ),

	                array(
	                    'name' => 'star_number',
	                    'label' => esc_html__( 'Star Number', 'trucking' ),
	                    'type' => 'number_slider',
	                    'options' => array(
	                        'min' => 1,
	                        'max' => 5,
	                        'unit' => '',
	                        'show_input' => true
	                    ),
						'value' => 1
	                ),
	                array(
		                'name' => 'featrue',
		                'label' => esc_html__( 'Featrue' ,'trucking' ),
		                'type' => 'select',
		                'admin_label' => true,
		                'options' => array(
		                    '' => esc_html__( 'Default' , 'trucking' ),
		                    'feature' => esc_html__( 'Featrue' , 'trucking' ),
		                )
		            ),
	            )
	        )));
	    }
	}

	add_action('init', 'trucking_kingcomposer_maps', 99 );
	function trucking_kingcomposer_maps() {
		global $kc;
		if ( !is_object($kc) ) {
	    	return;
	    }
		// element heading title
	    $kc->add_map( array('element_heading_title' => array(
	        'name' => 'Apus Heading Title',
	        'description' => esc_html__('Display Heading Title in frontend', 'trucking'),
	        'icon' => 'sl-paper-plane',
	        'category' => 'Elements',
	        'params' => array(
	            array(
	                'name' => 'title',
	                'label' => esc_html__( 'Title', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
	                'name' => 'sub_title',
	                'label' => esc_html__( 'Sub Title', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
					"type" => "attach_image",
					"label" => esc_html__('Marker Icon', 'trucking'),
					"name" => 'marker_icon',
				),
	            array(
	                'name' => 'style',
	                'label' => esc_html__( 'Style' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => array(
	                    'style_1' => esc_html__( 'Style 1' , 'trucking' ),
	                    'style_2' => esc_html__( 'Style 2' , 'trucking' ),
	                    'style_3' => esc_html__( 'Style 3' , 'trucking' ),
	                    'style_4' => esc_html__( 'Style 4 (white)' , 'trucking' ),
	                    'style_5' => esc_html__( 'Style 5 (Black)' , 'trucking' ),
	                    'line-center' => esc_html__( 'Line Center' , 'trucking' ),
	                )
	            ),
	        )
	    )));
		$kc->add_map( array('element_banners' => array(
	        'name' => 'Apus Banner',
	        'description' => esc_html__('Display Banner in frontend', 'trucking'),
	        'icon' => 'sl-paper-plane',
	        'category' => 'Elements',
	        'params' => array(
	        	array(
	                'name' => 'number',
	                'label' => esc_html__( 'Number', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
	                'name' => 'title',
	                'label' => esc_html__( 'Title', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
					"type" => "attach_image",
					"label" => esc_html__('Marker Icon', 'trucking'),
					"name" => 'marker_icon',
				),
	            array(
	                "type" => "textarea",
	                "class" => "",
	                "label" => esc_html__('Description', 'trucking'),
	                "name" => "description",
	            ),
	            array(
	                'name' => 'readmore',
	                'label' => esc_html__( 'Link Read More', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
	                'name' => 'style',
	                'label' => esc_html__( 'Style' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => array(
	                    '' => esc_html__( 'Default' , 'trucking' ),
	                    'style_transparent' => esc_html__( 'Transparent' , 'trucking' ),
	                    'normal' => esc_html__( 'Normal' , 'trucking' ),
	                )
	            ),
	        )
	    )));


		$kc->add_map( array('element_mapbox' => array(
	        'name' => 'Apus Map Box',
	        'description' => esc_html__('Display Map Box in frontend', 'trucking'),
	        'icon' => 'sl-paper-plane',
	        'category' => 'Elements',
	        'params' => array(
	        	array(
					"type" => "attach_image",
					"label" => esc_html__('Images Banner', 'trucking'),
					"name" => 'marker_icon',
				),
	            array(
	                'name' => 'title',
	                'label' => esc_html__( 'Title', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
	                "type" => "text",
	                "label" => esc_html__('Location', 'trucking'),
	                "name" => "location",
	            ),
	            array(
	                "type" => "text",
	                "label" => esc_html__('Phone', 'trucking'),
	                "name" => "phone",
	            ),
	            array(
	                "type" => "text",
	                "label" => esc_html__('Email', 'trucking'),
	                "name" => "email",
	            ),
	        )
	    )));

		$kc->add_map( array('element_callaction' => array(
	        'name' => 'Apus Call to Acction',
	        'description' => esc_html__('Display Call to Action in frontend', 'trucking'),
	        'icon' => 'sl-paper-plane',
	        'category' => 'Elements',
	        'params' => array(
	            array(
	                'name' => 'title',
	                'label' => esc_html__( 'Title', 'trucking' ),
	                'type' => 'text'
	            ),
	            array(
	                "type" => "textarea",
	                "class" => "",
	                "label" => esc_html__('Description', 'trucking'),
	                "name" => "description",
	            ),
	            array(
	                'name' => 'readmore',
	                'label' => esc_html__( 'Link Read More', 'trucking' ),
	                'type' => 'text'
	            ),
	             array(
	                'name' => 'request',
	                'label' => esc_html__( 'Link Request More', 'trucking' ),
	                'type' => 'text'
	            ),
	        )
	    )));

		$categories = array();
		if ( is_admin() ) {
			$cats = get_categories( array(
			    'orderby' => 'name',
			    'order' => 'ASC',
			    'hide_empty' => 0,
			) );
			foreach ($cats as $cat) {
				$categories[$cat->slug] = $cat->name;
			}
		}
	    $kc->add_map( array('element_blog_posts' => array(
			'name' => esc_html__( 'Apus Blog Posts', 'trucking' ),
			'title' => esc_html__( 'Blog Posts Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'List of latest post with more layouts.', 'trucking' ),
			'params' => array(
				array(
	                'name' => 'title',
	                'label' => esc_html__( 'Title', 'trucking' ),
	                'type' => 'text'
	            ),
				array(
					'type' => 'multiple',
					'label' => esc_html__( 'Category', 'trucking' ),
					'name' => 'categories',
					'options' => $categories,
					'value' => '',
				),
	            array(
	                'name' => 'columns',
	                'label' => esc_html__( 'Grid Column' ,'trucking' ),
	                'type' => 'number_slider',
	                'options' => array(
	                    'min' => 1,
	                    'max' => 6,
	                    'unit' => '',
	                    'show_input' => true
	                ),
	                "admin_label" => true,
	                'description' => esc_html__( 'Display number of post', 'trucking' )
	            ),    
				array(
					'name' => 'number',
					'label' => esc_html__( 'Items Limit', 'trucking' ),
					'type' => 'number_slider',
					'value' => '5',
					'options' => array(
						'min' => 1,
						'max' => 10,
						'unit' => '',
						'show_input' => false
					),
					"admin_label" => true,
					'description' => esc_html__('Specify number of post that you want to show. Enter -1 to get all team', 'trucking'),
				),
				array(
					'type'			=> 'dropdown',
					'label'			=> esc_html__( 'Order by', 'trucking' ),
					'name'			=> 'order_by',
					'description'	=> esc_html__( '', 'trucking' ),
					'admin_label'	=> true,
					'options' 		=> array(
						'ID'		=> esc_html__('Post ID', 'trucking'),
						'author'	=> esc_html__('Author', 'trucking'),
						'title'		=> esc_html__('Title', 'trucking'),
						'name'		=> esc_html__('Post name (post slug)', 'trucking'),
						'type'		=> esc_html__('Post type (available since Version 4.0)', 'trucking'),
						'date'		=> esc_html__('Date', 'trucking'),
						'modified'	=> esc_html__('Last modified date', 'trucking'),
						'rand'		=> esc_html__('Random order', 'trucking'),
						'comment_count'	=> esc_html__('Number of comments', 'trucking')
					)
				),
				array(
					'type' => 'select',
					'label' => esc_html__( 'Order By', 'trucking' ),
					'name' => 'order',
					'options' => array(
						'DESC' => esc_html__( 'Descending', 'trucking' ),
						'ASC' => esc_html__( 'Ascending', 'trucking' )
					),
					'description' => ' &nbsp; '
				),
				array(
	                'name' => 'layout_type',
	                'label' => esc_html__( 'Layout Type' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => array(
						'grid' => esc_html__( 'Grid', 'trucking' ),
						'carousel' => esc_html__( 'Carousel', 'trucking' ),
						'special' => esc_html__( 'Special', 'trucking' )
					),
					'value' => 'carousel'
	            ),
	            array(
					'type' => 'select',
					'label' => esc_html__( 'Top Nav', 'trucking' ),
					'name' => 'topnav',
					'options' => array(
						'' => esc_html__( 'No', 'trucking' ),
						'topnav' => esc_html__( 'Yes', 'trucking' )
					),
				),
			)
		)));

		$kc->add_map( array('element_carousel_images' => array(
			'name' => esc_html__( 'Apus Carousel Images', 'trucking' ),
			'title' => esc_html__( 'Carousel Images Settings', 'trucking' ),
			'icon' => 'fa fa-newspaper-o',
			'category' => 'Elements',
			'wrapper_class' => 'clearfix',
			'description' => esc_html__( 'Display Carousel Images In front-end.', 'trucking' ),
			'params' => array(
	            array(
		            'type' => 'group',
		            'label' => esc_html__('Images', 'trucking'),
		            'name' => 'images',
		            'params' => array(
		                array(
							"type" => "attach_image",
							"name" => "image",
							'label'	=> esc_html__('Image', 'trucking' )
						),
						array(
							'name' => 'video_url',
							'label' => esc_html__("Video youtube url", 'trucking'),
							'type' => 'text'
						),
		            ),
		        ),
				array(
	                'name' => 'layout_type',
	                'label' => esc_html__( 'Layout Type' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => array(
						'layout1' => esc_html__( 'Layout 1', 'trucking' ),
						'layout2' => esc_html__( 'Layout 2', 'trucking' )
					),
					'value' => 'layout1'
	            ),
			)
		)));
	}


	add_action('init', 'kc_add_data', 99 );
	function kc_add_data(){
	    global $kc;
	    if ( !is_object($kc) ) {
	    	return;
	    }
	    $kc->add_map_param(
	        'kc_image_gallery',
	        array(
	            'name' => 'layout_type',
	                'label' => esc_html__( 'Layout Type' ,'trucking' ),
	                'type' => 'select',
	                'admin_label' => true,
	                'options' => array(
						'' => esc_html__( 'Default', 'trucking' ),
						'layout2' => esc_html__( 'Gutter 30', 'trucking' ),
			)
	     ), 9 );
	}
