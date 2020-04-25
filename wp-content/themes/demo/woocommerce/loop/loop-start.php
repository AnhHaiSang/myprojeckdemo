<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	global $jws_option;
		$jws_option['item_columns'];
?>
<div class="wapper-products woocommerce">
	<?php
	
		$columns = $jws_option['item_columns'];
		if($_GET["item_columns"] == '3' || $_GET["item_columns"] == '1' || $_GET["item_columns"] == '2') {
			$columns = $_GET["item_columns"];	
		}
	 ?>
	<ul class="products columns-<?php echo esc_attr($columns); ?> container-products layout4"> 
													
	

