<?php

$atts  = array_merge( array(
	'title'	=> '',
	'features' => '',
	'style' => '',
	'columns' => ''
), $atts);
extract( $atts );

if ( !empty($features) ):
?>
	<div class="widget widget-features-box <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
	    </h3>
	    <?php endif; ?>
	    <div class="content">
		    <?php if($columns > 1) echo '<div class="row '.(($style== 'default')?' no-margin':'').'">'; ?>
			<?php foreach ($features as $item): ?>
				<?php if($columns > 1) echo '<div class="'.(($style== 'default')?'no-padding ':'').'col-xs-6 col-sm-'.(12/$columns).'">'; ?>
				<div class="feature-box ">
					<div class="fbox-top">
						<?php if ( isset($item->image) && $item->image ) { ?>
							<div class="fbox-image">
					    		<div class="inner">
									<?php if ( isset($item->image) && $item->image ): ?>
										<?php $img = wp_get_attachment_image_src($item->image,'full'); ?>
										<?php if (isset($img[0]) && $img[0]) { ?>
									    	<?php apus_themer_display_image($img); ?>
										<?php } ?>
									<?php endif; ?>
									<?php if ( isset($item->image_hover) && $item->image_hover ): ?>
										<?php $image_hover = wp_get_attachment_image_src($item->image_hover,'full'); ?>
										<?php if (isset($image_hover[0]) && $image_hover[0]) { ?>
									    	<?php apus_themer_display_image($image_hover); ?>
										<?php } ?>
									<?php endif; ?>
								</div>
					    	</div>
						<?php } elseif (isset($item->icon) && $item->icon) { ?>
					        <div class="fbox-icon">
					        	<div class="inner">
					            	<i class="fa <?php echo esc_attr($item->icon); ?>"></i>
					            </div>
					        </div>
					    <?php } ?>
				    </div>
				    <div class="fbox-content">  
				        <h3 class="ourservice-heading"><?php echo trim($item->title); ?></h3>                     
				        <?php if (isset($item->description) && trim( $item->description )!='') { ?>
				            <p class="description"><?php echo trim( $item->description );?></p>  
				        <?php } ?>
				    </div>      
				</div>
				<?php if($columns > 1) echo '</div>'; ?>
			<?php endforeach; ?>
			<?php if($columns > 1) echo '</div>'; ?>
		</div>
	</div>
<?php endif; ?>