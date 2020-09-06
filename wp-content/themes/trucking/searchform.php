<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="search-form">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="input-group">
			<input type="text" placeholder="<?php esc_html_e( 'Search Here', 'trucking' ); ?>" name="s" class="form-control"/>
			<?php if ( trucking_get_config('search_type') != 'all' ): ?>
				<input type="hidden" name="post_type" value="<?php echo trucking_get_config('search_type'); ?>" class="post_type" />
			<?php endif; ?>
			<span class="input-group-btn"> <button type="submit" class="btn"><i class="fa fa-search"></i></button></span>
		</div>
	</form>
</div>