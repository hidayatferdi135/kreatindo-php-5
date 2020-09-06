<?php

$atts  = array_merge( array(
	'columns'	=> 4,
	'layout_type' => 'grid',
	'title' => '',
	'style' => '',
	'topnav' => '',
), $atts);
extract( $atts );

$bcol = 12/$columns;
if ($columns == 5) {
	$bcol = 'cus-5';
}
if ( !empty($testimonials) && is_array($testimonials) ):
?>
	<div class="widget widget-testimonials <?php echo esc_attr($style); ?> <?php echo esc_attr($topnav ? 'top-carousel' : ''); ?>">
		<?php if(!empty($title)){ ?>
			<h3 class="widget-title"><?php echo trim($title); ?></h3>
		<?php } ?>
	    <div class="widget-content">
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-pagination="true" data-nav="true" data-extrasmall="1" data-small="1" data-medium="1" data-smallmedium="1">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			
				        <div class="testimonials-body">
						   <div class="testimonials-profile">
						         	<div class="testimonial-avatar ">
							            <?php if (isset($testimonial->image) && $testimonial->image): ?>
											<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
											<?php if ( isset($img[0]) ) { ?>
												<?php trucking_display_image($img); ?>
											<?php } ?>
										<?php endif; ?>
										<i class="fa fa-quote-left" aria-hidden="true"></i>
						         	</div>

						         	<div class="testimonial-meta ">
						         		<div class="description"><?php echo trim($testimonial->content); ?></div>
						         	 	<div class="info">
							               	<h3 class="name-client"><span><?php echo esc_html__('- by','trucking'); ?></span> <?php echo trim($testimonial->name); ?></h3>
							               	<?php if($testimonial->job){ ?>
							               		<span class="job"> - <?php echo trim($testimonial->job); ?></span>   
							               	<?php } ?>
							            </div>
							            
						         	</div>
						      	</div>
						</div>

		    		<?php } ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php foreach ($testimonials as $testimonial) { ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
			                <div class="testimonials-body">
							   	<div class="testimonials-profile">
							      	<div class="media">
							         	<div class="testimonial-avatar media-left">
								            <?php if (isset($testimonial->image) && $testimonial->image): ?>
												<?php $img = wp_get_attachment_image_src($testimonial->image, 'full'); ?>
												<?php if ( isset($img[0]) ) { ?>
													<?php trucking_display_image($img); ?>
												<?php } ?>
											<?php endif; ?>
							         	</div>
							         	<div class="testimonial-meta media-body">
								            <div class="description"><?php echo trim($testimonial->content); ?></div>
								            <div class="info">
								               	<h3 class="name-client"> <?php echo trim($testimonial->name); ?></h3>
								               	<div class="job"> - <?php echo trim($testimonial->job); ?></div>   
								            </div>
							         	</div>
							      	</div>
							   	</div> 
							</div>
				        </div>
		    		<?php } ?>
	    		</div>
	    	<?php endif; ?>
	    </div>
	</div>
<?php endif; ?>