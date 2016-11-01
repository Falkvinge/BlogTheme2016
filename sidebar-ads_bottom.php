<?php
/*
* Template to Display Document Bottom Widgets
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-8' ) ) {
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
			?><div class="sbottom-wrapper"><div class="widget-area-top"></div>
				<?php dynamic_sidebar( 'sidebar-8' ); ?>
			</div><?php
		}
	endif;
} else {
	if( function_exists('is_bbpress') && is_bbpress() ) {
		null;
	} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
		null;
	} else {
		?><div class="sbottom-wrapper"><div class="widget-area-top"></div>
			<?php dynamic_sidebar( 'sidebar-8' ); ?>
		</div><?php
	}
} ?>