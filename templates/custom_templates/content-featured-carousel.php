<?php
/*
* Content Featured Defaults Carousel
*
*/
?>
<?php if (!is_paged()): ?>
<?php
	global $wise_feat_num, $wise_slider_categ, $wise_feat_id, $wise_feat_time_cover, $wise_slider_orderby;
	$number_featured = $wise_feat_num;
	$feat_id = explode(',', $wise_feat_id);
	if( $wise_slider_orderby == 'title' ) { // if ordered by title, order alphabetically
		$ascdesc = 'ASC';
	} else {
		$ascdesc = 'DESC';
	}
	$wise_sliderorder_in = 'post__in'; // order by post ID
	$wise_sliderorder_in .= !empty($wise_slider_orderby) ? ', ' . $wise_slider_orderby : '';
	$wise_sliderorder = !empty($wise_slider_orderby) ? $wise_slider_orderby : 'date'; // order by all post
	if( $wise_feat_id != null ) {
		$feat_car_query = new WP_Query( array ( 'post_type' => 'post', 'post__in' => $feat_id, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder_in, 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
	} else {
		$feat_car_query = new WP_Query( array ( 'post_type' => 'post', 'meta_query' => wise_featured_post(), 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder, 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
	}
?>
<div id="wise-defaults" class="owl-carousel wise-posts">
	<?php while( $feat_car_query -> have_posts() ) : $feat_car_query -> the_post(); ?>
		<div class="item feat-index-divider-carousel">
			<?php if ( has_post_thumbnail() ) {
				echo '<div class="feat-home-index-thumb">';
				echo '<div class="index-cat">';
				if (has_category()) { wise_parent_cat(); }
				echo '</div>';
				echo '<a href="';
				echo esc_url(get_permalink());
				echo ' ">';
				the_post_thumbnail('wise-post-thumb');
				echo '</a></div>';
			} else { null; } // If there's no image then nothing will display
			?>
			<div class="feat-title-content-index-carousel">
				<?php the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a></h1>' ); ?>
				
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta-index white">
					<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php wise_comments(); ?>
					<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- End of .entry-meta -->
				<?php endif; ?>					

			</div><!-- End of .feat-title-content-index -->
		</div><!-- End of Index Divider -->
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		"use strict";
		$("#wise-defaults").owlCarousel({
		  navigation : true,
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem: true,
		  autoPlay: <?php if( !empty($wise_feat_time_cover) ) { echo esc_js($wise_feat_time_cover * 1000); } else { echo '5000'; } ?>,
		  navigationText : false,
		  pagination: true
		});
	}); /* End jQuery */
</script>	
<?php endif; ?>