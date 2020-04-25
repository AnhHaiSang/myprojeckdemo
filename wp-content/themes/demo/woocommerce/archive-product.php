<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); jws_title_bar();

?>

<div class="container container-custom-width">
	<div class="row row-custom">
		<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3-custom-width">
			<?php  if ( is_active_sidebar( 'shop_sidebar' ) ) {
				dynamic_sidebar( 'shop_sidebar' );
			} ?>
		</div>

		<div class="col-12 col-sm-6 col-md-6 col-lg-8 col-xl-9 col-xl-9-custom-width">
	<?php

	if ( woocommerce_product_loop() ) {
?>
	<div class="oderby-result-pagination">
		
	
<?php
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 30
	 * @hooked woocommerce_catalog_ordering - 20
	 */
	do_action( 'woocommerce_before_shop_loop' );
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );


?>
</div>

<?php
	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );
			if($_GET["item_layout"] == 'list') {
				wc_get_template_part( 'content', 'product5' );
			}elseif($jws_option['item_columns'] == '1'){
				wc_get_template_part( 'content', 'product5' );
			}
			else {
				wc_get_template_part( 'content', 'product_petty_1' );
			}
		}
	}

	woocommerce_product_loop_end();

	
	// the_content();
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}?>
</div>

</div>
</div>
<?php
get_footer( 'shop' );
