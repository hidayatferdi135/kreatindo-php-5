<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id() ), 'blog-thumbnails' );
$availability      = $product->get_availability();
?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="block-inner">
        <figure class="image <?php echo ($availability['class'] == 'out-of-stock')?'out':''; ?>">
            <?php woocommerce_show_product_loop_sale_flash(); ?>
            <?php
                // Availability
                $availability_html = empty( $availability['availability'] ) ? '' : '<span class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</span>';
                echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
            ?>
            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
                <?php
                    /**
                    * woocommerce_before_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_show_product_loop_sale_flash - 10
                    * @hooked woocommerce_template_loop_product_thumbnail - 10
                    */
                    trucking_swap_images();
                ?>
            </a>
        </figure>
        <div class="groups-button clearfix">
            <?php if (trucking_get_config('show_quickview', true)) { ?>
                <div class="quick-view">
                    <a href="<?php the_permalink(); ?>" class="quickview btn btn-primary" data-productslug="<?php echo trim($post->post_name); ?>">
                       <i class="mn-icon-41"> </i>
                    </a>
                </div>
            <?php } ?>
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            <?php
                $action_add = 'yith-woocompare-add-product';
                $url_args = array(
                    'action' => $action_add,
                    'id' => $product->get_id()
                );
            ?>
            <?php
                if( class_exists( 'YITH_WCWL' ) ) {
                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                }
            ?>
        </div>
    </div>
    <div class="caption">
        <div class="meta">
            <div class="infor">

                <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
                    do_action( 'woocommerce_after_shop_loop_item_title');
                ?>
            </div>
        </div>    
    </div>

    <?php do_action('trucking_show_wooswatches'); ?>
</div>
