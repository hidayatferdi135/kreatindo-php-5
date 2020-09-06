<?php

if ( ! function_exists( 'trucking_body_classes' ) ) {
	function trucking_body_classes( $classes ) {
		global $post;
		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'apus_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
			$transparent_header = get_post_meta( $post->ID, 'apus_page_transparent_header', true );
			if ($transparent_header == 'yes') {
				$classes[] = 'transparent-header';
			}
		}
		if ( trucking_get_config('preload') ) {
			$classes[] = 'apus-body-loading';
		}
		if ( trucking_get_config('image_lazy_loading') ) {
			$classes[] = 'image-lazy-loading';
		}
		return $classes;
	}
	add_filter( 'body_class', 'trucking_body_classes' );
}

if ( ! function_exists( 'trucking_get_shortcode_regex' ) ) {
	function trucking_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

if ( ! function_exists( 'trucking_tagregexp' ) ) {
	function trucking_tagregexp() {
		return apply_filters( 'trucking_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|trucking_media' );
	}
}

if ( !function_exists('trucking_class_container_vc') ) {
	function trucking_class_container_vc($class, $isfullwidth, $post_type) {
		global $post;
		$fullwidth = false;
		if ( $post_type == 'apus_megamenu' ) {
			$fullwidth = false;
		} elseif ( $post_type == 'apus_footer' ) {
			$fullwidth = true;
		} else {
			if ( is_page() ) {
				$fullwidth  = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
				if ( $fullwidth == 'no' ) {
					$fullwidth = false;
				} else {
					$fullwidth = true;
				}
			} elseif ( is_woocommerce() ) {
				if ( is_singular('product') ) {
					$fullwidth  = trucking_get_config( 'product_single_fullwidth', false );
				} else {
					$fullwidth  = trucking_get_config( 'product_archive_fullwidth', false );
				}
			} else {
				if ( is_singular('post') ) {
					$fullwidth  = trucking_get_config( 'post_single_fullwidth', false );
				} else {
					$fullwidth  = trucking_get_config( 'post_archive_fullwidth', false );
				}
			}
		}

		if ( !$fullwidth || !$isfullwidth ) {
			return 'apus-'.$class;
		}
		return $class;
	}
}
add_filter( 'trucking_class_container_vc', 'trucking_class_container_vc', 1, 3);

if ( !function_exists('trucking_get_header_layouts') ) {
	function trucking_get_header_layouts() {
		$headers = array();
		$files = glob( get_template_directory() . '/headers/*.php' );
	    if ( !empty( $files ) ) {
	        foreach ( $files as $file ) {
	        	$header = str_replace( '.php', '', basename($file) );
	            $headers[$header] = $header;
	        }
	    }
		return $headers;
	}
}

if ( !function_exists('trucking_get_header_layout') ) {
	function trucking_get_header_layout() {
		global $post;
		if (is_object($post)) {
			if ( is_page() && is_object($post) && isset($post->ID) ) {
				return trucking_page_header_layout();
			}
		}
		return trucking_get_config('header_type');
	}
	add_filter( 'trucking_get_header_layout', 'trucking_get_header_layout' );
}

if ( !function_exists('trucking_get_footer_layouts') ) {
	function trucking_get_footer_layouts() {
		$footers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('trucking_get_footer_layout') ) {
	function trucking_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'apus_page_footer_type', true );
				if ( $footer == 'global' ) {
					return trucking_get_config('footer_type', '');
				}
			}
			return $footer;
		}
		return trucking_get_config('footer_type', '');
	}
	add_filter('trucking_get_footer_layout', 'trucking_get_footer_layout');
}

if ( !function_exists('trucking_blog_content_class') ) {
	function trucking_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( trucking_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'trucking_blog_content_class', 'trucking_blog_content_class', 1 , 1  );


if ( !function_exists('trucking_get_blog_layout_configs') ) {
	function trucking_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = trucking_get_config('blog_'.$page.'_left_sidebar');
		$right = trucking_get_config('blog_'.$page.'_right_sidebar');

		switch ( trucking_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
		 		break;
		 	case 'main-right':
		 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
 			case 'left-main-right':
 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
		 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
 				break;
		 	default:
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 		break;
		}

		return $configs; 
	}
}
if ( !function_exists('trucking_get_blog_sidebar') ) {
	function trucking_get_blog_sidebar() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		switch ( trucking_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
		 		$configs = 'left-main';
		 		break;
		 	case 'main-right':
		 		$configs = 'main-right';
		 		break;
	 		case 'main':
	 			$configs = '';
	 			break;
 			case 'left-main-right':
 				$configs = 'left-main-right';
 				break;
		 	default:
		 		$configs = '';
		 		break;
		}
		return $configs; 
	}
}

if ( !function_exists('trucking_page_content_class') ) {
	function trucking_page_content_class( $class ) {
		global $post;
		if ( is_object($post) ) {
			$fullwidth = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
			if ( !$fullwidth || $fullwidth == 'no' ) {
				return $class;
			}
		}
		return 'container-fluid';
	}
}
add_filter( 'trucking_page_content_class', 'trucking_page_content_class', 1 , 1  );

if ( !function_exists('trucking_get_page_layout_configs') ) {
	function trucking_get_page_layout_configs() {
		global $post;
		if ( is_object($post) ) {
			$left = get_post_meta( $post->ID, 'apus_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'apus_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'apus_page_layout', true ) ) {
			 	case 'left-main':
			 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-3'  );
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-9' );
			 		break;
			 	case 'main-right':
			 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-3' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-9' );
			 		break;
		 		case 'main':
		 			$configs['main'] = array( 'class' => 'clearfix' );
		 			break;
	 			case 'left-main-right':
	 				$configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-3'  );
			 		$configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-3' ); 
			 		$configs['main'] = array( 'class' => 'col-md-6 col-sm-6' );
	 				break;
			 	default:
			 		$configs['main'] = array( 'class' => 'col-md-12' );
			 		break;
			}
		} else {
			$configs['main'] = array( 'class' => 'col-md-12' );
		}
		return $configs; 
	}
}

if ( !function_exists('trucking_page_header_layout') ) {
	function trucking_page_header_layout() {
		global $post;
		$header = get_post_meta( $post->ID, 'apus_page_header_type', true );
		if ( $header == 'global' ) {
			return trucking_get_config('header_type');
		}
		return $header;
	}
}

if ( ! function_exists( 'trucking_get_first_url_from_string' ) ) {
	function trucking_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		$link_return = ( ! empty( $link[0] ) ) ? $link[0] : false;
		$content = str_replace($link_return, "", $string);
        $content = apply_filters( 'the_content', $content);
        return array( 'link' => $link_return, 'content' => $content );
	}
}

if ( !function_exists( 'trucking_get_link_attributes' ) ) {
	function trucking_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );

		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}

if ( !function_exists( 'trucking_post_media' ) ) {
	function trucking_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = trucking_get_first_url_from_string( $content );
		$media = $media['link'];
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = trucking_get_shortcode_regex( trucking_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}

if ( !function_exists( 'trucking_post_gallery' ) ) {
	function trucking_post_gallery( $content, $args = array() ) {
		$output = '';
		$defaults = array( 'size' => 'large' );
		$args = wp_parse_args( $args, $defaults );
	    $gallery_filter = trucking_gallery_from_content( $content );
	    if (count($gallery_filter['ids']) > 0) {
        	$output .= '<div class="slick-carousel" data-carousel="slick" data-smallmedium="1" data-extrasmall="1" data-items="1"  data-pagination="false" data-nav="true">';
                foreach($gallery_filter['ids'] as $attach_id) {
                    $output .= '<div class="gallery-item">';
                    $output .= wp_get_attachment_image($attach_id, $args['size'] );
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        return $output;
	}
}

if (!function_exists('trucking_gallery_from_content')) {
    function trucking_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

if ( !function_exists( 'trucking_random_key' ) ) {
    function trucking_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('trucking_substring') ) {
    function trucking_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}

if ( !function_exists( 'trucking_autocomplete_search' ) ) {
    function trucking_autocomplete_search() {

        if ( !is_admin() && trucking_get_global_config('autocomplete_search') ) {
        	$js_folder = trucking_get_js_folder();
			$min = trucking_get_asset_min();
            wp_register_script( 'trucking-autocomplete-js', $js_folder . '/autocomplete-search-init'.$min.'.js', array('jquery','jquery-ui-autocomplete'), null, true);
            wp_enqueue_script( 'trucking-autocomplete-js' );

            add_action( 'wp_ajax_trucking_autocomplete_search', 'trucking_autocomplete_suggestions' );
            add_action( 'wp_ajax_nopriv_trucking_autocomplete_search', 'trucking_autocomplete_suggestions' );
        }
    }
}
add_action( 'init', 'trucking_autocomplete_search' );

if ( !function_exists( 'trucking_autocomplete_suggestions' ) ) {
    function trucking_autocomplete_suggestions() {
        // Query for suggestions
        $args = array( 's' => $_REQUEST['term'] );
        if ( isset($_REQUEST['post_type']) ) {
        	$args['post_type'] = $_REQUEST['post_type'];
        }
        if ( isset($_REQUEST['category']) ) {
        	
        	if ( $args['post_type'] == 'product' ) {
        		$args['product_cat'] = $_REQUEST['category'];
        	} else {
        		$args['category'] = $_REQUEST['category'];
        	}
        }
        if ( !isset($args['post_type']) ) {
        	$args['post_type'] = array( 'post', 'product' );
        }
        $posts = get_posts( $args );
        $suggestions = array();
        $show_image = trucking_get_config('show_search_product_image');
        $show_price = trucking_get_config('search_type') == 'product' ? trucking_get_config('show_search_product_price') : false;
        global $post;
        foreach ($posts as $post): setup_postdata($post);
            
            $suggestion = array();
            $suggestion['label'] = esc_html($post->post_title);
            $suggestion['link'] = get_permalink();
            if ( $show_image && has_post_thumbnail( $post->ID ) ) {
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
                $suggestion['image'] = $image[0];
            } else {
                $suggestion['image'] = '';
            }
            if ( $show_price ) {
            	$product = new WC_Product( get_the_ID() );
                $suggestion['price'] = esc_html__('Price', 'trucking').' '.$product->get_price_html();
            } else {
                $suggestion['price'] = '';
            }

            $suggestions[]= $suggestion;
        endforeach;
        
        $response = $_GET["callback"] . "(" . json_encode($suggestions) . ")";
        echo trim($response);
     
        exit;
    }
}


function trucking_next_post_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'post') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="next-post post-nav">
	        <a class="btn btn-theme btn-outline" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
	            '.esc_html__('Next', 'trucking').'
	        </a>
        </div>';
    
}

add_filter( 'next_post_link', 'trucking_next_post_link', 100, 5 );

function trucking_previous_post_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'post') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    return '<div class="previous-post post-nav">
	        <a class="btn btn-theme btn-outline" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
	            '.esc_html__('Prev', 'trucking').'
	        </a>
        </div>';
    
}
add_filter( 'previous_post_link', 'trucking_previous_post_link', 100, 5 );


function trucking_get_css_folder() {
	return get_template_directory_uri() . '/css';
}

function trucking_get_js_folder() {
	if ( defined('TRUCKING_MIN_CSS_JS') && TRUCKING_MIN_CSS_JS ) {
		return get_template_directory_uri() . '/js/min';
	}
	return get_template_directory_uri() . '/js';
}

function trucking_set_js_folder() {
	return get_template_directory() . '/js';
}
add_filter( 'apus-themer-js-folder', 'trucking_set_js_folder');

function trucking_set_js_folder_min() {
	return get_template_directory() . '/js/min';
}
add_filter( 'apus-themer-js-folder-min', 'trucking_set_js_folder_min');

function trucking_get_asset_min() {
	if ( defined('TRUCKING_MIN_CSS_JS') && TRUCKING_MIN_CSS_JS ) {
		return '.min';
	}
	return '';
}