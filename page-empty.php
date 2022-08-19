<?php
/*
* Template Name: Page Empty
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	<?php get_sidebar('docs_top'); ?>
	<?php 	if( function_exists('wise_fix_gutenberg_content') ) {
				wise_fix_gutenberg_content(); 
			} else {
				the_content();
			} ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>