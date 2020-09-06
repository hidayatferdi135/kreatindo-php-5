<?php

$atts  = array_merge( array(
	'images' => array(),
	'layout_type' => 'layout1'
), $atts);
extract( $atts );

if ( !empty($images) && is_array($images) ):
	?>
	<div class="widget widget-images-carousel <?php echo esc_attr($layout_type); ?>">
		<?php if ($layout_type == 'layout1') { ?>
			<div class="slick-carousel special-carousel-1" data-carousel="slick" data-items="1" data-medium="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="false" data-asnavfor=".special-carousel-2" data-infinite="true">
				<?php foreach ($images as $image) { ?>
					<?php if (isset($image->image) && $image->image): ?>
						<div class="item-wrapper">
							<?php $img = wp_get_attachment_image_src($image->image, 'full'); ?>
							<?php apus_themer_display_image($img); ?>
							<?php if (isset($image->video_url) && $image->video_url): ?>
								<a class="popup-video" href="<?php echo esc_url($image->video_url); ?>">
									<i class="sl-control-play" aria-hidden="true"></i>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php } ?>
			</div>
			<div class="slick-carousel special-carousel-2" data-carousel="slick" data-items="4" data-medium="4" data-smallmedium="4" data-extrasmall="2" data-pagination="true" data-nav="false" data-slidestoscroll="1" data-asnavfor=".special-carousel-1" data-focusonselect="true" data-infinite="true">
				<?php foreach ($images as $image) { ?>
					<?php if (isset($image->image) && $image->image): ?>
						<div class="item-wrapper">
							<?php $img = wp_get_attachment_image_src($image->image, 'thumbnail'); ?>
							<?php apus_themer_display_image($img); ?>
						</div>
					<?php endif; ?>
				<?php } ?>
			</div>

		<?php } else { ?>
			<div class="slick-carousel special-carousel-1" data-carousel="slick" data-items="1" data-medium="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="true">
				<?php foreach ($images as $image) { ?>
					<?php if (isset($image->image) && $image->image): ?>
						<div class="item-wrapper">
							<?php $img = wp_get_attachment_image_src($image->image, 'full'); ?>
							<?php apus_themer_display_image($img); ?>
							<?php if (isset($image->video_url) && $image->video_url): ?>
								<a class="popup-video" href="<?php echo esc_url($image->video_url); ?>"><i class="sl-control-play" aria-hidden="true"></i></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php
endif;