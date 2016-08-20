<?php
/*
* Template to Display Footer Widgets
*
*/
?>
<?php
if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>
<div id="supplementary">
	<div id="footer-widgets" class="footer-widgets widget-area clear">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
</div><!-- End of Footer Widgets -->