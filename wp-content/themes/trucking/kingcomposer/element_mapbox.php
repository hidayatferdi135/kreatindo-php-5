<?php
$atts  = array_merge( array(
	'title' => '',
	'location' => '',
	'phone' => '',
	'email' => '',
), $atts);

extract( $atts );
?>
<div class="widget-mapbox clearfix">
	<?php $img = (!empty($marker_icon)) ? wp_get_attachment_image_src($marker_icon,'full'):''; ?>
	<?php if ( !empty($img) && isset($img[0]) ): ?>
		<div class="banner">
			<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
		</div>
    <?php endif; ?>
	<div class="content">
		<h3 class="title">
			<?php echo trim($title); ?>
		</h3>
		<?php if(!empty($location)){ ?>
			<div class="location"><?php echo trim($location); ?></div>
		<?php } ?>
		<?php if(!empty($phone)){ ?>
			<div class="phone"><?php echo trim($phone); ?></div>
		<?php } ?>
		<?php if(!empty($location)){ ?>
			<div class="email"><?php echo trim($email); ?></div>
		<?php } ?>
	</div>
</div>