<?php
/*
* Template to Display Forum Sidebar
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>
<div class="sidebar-wrapper-outer">
	<div id="sidebarforum" class="widget-area-right" data-sticky_column>
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div>
</div><!-- End of Forum Widgets -->