<?php

$atts  = array_merge( array(
	'product_special'  => '',
	'star_number' => 1,
	'featrue' => '',
), $atts);
extract( $atts );
if ( !empty($product_special) )  {
	$pids = trucking_autocomplete_options_helper($product_special);
	if (is_array($pids) && !empty($pids)) {
		$loop = trucking_get_products( array(), 'recent_product', 1, -1, '' , '', $pids );
	}
}
if ( isset($loop) && $loop->have_posts() ) {
?>
    <div class="widget widget-product-package widget-products products <?php echo esc_attr($style.' '.$featrue); ?>">
	    <div class="widget-content woocommerce">
	    	<div class="star-number">
	    		<?php for ($i=1; $i <= $star_number; $i++) { ?>
	    			<i class="fa fa-star" aria-hidden="true"></i>
	    		<?php } ?>
	    	</div>
	    	<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
				<?php wc_get_template( 'item-product/inner-package.php'); ?>
			<?php endwhile; ?>
	    </div>
	</div>
	<?php wp_reset_postdata(); ?>
<?php
}