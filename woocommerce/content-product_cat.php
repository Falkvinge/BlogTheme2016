<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 9.9.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<?php
	echo '<div class="comp-grid-3 related-proper">';
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	// 

	/** image
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	echo '<div class="home-index-thumb zero">';
	do_action( 'woocommerce_before_subcategory', $category ); //link start
	do_action( 'woocommerce_before_subcategory_title', $category );
	do_action( 'woocommerce_after_subcategory', $category ); // link end
	echo '</div>';

	/** title
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	echo '<div class="title-content-index zero">';
	echo '<h3 class="entry-title-index">';
	echo '<a href="'. esc_url( get_term_link( $category->slug, 'product_cat' ) ) . '">';
	echo  esc_html( $category->name ) . '</a>';
	echo '</h3>';
	

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );
	echo '</div>';

	/**
	 * woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	
	echo '</div>';
	?>