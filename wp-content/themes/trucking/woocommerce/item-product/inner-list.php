<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id() ), 'blog-thumbnails' );

?>
<div class="product-block list" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
	<div class="row">
		<div class="col-xs-12">
		    <figure class="image">
		        <?php woocommerce_show_product_loop_sale_flash(); ?>
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
		</div>    
	    <div class="col-xs-12">
		    <div class="caption-list">
		        
		        <div class="meta">
		        	<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		        	<div class="rating clearfix">
	                    <?php
	                        if($rating_html = wc_get_rating_html( $product->get_average_rating() )){
                                echo trim( $rating_html );
                            }else{
	                            echo '<div class="star-rating"></div>';
	                        }
	                    ?>
	                </div>
					
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
		            <?php echo  the_excerpt();  ?>
		            <div class="action-bottom clearfix"> 
						<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                        
		                <?php
			                if( class_exists( 'YITH_WCWL' ) ) {
			                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			                }
			            ?>   
		    
		            </div>
		        </div>    
		    </div>
		</div>    
	</div>	    
</div>
