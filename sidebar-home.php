<?php
/*
* Template to Display Dynamic Homepage
*
*/
?>
<?php 
$wise_homepage = carbon_get_post_meta(get_the_ID(), 'wise_custom_homepage');
$homepage_opt = array(
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '',
); ?>	
<?php wise_dynamic_sidebar($wise_homepage); ?>