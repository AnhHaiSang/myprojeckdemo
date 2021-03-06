<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */ 

defined( 'ABSPATH' ) || exit;

global $product;
 
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php


	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	?>

	<div class="product_image">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
	</div>
	<div class="product-detail">
		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );


		woocommerce_template_loop_rating();
		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		
		?>
		<p class="product-description"><?php echo get_the_excerpt(); ?></p>
		<div class="container-menu-btn-product">
			<?php
		
          global $product;
          $units_sold = get_post_meta( $product->get_id(), 'total_sales', true );
          $total = $product->get_stock_quantity();
          if(!empty($units_sold) && !empty($total)) { 
            $result = ($units_sold / $total) * 100;
            echo '<div class="progress_bar_sold">
                    <p class="line"><span style="width:'.$result.'%"></span></p>
                    <p class="sold_count"><span>'.esc_html__('Sold:','fatcy').'</span><strong>'.$units_sold.'</strong></p>
                 </div>';
          }
   
        ?>
				<ul class="lists-button">
					<li class="button-item"><span class="add_to_cart2"><?php woocommerce_template_loop_add_to_cart2(); ?></span></li>
					<li class="button-item"><?php if( function_exists('YITH_WCWL') ) jws_product_wishlist_button();?></li>
					<li class="button-item"><?php tb_add_compare_link2(); ?></li>
				</ul>

		</div>	
	</div>
</li>
