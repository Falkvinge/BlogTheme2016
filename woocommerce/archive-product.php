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
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.9.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<div class="top-meta">
		<?php woocommerce_breadcrumb(); ?>
	</div><!-- breadcrumbs -->

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

		<div class="page-header clear">
			<h1 class="page-title-archive"><?php woocommerce_page_title(); ?></h1>
		</div>

	<?php endif; ?>

	<?php
		/**
		 * woocommerce_archive_description hook.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	?>

	<?php if ( have_posts() ) : ?>

		<?php
			/**
			 * woocommerce_before_shop_loop hook.
			 *
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		?>
		<div class="clear">
			<div class="index-wrapper-outer">
				<div id="comp4" class="col-4">			
					<?php woocommerce_product_loop_start(); ?>
				</div>
			</div>
		</div>
			
			<span class="border-1"></span>
			
			<?php $product_layout = get_theme_mod('wise_prod_layout'); ?>
			<?php if($product_layout == 'grid') { echo '<div class="index-wrapper-outer">'; }  ?>
			<div id="index-lists<?php if ($product_layout) { echo '-' . esc_attr($product_layout); } ?>" class="index-wrapper<?php if ($product_layout) { echo '-' . esc_attr($product_layout); } ?>">
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
				
			</div><!-- End index lists -->
			<?php if($product_layout == 'grid') { echo '</div>'; } ?>

		<?php woocommerce_product_loop_end(); ?>

		<?php
			/**
			 * woocommerce_after_shop_loop hook.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

		<?php wc_get_template( 'loop/no-products-found.php' ); ?>

	<?php endif; ?>