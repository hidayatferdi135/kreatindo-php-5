<?php
//convert hex to rgb
if ( !function_exists ('trucking_getbowtied_hex2rgb') ) {
	function trucking_getbowtied_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);
		
		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		return implode(",", $rgb); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}
}
if ( !function_exists ('trucking_custom_styles') ) {
	function trucking_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<!-- ******************************************************************** -->
		<!-- * Theme Options Styles ********************************************* -->
		<!-- ******************************************************************** -->
			
		<style>

			/* check main color */ 
			<?php if ( trucking_get_config('main_color') != "" ) : ?>

				/* seting background main */
				.widget-mapbox .title::before,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
				.archive-shop div.product .information .cart .btn:active, .archive-shop div.product .information .cart .button:active, .archive-shop div.product .information .cart .btn:hover, .archive-shop div.product .information .cart .button:hover,
				.archive-shop div.product .information .cart .btn, .archive-shop div.product .information .cart .button,
				.product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:hover, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:hover a, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:active, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:active a, .product-block.grid .groups-button .quickview:hover, .product-block.grid .groups-button .quickview:hover a, .product-block.grid .groups-button .quickview:active, .product-block.grid .groups-button .quickview:active a,
				.product-block.grid:hover .groups-button .add-cart .btn, .product-block.grid:hover .groups-button .add-cart .button,
				.detail-post .author-info,
				.commentform .title::before,
				.post-grid .entry-title::before,
				.apus-pagination a:hover,
				.apus-pagination span.current, .apus-pagination a.current,
				.tagcloud a:focus, .tagcloud a:hover,
				.widget-title::after, .widgettitle::after, .widget-heading::after,
				.kc-team.kc-team-2 .content-image::before,
				.post-style2 .date::after,
				#fbuilder .fform h2::before,
				.widget-banner .title::before,
				#fbuilder .service .dfield label.active::before,
				.widget-product-package:hover .add-cart .add_to_cart_button,
				.btn-theme.btn-outline:hover, .btn-theme.btn-outline:active,
				.widget-product-package.feature .add-cart .add_to_cart_button,
				.phone .number::after,
				.widget .widget-title::after, .widget .widgettitle::after, .widget .widget-heading::after,
				.widget-heading-title.style_5 .title::after,
				.widget-product-package .wrapper-pricing::before,
				.widget-heading-title .sub-title span::before, .widget-heading-title .sub-title span::after,
				.widget-heading-title.style_2 .title::after,
				.widget-features-box.style_1 .feature-box:hover .inner,
				.slick-carousel .slick-dots li.slick-active button,
				#back-to-top,
				.widget-product-package .widget-content .star-number,
				.widget-product-package.feature .price,
				.widget-testimonials .testimonial-avatar i,
				.counters .icon,
				.kc_accordion_wrapper .kc_accordion_section > .kc_accordion_header.ui-state-active,
				.widget-images-carousel .special-carousel-2.slick-carousel .slick-dots li.slick-active button,
				.widget-features-box.default .feature-box:hover,
				.bg-theme,.btn-theme,.btn-theme:hover,.btn-theme:active
				{
					background: <?php echo esc_html( trucking_get_config('main_color') ) ?> ;
				}
				/* setting color*/
				.product-categories li a::before,
				.widget_categories ul li a::before, .widget_archive ul li a::before,
				.apus-breadscrumb .breadcrumb > .active,
				.kc-team.kc-team-2 .content-subtitle,
				#fbuilder .submit .dfield input,
				.phone .title,
				.entry-category a,
				.post-style-shipping .entry-title span,
				.widget-heading-title .sub-title,
				.about-track a:hover, .about-track a:active,
				.text-theme,a:hover,a:active
				{
					color: <?php echo esc_html( trucking_get_config('main_color') ) ?> !important;
				}
				/* setting border color*/
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
				.tabs-v1 .nav-tabs li:hover, .tabs-v1 .nav-tabs li:active, .tabs-v1 .nav-tabs li.active,
				.product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:hover, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:hover a, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:active, .product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show:active a, .product-block.grid .groups-button .quickview:hover, .product-block.grid .groups-button .quickview:hover a, .product-block.grid .groups-button .quickview:active, .product-block.grid .groups-button .quickview:active a,
				.product-block.grid .groups-button .yith-wcwl-add-to-wishlist > .show, .product-block.grid .groups-button .quickview,
				.product-block.grid .groups-button .add-cart .btn, .product-block.grid .groups-button .add-cart .button,
				.apus-pagination a:hover,
				.apus-pagination span.current, .apus-pagination a.current,
				.tagcloud a:focus, .tagcloud a:hover,
				.post-grid .date,
				#fbuilder .style-focus input,
				#fbuilder .service .dfield label::before,
				.widget-product-package:hover .add-cart .add_to_cart_button,
				.widget-product-package .add-cart .add_to_cart_button,
				.btn-theme.btn-outline:hover, .btn-theme.btn-outline:active,
				.widget-product-package.feature .add-cart .add_to_cart_button,
				.contact-1 .form-control:focus,
				.widget-product-package .price,
				.widget-product-package.feature .price,
				.kc_accordion_wrapper .kc_accordion_section > .kc_accordion_header.ui-state-active,
				.widget-features-box.style_1 .inner,
				.btn-theme,
				.btn-theme:hover,.btn-theme:active,
				.btn-theme.btn-outline,
				.border-theme{
					border-color: <?php echo esc_html( trucking_get_config('main_color') ) ?> ;
				}
				.widget-images-carousel .special-carousel-2 .slick-slide.slick-current .image-wrapper, .widget-images-carousel .special-carousel-2 .slick-slide:hover .image-wrapper{
					outline-color:<?php echo esc_html( trucking_get_config('main_color') ) ?>;
				}
				.kc_tabs > .kc_wrapper > .kc_tabs_nav li:hover, .kc_tabs > .kc_wrapper > .kc_tabs_nav li:active, .kc_tabs > .kc_wrapper > .kc_tabs_nav li.ui-tabs-active{
					box-shadow:0 0 0 2px <?php echo esc_html( trucking_get_config('main_color') ) ?> inset;
				}
				.product-block.grid .groups-button .add-cart .btn:hover, .product-block.grid .groups-button .add-cart .button:hover{
					background: <?php echo esc_html( trucking_get_config('main_color') ) ?> !important;
				}
			<?php endif; ?>

			/* check second color */ 
			<?php if ( trucking_get_config('second_color') != "" ) : ?>

				/* seting background main */
				#back-to-top,
				.date,
				.bg-theme-second,.btn-theme-second
				{
					background: <?php echo esc_html( trucking_get_config('second_color') ) ?>;
				}
				/* setting color*/
				
				.text-second,.second-color
				{
					color: <?php echo esc_html( trucking_get_config('second_color') ) ?> !important;
				}
				/* setting border color*/
				.btn-theme-second
				{
					border-color: <?php echo esc_html( trucking_get_config('second_color') ) ?>;
				}

			<?php endif; ?>
			

			/* Typo */
			<?php
				$main_font = trucking_get_config('main_font');
				if ( !empty($main_font) ) :
			?>
				/* seting background main */
				body, p
				{
					<?php if ( isset($main_font['font-family']) && $main_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $main_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-weight']) && $main_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $main_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-style']) && $main_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $main_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['font-size']) && $main_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $main_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['line-height']) && $main_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $main_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($main_font['color']) && $main_font['color'] ) { ?>
						color: <?php echo esc_html( $main_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			<?php
				$second_font = trucking_get_config('second_font');
				if ( !empty($second_font) ) :
			?>
				/* seting background main */
				.btn,.widget-title,.woocommerce div.product p.price, .woocommerce div.product span.price,
              	.product-block.grid .groups-button .add-cart .btn, .product-block.grid .groups-button .add-cart .button,
              	.archive-shop div.product .information .compare, .archive-shop div.product .information .add_to_wishlist, .archive-shop div.product .information .yith-wcwl-wishlistexistsbrowse > a, .archive-shop div.product .information .yith-wcwl-wishlistaddedbrowse > a,
             	.tabs-v1 .nav-tabs li > a,.commentform .title
				{
					<?php if ( isset($second_font['font-family']) && $second_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $second_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-weight']) && $second_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $second_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-style']) && $second_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $second_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['font-size']) && $second_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $second_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['line-height']) && $second_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $second_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($second_font['color']) && $second_font['color'] ) { ?>
						color: <?php echo esc_html( $second_font['color'] ) ?>;
					<?php } ?>
				}
				
			<?php endif; ?>

			/* H1 */
			<?php
				$h1_font = trucking_get_config('h1_font');
				if ( !empty($h1_font) ) :
			?>
				/* seting background main */
				h1
				{
					<?php if ( isset($h1_font['font-family']) && $h1_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h1_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-weight']) && $h1_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h1_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-style']) && $h1_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h1_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['font-size']) && $h1_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h1_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['line-height']) && $h1_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h1_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h1_font['color']) && $h1_font['color'] ) { ?>
						color: <?php echo esc_html( $h1_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H2 */
			<?php
				$h2_font = trucking_get_config('h2_font');
				if ( !empty($h2_font) ) :
			?>
				/* seting background main */
				h2
				{
					<?php if ( isset($h2_font['font-family']) && $h2_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h2_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-weight']) && $h2_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h2_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-style']) && $h2_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h2_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['font-size']) && $h2_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h2_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['line-height']) && $h2_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h2_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h2_font['color']) && $h2_font['color'] ) { ?>
						color: <?php echo esc_html( $h2_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H3 */
			<?php
				$h3_font = trucking_get_config('h3_font');
				if ( !empty($h3_font) ) :
			?>
				/* seting background main */
				h3, 
                .widgettitle, .widget-title, .widget .widget-title, .widget .widgettitle, .widget .widget-heading
				{
					<?php if ( isset($h3_font['font-family']) && $h3_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h3_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-weight']) && $h3_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h3_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-style']) && $h3_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h3_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['font-size']) && $h3_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h3_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['line-height']) && $h3_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h3_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h3_font['color']) && $h3_font['color'] ) { ?>
						color: <?php echo esc_html( $h3_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H4 */
			<?php
				$h4_font = trucking_get_config('h4_font');
				if ( !empty($h4_font) ) :
			?>
				/* seting background main */
				h4
				{
					<?php if ( isset($h4_font['font-family']) && $h4_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h4_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-weight']) && $h4_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h4_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-style']) && $h4_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h4_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['font-size']) && $h4_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h4_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['line-height']) && $h4_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h4_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h4_font['color']) && $h4_font['color'] ) { ?>
						color: <?php echo esc_html( $h4_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H5 */
			<?php
				$h5_font = trucking_get_config('h5_font');
				if ( !empty($h5_font) ) :
			?>
				/* seting background main */
				h5
				{
					<?php if ( isset($h5_font['font-family']) && $h5_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h5_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-weight']) && $h5_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h5_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-style']) && $h5_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h5_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['font-size']) && $h5_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h5_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['line-height']) && $h5_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h5_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h5_font['color']) && $h5_font['color'] ) { ?>
						color: <?php echo esc_html( $h5_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* H6 */
			<?php
				$h6_font = trucking_get_config('h6_font');
				if ( !empty($h6_font) ) :
			?>
				/* seting background main */
				h6
				{
					<?php if ( isset($h6_font['font-family']) && $h6_font['font-family'] ) { ?>
						font-family: <?php echo esc_html( $h6_font['font-family'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-weight']) && $h6_font['font-weight'] ) { ?>
						font-weight: <?php echo esc_html( $h6_font['font-weight'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-style']) && $h6_font['font-style'] ) { ?>
						font-style: <?php echo esc_html( $h6_font['font-style'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['font-size']) && $h6_font['font-size'] ) { ?>
						font-size: <?php echo esc_html( $h6_font['font-size'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['line-height']) && $h6_font['line-height'] ) { ?>
						line-height: <?php echo esc_html( $h6_font['line-height'] ) ?>;
					<?php } ?>
					<?php if ( isset($h6_font['color']) && $h6_font['color'] ) { ?>
						color: <?php echo esc_html( $h6_font['color'] ) ?>;
					<?php } ?>
				}
			<?php endif; ?>

			/* Custom CSS */
			<?php if ( trucking_get_config('custom_css') != "" ) : ?>
				<?php echo trucking_get_config('custom_css') ?>
			<?php endif; ?>

		</style>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		echo implode($new_lines);
	}
}

?>
<?php add_action( 'wp_head', 'trucking_custom_styles', 99 ); ?>