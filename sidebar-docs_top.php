<?php
/*
* Template to Display Document Top Widgets
*
*/

if( !is_active_sidebar( 'sidebar-7' ) ) {
	return;
}

if( function_exists('is_bbpress') && is_bbpress() ) {
	null;
} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
	null;
} else {
	dynamic_sidebar( 'sidebar-7' );
}
?>