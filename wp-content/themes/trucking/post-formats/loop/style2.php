<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : trucking_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 12;
?>

<article <?php post_class('post post-style2'); ?>>
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

                <div class="date"><a href="<?php the_permalink(); ?>"><?php the_time( get_option('date_format', 'M d, Y') ); ?> </a> </div>
            </div>
        </div>
        <div class="info-bottom">
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo trucking_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo trucking_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>
        </div>

        <a class="btn-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'trucking' ); ?><i class="fa text-theme fa-angle-double-right"></i></a>
    </div>
</article>