<?php
/*
* Content Complex 2-2
*
*/
?>
<?php
	global $wise_c22post_number, $wise_c22post_categ, $do_not_duplicate;
	$cat_name = $wise_c22post_categ;
	$number_featured = $wise_c22post_number - 1;
?>
<div class="col-2-1 border-1">
	<?php query_posts( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => 1, 'offset' => 0, 'ignore_sticky_posts' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>
	<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); $do_not_duplicate[] = get_the_ID(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-def-2' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
	<?php endif; ?>
</div>

<div class="col-2-2">
	<?php query_posts( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => $number_featured, 'offset' => 1, 'ignore_sticky_posts' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>
	<?php if ( have_posts() ) : ?>
		<div class="index-wrapper">
			<?php while ( have_posts() ) : the_post(); $do_not_duplicate[] = get_the_ID(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-sub' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
	<?php endif; ?>
</div>
