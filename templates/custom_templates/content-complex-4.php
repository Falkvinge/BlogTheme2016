<?php
/*
* Content Complex 4
*
*/
?>
<?php 
	global $wise_c4post_number, $wise_c4post_categ;
	$cat_name = $wise_c4post_categ;	
	$number_featured = $wise_c4post_number;
?>
<div class="index-wrapper-outer">
	<div id="comp4" class="col-4">
		<?php $col_4 = new WP_Query( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1 ) ); ?>
		<?php if ( have_posts() ) : ?>
			
				<?php while( $col_4 -> have_posts() ) : $col_4 -> the_post(); ?>
				
				<div class="comp-grid-3">
					<?php get_template_part( 'templates/custom_templates/content', 'complex-def-3' ); ?>
				</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
		
		<?php endif; ?>
	</div>
</div>