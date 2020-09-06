<?php if ( trucking_get_config('show_searchform') ): ?>

	<div class="apus-search-form">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			
		  	<div class="input-group">
		  		<input type="text" placeholder="<?php esc_html_e( 'Search', 'trucking' ); ?>" name="s" class="apus-search form-control"/>
				<span class="input-group-btn">
			     	<button type="submit" class="button-search btn"><i class="mn-icon-52"></i></button>
			    </span>
		  	</div>
			<?php if ( trucking_get_config('search_type') != 'all' ): ?>
				<input type="hidden" name="post_type" value="<?php echo trucking_get_config('search_type'); ?>" class="post_type" />
			<?php endif; ?>
		</form>
	</div>
<?php endif; ?>