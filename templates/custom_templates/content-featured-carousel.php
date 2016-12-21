<?php
/*
* Content Featured Defaults Carousel
*
*/
?>
<?php if (!is_paged()): ?>
	<?php
		global $wise_feat_num, $wise_slider_categ, $wise_feat_id;
		$number_featured = $wise_feat_num;
		$feat_id = explode(',', $wise_feat_id);
		if( $wise_feat_id != null ) {
			query_posts( array ( 'post__in' => $feat_id, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => 'post__in', 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1 ) );
		} else {
			query_posts( array ( 'meta_key' => 'wise_featured_post', 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => 'date', 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1 ) );
		}
		?>
<div id="wise-defaults" class="owl-carousel wise-posts">
	<?php while ( have_posts() ) : the_post(); ?>
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

	<?php wp_reset_query(); ?>
</div>
	
<?php endif; ?>