<?php
/*
* Template to Display Page Sidebar
*
*/
?>
<?php 
$wise_sidebar = carbon_get_post_meta(get_the_ID(), 'wise_custom_sidebar');
$sidebar_opt = array(
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget-title"><h2>',
	'after_title'   => '</h2></div>',
); ?>
<div class="sidebar-wrapper-outer">
	<div id="sidebarright" class="widget-area-right" data-sticky_column>		
		<?php wise_dynamic_sidebar($wise_sidebar, $sidebar_opt); ?>
	</div><!-- End of #sidebarright -->
</div>