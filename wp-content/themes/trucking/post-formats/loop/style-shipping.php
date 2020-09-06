<?php
    global $post;
    $nb_word = isset($nb_word) ? $nb_word : 25;

    $thumb = trucking_display_post_thumb('trucking-blog-thumbnails');
    echo trim($thumb);
?>
<div class="clearfix entry-content">

    <?php if (! has_excerpt()) { ?>
        <div class="entry-description"><?php echo trucking_substring( get_the_content(), $nb_word, '...' ); ?></div>
    <?php } else { ?>
        <div class="entry-description"><?php echo trucking_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
    <?php } ?>

    <a class="btn-readmore" href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'trucking' ); ?><i class="fa text-theme fa-angle-double-right"></i></a>
</div>