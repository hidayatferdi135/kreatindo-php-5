<div class="product-block-pricing">
    <div class="block-inner-header">
        <!-- stars -->
        <!-- end star -->
        <h3 class="name"><?php the_title(); ?></h3>
        <div class="wrapper-pricing">
        <?php
            /**
            * woocommerce_after_shop_loop_item_title hook
            *
            * @hooked woocommerce_template_loop_rating - 5
            * @hooked woocommerce_template_loop_price - 10
            */
            remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
            do_action( 'woocommerce_after_shop_loop_item_title');
        ?></div>
    </div>
    <div class="block-inner-content">
        <?php the_content(); ?>
    </div>
    <div class="groups-button clearfix">
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
    </div>
</div>