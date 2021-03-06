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
		<div class="wrap-image">
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		</div>
		<div class="container-menu-btn-product">
			<ul class="lists-button">
				<li class="button-item"><?php woocommerce_template_loop_add_to_cart(); ?></li>
				<li class="button-item"><?php tb_add_quick_view_button(); ?></li>
				<li class="button-item"><?php if( function_exists('YITH_WCWL') ) jws_product_wishlist_button();?></li>
			</ul>
		</div>
	</div>
	<?php 
	
	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 10
	 * @hooked woocommerce_template_loop_price - 5
	 */
	
	do_action( 'woocommerce_after_shop_loop_item_title' );


	// woocommerce_template_loop_rating();
	?>
</li>
