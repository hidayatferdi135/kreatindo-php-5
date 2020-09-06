<?php
    global $post;
    $thumbsize = isset($thumbsize) ? $thumbsize : trucking_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 25;
?>

<article <?php post_class('post post-style1'); ?>>
    <?php
    $thumb = trucking_display_post_thumb('trucking-blog-thumbnails');
    echo trim($thumb);
    ?>
    <div class="clearfix entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-category">
            <?php trucking_post_categories($post); ?>
        </div>
        <div class="entry-meta">
            <div class="date"><a href="<?php the_permalink(); ?>"> <span class="d"><?php the_time( 'd' ); ?></span> <?php the_time( 'M, Y' ); ?> </a> </div>
            <div class="info">
                
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>

                <a class="bt-contact" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'trucking' ); ?><i class="fa text-theme fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</article>