<?php
/*
* Template to Display Top Ads
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}
?>
<?php global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true);
	  if( $disable_ads == false ) : ?>
<?php if( function_exists('is_bbpress') && is_bbpress() ) { null;
	  } elseif( function_exists('is_woocommerce') && is_woocommerce() ) { null; } else { ?>
	<div id="sidebartop" class="widget-area-top">
		<?php dynamic_sidebar( 'sidebar-6' ); ?>
	</div><!-- End of #sidebartop -->
<?php } ?>
<?php endif; ?>