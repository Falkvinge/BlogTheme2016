<?php
/*
* Template to Display Bottom Ads
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-7' ) ) {
	return;
}
?>
<?php global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true);
	  if( $disable_ads == false ) : ?>
<?php if( function_exists('is_bbpress') && is_bbpress() ) { null;
	  } elseif( function_exists('is_woocommerce') && is_woocommerce() ) { null; } else { ?>
	<div class="sbottom-wrapper">
		<div id="sidebarbottom" class="widget-area-top">
			<?php dynamic_sidebar( 'sidebar-7' ); ?>
		</div><!-- End of #sidebarbottom -->
	</div>
<?php } ?>
<?php endif; ?>