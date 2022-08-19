<?php
/*
* Template to Display Top Ads
*
*/

if( !is_active_sidebar( 'sidebar-6' ) ) {
	return;
}

$disable_ads = function_exists('carbon_get_post_meta') ? carbon_get_post_meta( get_the_ID(), 'wise_disads_post' ) : null;

if( is_single() || is_page() ) { // If it is single post
	if( $disable_ads == false ) :
		if( function_exists('is_bbpress') && is_bbpress() ) {
			dynamic_sidebar( 'sidebar-6' );
		} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
			null;
		} else {
			dynamic_sidebar( 'sidebar-6' );
		}
	endif;
} else {
	if( function_exists('is_bbpress') && is_bbpress() ) {
		dynamic_sidebar( 'sidebar-6' );
	} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
		null;
	} else {
		dynamic_sidebar( 'sidebar-6' );
	}
} ?>