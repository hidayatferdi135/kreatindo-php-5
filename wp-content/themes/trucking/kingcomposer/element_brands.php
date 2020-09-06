<?php

$atts  = array_merge( array(
	'brands' => array(),
	'columns'	=> 4,
	'rows' => 1,
	'title' => '',
), $atts);
extract( $atts );

if ( !empty($brands) && is_array($brands) ):
?>
	<div class="widget widget-brands">
		<?php if(!empty($title)){ ?>
			<h3 class="widget-title"><?php echo trim($title); ?></h3>
		<?php } ?>
	    <div class="widget-content">
			<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-pagination="false" data-nav="true">
	    		<?php $count = 0; foreach ($brands as $brand) { ?>
	    			<?php if ( $count % $rows == 0 ): ?>
				        <div class="item-column">
				    <?php endif; ?>
			    			<div class="item">
				                <?php if (isset($brand->link) && $brand->link): ?>
									<a href="<?php echo esc_url($brand->link); ?>" target="_blank">
								<?php endif; ?>
								<?php if (isset($brand->image) && $brand->image): ?>
									<?php $img = wp_get_attachment_image_src($brand->image, 'full'); ?>
									<?php apus_themer_display_image($img); ?>
								<?php endif; ?>
								<?php if (isset($brand->link) && $brand->link): ?>
									</a>
								<?php endif; ?>
					        </div>
					        <?php if ( $count % $rows == ($rows - 1) || $count == (count($brands) - 1) ): ?>
				        </div>
				    <?php endif; ?>
	    		<?php $count++; } ?>
    		</div>
	    </div>
	</div>
<?php endif; ?>