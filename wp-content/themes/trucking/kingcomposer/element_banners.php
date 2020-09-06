<?php
$atts  = array_merge( array(
	'title' => '',
	'number' => '',
	'description' => '',
	'style' => '',
	'marker_icon' => '',
	'readmore' => '',
), $atts);

extract( $atts );
?>
<?php if($style == 'style_transparent'){ ?>
	<div class="widget-banner <?php echo esc_attr($style); ?>">
		<?php $img = (!empty($marker_icon)) ? wp_get_attachment_image_src($marker_icon,'full'):''; ?>
		<?php if ( !empty($img) && isset($img[0]) ): ?>
			<div class="banner">
				<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
			</div>
	    <?php endif; ?>
	    <div class="content">
		    <h3 class="title">
				<?php if(!empty($number)){ ?>
					<span><?php echo trim($number); ?> </span>
				<?php } ?>
				<?php echo trim($title); ?>
			</h3>
		</div>
		<div class="content-bottom">
			<div class="desc"><?php echo trim($description); ?></div>
			<?php if(!empty($readmore)){ ?>
				<a class="btn-readmore" href="<?php echo esc_url_raw($readmore); ?>"><?php echo esc_html__('Read More','trucking'); ?><i class="fa text-theme fa-angle-double-right"></i></a>
			<?php } ?>
		</div>
	</div>
<?php }else{ ?>
	<div class="widget-banner <?php echo esc_attr($style); ?>">
		<h3 class="title">
			<?php if(!empty($number)){ ?>
				<span><?php echo trim($number); ?> </span>
			<?php } ?>
			<?php echo trim($title); ?>
		</h3>
		<?php $img = (!empty($marker_icon)) ? wp_get_attachment_image_src($marker_icon,'full'):''; ?>
		<?php if ( !empty($img) && isset($img[0]) ): ?>
			<div class="banner">
				<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
			</div>
	    <?php endif; ?>
		<div class="desc"><?php echo trim($description); ?></div>
		<?php if(!empty($readmore)){ ?>
			<a class="btn-readmore" href="<?php echo esc_url_raw($readmore); ?>"><?php echo esc_html__('Read More','trucking'); ?><i class="fa text-theme fa-angle-double-right"></i></a>
		<?php } ?>
	</div>
<?php } ?>