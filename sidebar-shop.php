<?php
/*
* Template to Display Shop Sidebar
*
*/

if( !is_active_sidebar( 'sidebar-5' ) ) {
	return;
}
?>
<div class="sidebar-wrapper-outer">
	<div id="sidebarshop" class="widget-area-right" data-sticky_column>
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div>
</div><!-- End of Sidebar Shop -->