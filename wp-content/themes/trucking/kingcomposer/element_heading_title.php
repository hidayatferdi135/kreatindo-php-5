<?php
$atts  = array_merge( array(
	'title' => '',
	'sub_title' => '',
	'description' => '',
	'style' => '',
	'marker_icon' => '',
), $atts);

extract( $atts );
?>
<div class="widget-heading-title <?php echo esc_attr($style); ?>">
	<?php if(!empty($sub_title)){ ?>
		<h4 class="sub-title"><span><?php echo trim($sub_title); ?></span></h4>
	<?php } ?>
	<h3 class="title">
		<?php $img = (!empty($marker_icon)) ? wp_get_attachment_image_src($marker_icon,'full'):''; ?>
		<?php if ( !empty($img) && isset($img[0]) ): ?>
			<img class="icon" src="<?php echo esc_url_raw($img[0]); ?>" alt="">
        <?php endif; ?>
		<?php echo trim($title); ?>
	</h3>
</div>