<?php
/*
* Content Complex 3
*
*/
?>
<?php 
	global $wise_c3post_number, $wise_c3post_categ;
	$cat_name = $wise_c3post_categ;	
	$number_featured = $wise_c3post_number - 1;
?>
<div class="col-1-1">
	<?php query_posts( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => 1, 'offset' => 0, 'ignore_sticky_posts' => 1 ) ); ?>
	<?php if ( have_posts() ) : ?>
		<div class="index-wrapper">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-def-1' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	<?php endif; ?>
</div>

<div id="compsub2-1" class="col-1-2">
	<?php query_posts( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => $number_featured, 'offset' => 1, 'ignore_sticky_posts' => 1 ) ); ?>
	<?php if ( have_posts() ) : ?>
		<div class="index-wrapper-outer">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-sub' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	<?php endif; ?>
</div>