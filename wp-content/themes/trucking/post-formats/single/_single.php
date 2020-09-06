<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-grid'); ?>>
    
    <div class="entry-content">
        <div class="left-content">
            <div class="date"><a href="<?php the_permalink(); ?>"> <span class="d"><?php the_time( 'd' ); ?></span> <?php the_time( 'M' ); ?> </a> </div>
        </div>
        <div class="content">
            <?php if ( $post_format == 'gallery' ) {
                $gallery = trucking_post_gallery( get_the_content(), array( 'size' => 'full' ) );
            ?>
                <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
                    <?php echo trim($gallery); ?>
                </div>
            <?php } elseif( $post_format == 'link' ) {
                    $trucking_format = trucking_post_format_link_helper( get_the_content(), get_the_title() );
                    $trucking_title = $trucking_format['title'];
                    $trucking_link = trucking_get_link_attributes( $trucking_title );
                    $thumb = trucking_post_thumbnail('', $trucking_link);
                    echo trim($thumb);
                } else { ?>
                <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                    <?php
                        $thumb = trucking_post_thumbnail();
                        echo trim($thumb);
                    ?>
                </div>
            <?php } ?>
            <div class="entry-meta">
                <div class="info">
                    <div class="meta">
                        <?php
                            printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>',
                                _x( 'By ', 'Used before post author name.', 'trucking' ),
                                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                get_the_author()
                            );
                        ?>
                        <span class="comments">
                            <?php  
                            printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'trucking' ), number_format_i18n( get_comments_number() ) );
                            ?>
                        </span>
                        <span class="entry-category">
                            <?php trucking_post_categories($post); ?>
                        </span>
                    </div>
                    <?php if (get_the_title()) { ?>
                        <h4 class="entry-title">
                            <?php the_title(); ?>
                        </h4>
                    <?php } ?>
                </div>
            </div>
            <?php
                if ( $post_format == 'gallery' ) {
                    $gallery_filter = trucking_gallery_from_content( get_the_content() );
                    echo trim($gallery_filter['filtered_content']);
                } else {
            ?>
                    <div class="entry-description"><?php the_content(); ?></div><!-- /entry-content -->
            <?php } ?>
            <?php
            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'trucking' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'trucking' ) . ' </span>%',
                'separator'   => '',
            ) );
            ?>
            <div class="tag">
                <?php trucking_post_tags(); ?>
            </div>
            <div class="tag-social clearfix ">
                <div class="pull-left social-share">
                   <?php if( trucking_get_config('show_blog_social_share', true) ) {
                        get_template_part( 'page-templates/parts/sharebox' );
                    } ?>         
                </div>
                <div class="pull-right">
                    <?php
                    //Previous/next post navigation.
                    the_post_navigation( array(
                        'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'trucking' ) . '</span> ' .
                            '<span class="pull-right navi">' . esc_html__( 'Next post:', 'trucking' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'trucking' ) . '</span> ' .
                            '<span class="pull-left navi">' . esc_html__( 'Previous post:', 'trucking' ) . '</span> ' .
                            '<span class="post-title">%title</span>',
                    ) );
                    ?>
                </div>
            </div>
        </div>
    </div>
</article>