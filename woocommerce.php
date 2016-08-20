<?php
/*
* Template to Display Woocommerce
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper woocommerce" data-sticky_parent>
	
		<div id="primary" class="content-area">	
			<main id="main" class="site-main site-main-two-column">
				<?php
				if ( is_singular( 'product' ) ) {
					 woocommerce_content();
				  } else {
				   /* Product archive, taxonomy, search and shop page */
					woocommerce_get_template( 'archive-product.php' );
				  }
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
		
		<?php get_sidebar('shop'); ?>
	</div><!-- #content-wrapper -->
</div><!-- #content-wrapper-outer -->
<?php get_footer(); ?>
