<?php
/*
* Template to Display Page Left Sidebar
*
*/

$wise_sidebar = function_exists('carbon_get_post_meta') ? carbon_get_post_meta(get_the_ID(), 'wise_customleft_sidebar') : null;
$sidebar_opt = array(
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<div class="widget-title"><h2>',
	'after_title'   => '</h2></div>',
); ?>
<div class="sidebar-wrapper-outer-left">
	<div id="sidebarleft" class="widget-area-left" data-sticky_column>	
		<?php if( function_exists('wise_dynamic_sidebar') ) : wise_dynamic_sidebar($wise_sidebar, $sidebar_opt); endif; ?>
	</div><!-- End of #sidebarright -->
</div>