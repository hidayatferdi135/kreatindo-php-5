<?php
$atts  = array_merge( array(
	'title' => '',
	'description' => '',
	'readmore' => '',
	'request' => '',
), $atts);

extract( $atts );
?>
<div class="widget-calltoaction widget">
	<?php if(!empty($title)){ ?>
	    <h3 class="widget-title">
			<?php echo trim($title); ?>
		</h3>
	<?php } ?>
	<div class="content">
		<div class="desc"><?php echo trim($description); ?></div>
		<?php if(!empty($readmore)){ ?>
			<a class="btn btn-theme" href="<?php echo esc_url_raw($readmore); ?>"><?php echo esc_html__('Read More','trucking'); ?></a>
		<?php } ?>
		<?php if(!empty($request)){ ?>
			<a class="btn btn-theme btn-outline" href="<?php echo esc_url_raw($request); ?>"><?php echo esc_html__('Request Quote','trucking'); ?></a>
		<?php } ?>
	</div>
</div>