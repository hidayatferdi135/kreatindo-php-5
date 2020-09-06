<?php
/**
 * Single Product Image
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>

<div class="apus-images images-swipe">
<?php
  $images = $product->get_gallery_image_ids();
  $attachment_ids = array();
  if ( in_array(get_post_thumbnail_id(), $images) ) {
    $attachment_ids = $images;
  } elseif ( get_post_thumbnail_id() || $images ) {
    $attachment_ids = array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
  }
  if ( $attachment_ids ) {
    ?>
    <div class="slick-carousel slick-small main-image-carousel" data-carousel="slick" data-smallmedium="1" data-extrasmall="1" data-items="1" data-pagination="true" data-nav="true" data-asnavfor=".thumbnails-image-carousel" data-infinite="true">
      <?php
          $image_sizes = get_option('shop_single_image_size');
          $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
          foreach ( $attachment_ids as $attachment_id ) {
              $classes = array( 'thumb-link' );

              $image_full = wp_get_attachment_image_src( $attachment_id, 'full' );
              $image_full_link = isset($image_full[0]) ? $image_full[0] : '';

              if (!empty($image_full) && isset($image_full[1]) && isset($image_full[2]) ) {
                $data_size = $image_full[1] . 'x' . $image_full[2];
              } else {
                $data_size = $data_med_size;
              }

              $image_src = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
              $image_link = isset($image_src[0]) ? $image_src[0] : '';

              if ( ! $image_link )
                  continue;

              $image_title = esc_attr( get_the_title( $attachment_id ) );

              if (trucking_get_config('image_lazy_loading')) {
                $placeholder_image = trucking_create_placeholder(array($image_src[1],$image_src[2]));
                $image = '<img src="'.trim($placeholder_image).'" data-src="'.esc_url($image_link).'" class="attachment-shop_single size-shop_single unveil-image" title="'.esc_attr($image_title).'" alt="'.esc_attr($image_title).'">';
              } else {
                $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, $attr = array(
                    'title' => $image_title,
                    'alt'   => $image_title
                    ) );
              }

              $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';
              echo '<div class="image-wrapper">';
              echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_full_link, $data_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
              echo '</div>';
          }
      ?>
    </div>
    <?php
  } else {
    ?>
    <div class="slick-carousel slick-small main-image-carousel" data-carousel="slick" data-smallmedium="1" data-extrasmall="1" data-items="1" data-pagination="true" data-nav="true" data-asnavfor=".thumbnails-image-carousel" data-infinite="true">
      <?php
        $image_sizes = get_option('shop_single_image_size');
        $image_link = woocommerce_placeholder_img_src();
        $data_med_size = $image_sizes['width'] . 'x'. $image_sizes['height'];
        $class = get_post_thumbnail_id() == $attachment_id ? 'active apus_swipe_image_item' : 'apus_swipe_image_item';

        $image .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'trucking').'" />';

        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" data-med="%s" data-size="%s" data-med-size="%s" class="%s">%s</a>', $image_link, $image_link, $data_med_size, $data_med_size, $class, $image ), $attachment_id, $post->ID );
      ?>
    </div>
    <?php
  }
  do_action( 'woocommerce_product_thumbnails' );
?>
</div>