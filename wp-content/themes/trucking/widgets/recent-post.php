<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);
if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_post
);
$query = new WP_Query($args);
if($query->have_posts()):
?>
<div class="slick-carousel posts" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1"  
    data-pagination="false" data-nav="true">
	<?php
		while($query->have_posts()): $query->the_post();
		global $post;
	?>
		<div class="post post post-style2">
			<div class="clearfix entry-content">
		        <div class="entry-category">
		            <?php trucking_post_categories($post); ?>
		        </div>
		        <div class="entry-meta">
		            <div class="info">
		                
		                <?php if (get_the_title()) { ?>
		                    <h4 class="entry-title">
		                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		                    </h4>
		                <?php } ?>

		                <div class="date"><a href="<?php the_permalink(); ?>"><?php the_time( 'd-M-Y' ); ?> </a> </div>
		            </div>
		        </div>
		        <div class="info-bottom">
		            <?php if (! has_excerpt()) { ?>
		                <div class="entry-description"><?php echo trucking_substring( get_the_content(), 10, '...' ); ?></div>
		            <?php } else { ?>
		                <div class="entry-description"><?php echo trucking_substring( get_the_excerpt(), 10 , '...' ); ?></div>
		            <?php } ?>
		        </div>

		        <a class="btn-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'trucking' ); ?><i class="fa text-theme fa-angle-double-right"></i></a>
		    </div>
	    </div>
	<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
<?php endif; ?>