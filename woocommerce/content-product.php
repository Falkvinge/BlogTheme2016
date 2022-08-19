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
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 9.9.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<?php $product_layout = get_theme_mod('wise_prod_layout'); ?>
<div class="index-divider<?php if ($product_layout) { echo '-' . esc_attr($product_layout) . ' custom-divider-three'; } ?>">
	<?php
	
	/** image
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	global $post;
	$postid = get_the_ID();		
	$products = wc_get_product( $post->ID );
	$ex_product = $products->is_type( 'external' );
	
	echo '<div class="home-index-thumb';
	if ($product_layout) { echo '-' . esc_attr($product_layout); }
	echo '">';
	if ( !$ex_product ) {
		echo '<div class="index-cart"><a href="' . esc_url(get_permalink()) . '?add-to-cart=' . esc_attr($postid) . '">';
		echo '<i class="fa fa-shopping-cart"></i> ' . esc_html__( 'Add to Cart', 'wise-blog' ) . '</a></div>';
	}
	else {
		null;
	}
	echo '<a href="' . esc_url(get_permalink()) . '">';
	do_action( 'woocommerce_before_shop_loop_item_title' );
	echo '</a></div>';
	
	echo '<div class="title-content-index';
	if ($product_layout) { echo '-' . esc_attr($product_layout); }
	echo '">';		
	/** title
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	echo '<h3 class="entry-title-index';
	if($product_layout == 'grid') { echo '-grid title-sub'; }
	echo '">';
	echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h3>';

	/** price and ratings
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	 
	// Rating
	add_action( 'woocommerce_rating_loop', 'woocommerce_template_loop_rating', 5 );
	do_action( 'woocommerce_rating_loop' );
	
	if($product_layout != 'grid') :
		// Category
		global $wise_allowed_html;
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		$cat_products = wc_get_product_category_list( $postid, ', ', '<p>' . _n( 'Category:', 'Categories:', $size, 'wise-blog' ) . ' ', '</p>' );
		echo wp_kses_post($cat_products);
		
		// Excerpt
		echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
		// After Excerpt
		do_action('woocommerce_after_short_description');
		// View Details
		echo '<a class="read-more" href="' . esc_url(get_permalink()) . '" title="' . esc_attr__('Details ', 'wise-blog') . esc_attr( get_the_title() ) . '" rel="bookmark">' . esc_html__('More Details ', 'wise-blog') . '</a>';
	endif;

	/** cart button
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	
	add_action('woocommerce_price_loop', 'woocommerce_template_loop_price', 10);
	do_action('woocommerce_price_loop');
	echo '</div>';
	?>
</div><!-- End index divider -->