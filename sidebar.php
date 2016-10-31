<?php
/*
* Template to Display Right Sidebar
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div class="sidebar-wrapper-outer">
	<div id="sidebarright" class="widget-area-right">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- End of #sidebarright -->
</div>
