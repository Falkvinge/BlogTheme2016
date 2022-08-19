<?php
/*
* Content Complex 2-1
*
*/
?>
<?php
	global $wise_c21post_number, $wise_c21post_categ;
	$cat_name = $wise_c21post_categ;
	$number_featured = $wise_c21post_number - 1;
?>
<div class="col-2-1 border-1">
	<?php $col_2_1 = new WP_Query( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => 1, 'offset' => 0, 'ignore_sticky_posts' => 1 ) ); ?>
	<?php if ( have_posts() ) : ?>
			<?php while( $col_2_1 -> have_posts() ) : $col_2_1 -> the_post(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-def-2' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>

<div class="col-2-2">
	<?php $col_2_2 = new WP_Query( array( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => $number_featured, 'offset' => 1, 'ignore_sticky_posts' => 1 ) ); ?>
	<?php if ( have_posts() ) : ?>
		<div class="index-wrapper">
			<?php while( $col_2_2 -> have_posts() ) : $col_2_2 -> the_post(); ?>

				<?php get_template_part( 'templates/custom_templates/content', 'complex-sub' ); ?>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php endif; ?>
</div>