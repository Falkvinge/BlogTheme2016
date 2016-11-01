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
<?php global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true); ?>
<?php
if( is_single() || is_page() ) { // If it is single post
	if( $disable_ads == false ) :
		if( function_exists('is_bbpress') && is_bbpress() ) {
			null;
		} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
			null;
		} else {
			dynamic_sidebar( 'sidebar-6' );
		}
	endif;
} else {
	if( function_exists('is_bbpress') && is_bbpress() ) {
		null;
	} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
		null;
	} else {
		dynamic_sidebar( 'sidebar-6' );
	}
} ?>