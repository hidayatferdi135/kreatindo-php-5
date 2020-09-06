<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : trucking_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 50;
?>

<article <?php post_class('post post-grid'); ?>>
    <div class="clearfix entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="left-content">
            <div class="date"><a href="<?php the_permalink(); ?>"> <span class="d"><?php the_time( 'd' ); ?></span> <?php the_time( 'M' ); ?> </a> </div>
        </div>
        <div class="content">
            <?php
            $thumb = trucking_display_post_thumb($thumbsize);
            echo trim($thumb);
            ?>
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
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    <?php } ?>
                </div>
            </div>
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo trucking_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo trucking_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>
            <?php if (get_the_title()) { ?>
                    <a class="btn btn-theme" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More','trucking') ?></a>
            <?php } ?>
        </div>
    </div>
</article>