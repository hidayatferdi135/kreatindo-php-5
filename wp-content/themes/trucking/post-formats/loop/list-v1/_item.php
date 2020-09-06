<?php
    $post_format = get_post_format();
    $thumbsize = isset($thumbsize) ? $thumbsize : trucking_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 25;
?>

<article <?php post_class('post post-list'); ?>>

    <div class="row">
        <?php
        $thumb = trucking_display_post_thumb($thumbsize);
        if (!empty($thumb)) {
            ?>
            <div class="col-md-6">
                <?php echo trim($thumb); ?>
            </div>
            <?php
        }
        ?>
        
        <div class="col-md-<?php echo (has_post_thumbnail() ? '6' : '12'); ?>">
          <div class="info-content ">
            <?php
                if (get_the_title()) {
                ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php
            }
            ?>
            <div class="meta">
                <span class="entry-date"><?php the_time( get_option('date_format', 'M d, Y') ); ?></span>
            </div>
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo trucking_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="description"><?php echo trucking_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>

            <a class="btn btn-outline btn-theme" href="<?php the_permalink(); ?>"><?php esc_html_e('VIEW MORE','trucking') ?></a>
          </div>
        </div>
    </div>
</article>