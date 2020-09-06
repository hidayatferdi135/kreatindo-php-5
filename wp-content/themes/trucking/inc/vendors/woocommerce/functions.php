<?php

function trucking_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '330',   // px
            'height'    => '330',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '660',   // px
            'height'    => '660',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '130',    // px
            'height'    => '130',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'trucking_woocommerce_setup');

if ( !function_exists('trucking_get_products') ) {
    function trucking_get_products($categories = array(), $product_type = 'featured_product', $paged = 1, $post_per_page = -1, $orderby = '', $order = '', $includes = array(), $excludes = array(), $author = null) {
        global $woocommerce, $wp_query;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );
        
        if ( isset( $args['orderby'] ) ) {
            if ( 'price' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $args['ignore_sticky_posts']=1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = array(
                             'key' => '_featured',
                             'value' => 'yes'
                         );
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'top_rate':
                add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent_product':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $args['post__in'] = $product_ids_on_sale;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c
                        WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0
                        ORDER BY c.comment_date ASC";
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $_pids;

                break;
            case 'rand':
                $args['orderby'] = 'rand';
                break;
            case 'recommended':
                $args['ignore_sticky_posts']=1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = array(
                             'key' => '_apus_recommended',
                             'value' => 'yes'
                         );
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $args['tax_query']    = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'slug',
                    'terms'         => $categories,
                    'operator'      => 'IN'
                )
            );
        }

        if (!empty($includes) && is_array($includes)) {
            $args['post__in'] = $includes;
        }
        
        if ( !empty($excludes) && is_array($excludes) ) {
            $args['post__not_in'] = $excludes;
        }

        if ( !empty($author) ) {
            $args['author'] = $author;
        }
        
        return new WP_Query($args);
    }
}

function trucking_autocomplete_options_helper( $options ){
    $output = array();
    $options = array_map('trim', explode(',', $options));
    foreach( $options as $option ){
        $tmp = explode( ":", $option );
        $output[] = $tmp[0];
    }
    return $output; 
}

// cart modal
if ( !function_exists('trucking_woocommerce_cart_modal') ) {
    function trucking_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_trucking_add_to_cart_product', 'trucking_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_trucking_add_to_cart_product', 'trucking_woocommerce_cart_modal' );


// hooks
if ( !function_exists('trucking_woocommerce_enqueue_styles') ) {
    function trucking_woocommerce_enqueue_styles() {
        $css_folder = trucking_get_css_folder();
        $js_folder = trucking_get_js_folder();
        $min = trucking_get_asset_min();

        wp_enqueue_style( 'trucking-woocommerce', $css_folder . '/woocommerce'.$min.'.css' , 'trucking-woocommerce-front' , TRUCKING_THEME_VERSION, 'all' );
        
        if ( is_singular('product') ) {
            // photoswipe
            wp_enqueue_script( 'photoswipe-js', $js_folder . '/photoswipe/photoswipe'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-ui-js', $js_folder . '/photoswipe/photoswipe-ui-default'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_script( 'photoswipe-init', $js_folder . '/photoswipe/photoswipe.init'.$min.'.js', array( 'jquery' ), '20150315', true );
            wp_enqueue_style( 'photoswipe-style', $js_folder . '/photoswipe/photoswipe'.$min.'.css', array(), '3.2.0' );
            wp_enqueue_style( 'photoswipe-skin-style', $js_folder . '/photoswipe/default-skin/default-skin'.$min.'.css', array(), '3.2.0' );
        }
        $alert_message = array(
            'success'       => sprintf( '<div class="woocommerce-message">%s <a class="button btn btn-primary btn-inverse wc-forward" href="%s">%s</a></div>', esc_html__( 'Products was successfully added to your cart.', 'trucking' ), wc_get_cart_url(), esc_html__( 'View Cart', 'trucking' ) ),
            'empty'         => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'No Products selected.', 'trucking' ) ),
            'no_variation'  => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Product Variation does not selected.', 'trucking' ) ),
        );
        wp_register_script( 'trucking-woocommerce', $js_folder . '/woocommerce'.$min.'.js', array( 'jquery' ), '20150330', true );
        wp_localize_script( 'trucking-woocommerce', 'trucking_woo', $alert_message );
        wp_enqueue_script( 'trucking-woocommerce' );

        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'trucking_woocommerce_enqueue_styles', 99 );

// cart
if ( !function_exists('trucking_woocommerce_header_add_to_cart_fragment') ) {
    function trucking_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.top-cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'trucking'), $woocommerce->cart->cart_contents_count);
        $fragments['.top-cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'trucking_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('trucking_woocommerce_breadcrumb_defaults') ) {
    function trucking_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = trucking_get_config('woo_breadcrumb_image');
        $breadcrumb_color = trucking_get_config('woo_breadcrumb_color');
        $style = array();
        $breadcrumb_enable = trucking_get_config('show_product_breadcrumbs');
        $archive = '';
        if ( !$breadcrumb_enable ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'trucking');
        } else {
            $title = esc_html__('Products List', 'trucking');
            $archive ='woo-archive';
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb '.$archive.'"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><h2 class="bread-title">'.$title.'</h2><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'trucking_woocommerce_breadcrumb_defaults' );
add_action( 'trucking_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('trucking_woocommerce_display_modes') ) {
    function trucking_woocommerce_display_modes(){
        global $wp;
        $current_url = trucking_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = trucking_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="mn-icon-99"></i>'.'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="mn-icon-105"></i>'.'</a>';
        echo '</div>'; 
    }
}
add_action( 'woocommerce_before_shop_loop', 'trucking_woocommerce_display_modes' , 2 );

if ( !function_exists('trucking_woocommerce_get_display_mode') ) {
    function trucking_woocommerce_get_display_mode() {
        $woo_mode = trucking_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['trucking_woo_mode']) && ($_COOKIE['trucking_woo_mode'] == 'list' || $_COOKIE['trucking_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['trucking_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('trucking_shop_page_link')) {
    function trucking_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('trucking_filter_before')){
    function trucking_filter_before(){
        echo '<div class="apus-filter clearfix">';
    }
}
if(!function_exists('trucking_filter_after')){
    function trucking_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'trucking_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'trucking_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('trucking_before_woocommerce_init') ) {
    function trucking_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'trucking_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['trucking_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'trucking_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('trucking_woocommerce_shop_per_page') ) {
    function trucking_woocommerce_shop_per_page($number) {
        $value = trucking_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'trucking_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('trucking_woocommerce_shop_columns') ) {
    function trucking_woocommerce_shop_columns($number) {
        $value = trucking_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'trucking_woocommerce_shop_columns' );

// share box
if ( !function_exists('trucking_woocommerce_share_box') ) {
    function trucking_woocommerce_share_box() {
        if ( trucking_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox-product' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'trucking_woocommerce_share_box', 100 );

// quickview
if ( !function_exists('trucking_woocommerce_quickview') ) {
    function trucking_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}

if ( trucking_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_trucking_quickview_product', 'trucking_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_trucking_quickview_product', 'trucking_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('trucking_swap_images') ) {
    function trucking_swap_images($size = 'shop_catalog') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $size );
            $placeholder_image = trucking_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( trucking_get_config('show_swap_image') ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_hover_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], $size );
                    
                    if ( trucking_get_config('image_lazy_loading') ) {
                        echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        echo '<img src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            
            if ( trucking_get_config('image_lazy_loading') ) {
                echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'trucking').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}


// get image
if ( !function_exists('trucking_product_get_image') ) {
    function trucking_product_get_image($thumb = 'shop_thumbnail') {
        global $product;

        $product_thumbnail_id = get_post_thumbnail_id();
        $product_thumbnail_title = get_the_title( $product_thumbnail_id );
        $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
        
        $placeholder_image = trucking_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

        echo '<div class="product-image">';
        if ( trucking_get_config('image_lazy_loading') ) {
            echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image unveil-image" />';
        } else {
            echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image" />';
        }
        echo '</div>';
    }
}

// layout class for woo page
if ( !function_exists('trucking_woocommerce_content_class') ) {
    function trucking_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( trucking_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'trucking_woocommerce_content_class', 'trucking_woocommerce_content_class' );

// get layout configs
if ( !function_exists('trucking_get_woocommerce_layout_configs') ) {
    function trucking_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = trucking_get_config('product_'.$page.'_left_sidebar');
        $right = trucking_get_config('product_'.$page.'_right_sidebar');

        switch ( trucking_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-xs-12'  );
                $configs['main'] = array( 'class' => 'col-md-9  col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9  col-xs-12' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-xs-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-xs-12'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-6  col-xs-12' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12 col-xs-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('trucking_woocommerce_related_upsells_products') ) {
    function trucking_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = trucking_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = trucking_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'trucking_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'trucking_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'trucking_product_tabs' ) ) {
    function trucking_product_tabs($tabs) {
        global $post;
        
        if ( !trucking_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        unset( $tabs['additional_information'] ); 
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'trucking_product_tabs', 90 );

if ( !function_exists( 'trucking_minicart') ) {
    function trucking_minicart() {
        $template = apply_filters( 'trucking_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'trucking_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'trucking_woocomerce_icon_wishlist_add' );
function trucking_woocomerce_icon_wishlist( $value='' ){
    return '<i class="mn-icon-1246"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','trucking').'</span>';
}

function trucking_woocomerce_icon_wishlist_add(){
    return '<i class="mn-icon-2"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','trucking').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function trucking_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : '';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = apus_themer_get_products( $categories_id, $product_type, 1, $number );
    if ( $loop->have_posts()) {
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
    }
    exit();
}
add_action( 'wp_ajax_trucking_get_products', 'trucking_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_trucking_get_products', 'trucking_woocommerce_get_ajax_products' );



// product type "Trucking"
add_filter( 'product_type_options', 'trucking_woocommerce_add_type_options' );
function trucking_woocommerce_add_type_options( $types ) {
    $types['trucking_package'] = array(
        'id'            => '_trucking_package',
        'wrapper_class' => 'show_if_simple',
        'label'         => esc_html__( 'Trucking Package', 'trucking' ),
        'default'       => 'no'
    );
    return $types;
}

add_action( 'woocommerce_process_product_meta', 'trucking_woocommerce_save_custom_fields_for_single_products', 10, 2 );
function trucking_woocommerce_save_custom_fields_for_single_products( $post_id, $post ) {
    if ( isset( $_POST['_trucking_package'] ) ){
        update_post_meta( $post_id, '_trucking_package',  'yes' );
    } else{
        update_post_meta( $post_id, '_trucking_package',  'no' );
    }
}
function trucking_woocommerce_pre_get_posts( $q ) {
    if ( ! $q->is_main_query() ) {
        return;
    }
    // Fix for verbose page rules
    if ( $q->is_archive && ((isset($q->query_vars['post_type']) && $q->query_vars['post_type'] == 'product') || isset($q->query_vars['product_cat'])) && !$q->is_admin ) {
        
        $q->set( 'meta_query', array(
            'relation' => 'OR',
            array(
               'key' => '_trucking_package',
               'value' => 'yes',
               'compare' => '!=',
            ),
            array(
                'key' => '_trucking_package',
                'value' => 'yes',
                'compare' => 'NOT EXISTS'
            )
        ));
    }
}
add_action( 'pre_get_posts', 'trucking_woocommerce_pre_get_posts', 10 );

function trucking_woocommerce_photoswipe() {
    ?>
    <div class="rating-popover-content woocommerce"></div>
    <?php
    if ( !is_singular('product') ) {
        return;
    }
    ?>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>

        <div class="pswp__scroll-wrap">

          <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
          </div>

          <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="<?php echo esc_html__('Close (Esc)', 'trucking'); ?>"></button>
                <button class="pswp__button pswp__button--share" title="<?php echo esc_html__('Share', 'trucking'); ?>"></button>
                <button class="pswp__button pswp__button--fs" title="<?php echo esc_html__('Toggle fullscreen', 'trucking'); ?>"></button>
                <button class="pswp__button pswp__button--zoom" title="<?php echo esc_html__('Zoom in/out', 'trucking'); ?>"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="<?php echo esc_html__('Previous (arrow left)', 'trucking'); ?>"></button>
            <button class="pswp__button pswp__button--arrow--right" title="<?php echo esc_html__('Next (arrow right)', 'trucking'); ?>"></button>
            <div class="pswp__caption">
              <div class="pswp__caption__center"></div>
            </div>
          </div>

        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'trucking_woocommerce_photoswipe' );