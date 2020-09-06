<?php

$atts  = array_merge( array(
	'number'  => 8,
	'columns'	=> 4,
	'order_by'		=> 'ID',
	'order'	=> 'ASC',
	'layout_type' => 'grid',
    'topnav' => '',
    'categories' => ''
), $atts);
extract( $atts );

$args = array(
	'paged' => 1,
	'posts_per_page' => $number,
	'post_status' => 'publish',
	'orderby' => $order_by,
	'order' => $order,
);
if ($categories) {
    $categories = array_map('trim', explode(',', $categories)) ;
    $args['category_name'] = implode(',', $categories);
}

$bcol = $columns > 0 ? 12/$columns : 3;
if ($columns == 5) {
    $bcol = 'cus-5';
}

$loop = new WP_Query($args);

?>
<div class="widget clearfix widget-blog <?php echo esc_attr($layout_type).' '.$topnav; ?>">
    <?php if(!empty($title)){ ?>
        <h3 class="widget-title"><?php echo trim($title) ?></h3>
    <?php } ?>
    <?php if ( $loop->have_posts() ): ?>
        <div class="widget-content">
            <?php if ( $layout_type == 'carousel' ): ?>

                <div class="slick-carousel posts" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1"  
                    data-pagination="false" data-nav="true">

                    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                        <?php get_template_part( 'post-formats/loop/style2' ); ?>
                    <?php endwhile; ?>

                </div>

            <?php elseif ( $layout_type == 'grid' ): ?>

                <div class="layout-blog style-grid">
                    <div class="row">
                        <?php $count = 1; while ( $loop->have_posts() ) : $loop->the_post(); ?>
                            <div class="col-sm-<?php echo esc_attr($bcol); ?> col-xs-12">
                                <article <?php post_class('post post-style-shipping'); ?>>
                                    <?php if (get_the_title()) { ?>
                                        <h4 class="entry-title">
                                            <span><?php echo sprintf("%02d.", $count); ?></span>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                    <?php } ?>

                                    <?php get_template_part( 'post-formats/loop/style-shipping' ); ?>
                                </article>
                            </div>
                        <?php $count++; endwhile; ?>
                    </div>
                </div>
            <?php elseif ( $layout_type == 'special' ): ?>
                
                <div class="slick-carousel posts" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="1" data-extrasmall="1"  
                    data-pagination="false" data-nav="true">

                    <?php $count = 0; while ( $loop->have_posts() ): $loop->the_post(); ?>
                        <?php if ($count%3 == 0) { ?>
                            <div class="item">
                                <div class="row">
                        <?php } ?>
                                <?php if ($count%3 == 0) { ?>
                                    <div class="col-md-6 col-sm-12">
                                        <?php get_template_part( 'post-formats/loop/style1' ); ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-3 col-sm-6">
                                        <?php get_template_part( 'post-formats/loop/style3' ); ?>
                                    </div>
                                <?php } ?>

                        <?php if ($count%3 == 2 || $count == ($loop->post_count - 1) ) { ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php $count++; endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>