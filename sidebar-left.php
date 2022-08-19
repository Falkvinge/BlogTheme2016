<?php
/*
* Template to Display Left Sidebar
*
*/

if( !is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>
<div class="sidebar-wrapper-outer-left">
	<div id="sidebarleft" class="widget-area-left" data-sticky_column>
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- End of #sidebarleft -->
</div>