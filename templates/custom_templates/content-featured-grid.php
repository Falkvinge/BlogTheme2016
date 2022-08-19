<?php
/*
* Content Featured Defaults Grid
*
*/
?>
<?php if (!is_paged()): ?>
	<?php
		global $wise_feat_num, $wise_slider_categ, $wise_feat_id, $wise_slider_orderby;
		$number_featured = $wise_feat_num - 1;
		$feat_id = explode(',', $wise_feat_id);
		$count_featid = count($feat_id); // count the number of array inputed in number of featured to show
		if( $wise_slider_orderby == 'title' ) { // if ordered by title, order alphabetically
			$ascdesc = 'ASC';
		} else {
			$ascdesc = 'DESC';
		}
		$wise_sliderorder_in = 'post__in'; // order by post ID
		$wise_sliderorder_in .= !empty($wise_slider_orderby) ? ', ' . $wise_slider_orderby : '';
		$wise_sliderorder = !empty($wise_slider_orderby) ? $wise_slider_orderby : 'date'; // order by all post
		if( $wise_feat_id != null ) {
			$feat_grid1_query = new WP_Query( array ( 'post_type' => 'post', 'post__in' => $feat_id, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder_in, 'posts_per_page' => 1, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
		} else {
			$feat_grid1_query = new WP_Query( array ( 'post_type' => 'post', 'meta_query' => wise_featured_post(), 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder, 'posts_per_page' => 1, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
		}
		?>
	<?php if( $wise_feat_num > 0 ) : ?>
	<?php while( $feat_grid1_query -> have_posts() ) : $feat_grid1_query -> the_post(); ?>
		<div class="feat-index-divider">
			<?php if ( has_post_thumbnail() ) {
				echo '<div class="feat-home-index-thumb">';
				echo '<div class="index-cat"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Featured', 'wise-blog' ) . '</a></div>';
				echo '<a href="';
				echo esc_url(get_permalink());
				echo ' ">';
				the_post_thumbnail('wise-post-thumb');
				echo '</a></div>';
			} else { null; } // If there's no image then nothing will display
			?>
			<div class="feat-title-content-index">
				<header class="feat-entry-header-index">
					<?php the_title( sprintf( '<h1 class="entry-title-index-feat"><a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a></h1>' ); ?>
					
					<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta-index">
						<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php wise_comments(); ?>
						<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</header><!-- End of .feat-entry-header -->

			</div><!-- End of .feat-title-content-index -->
		</div><!-- End of Index Divider -->
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
	<?php if( ( $wise_feat_num > 1 ) && ( $count_featid > 1 || $wise_feat_id == null ) ) : // if featured number is less than 1, don't display sub-grid ?>
	<?php
		$wise_get_firstID = wp_list_pluck( $feat_grid1_query->posts, 'ID' ); // get array from the first query
		$wise_get_firstID = implode(',', $wise_get_firstID); // convert array into value
		
		$feat_grid2_queryall = new WP_Query( array ( 'post_type' => 'post', 'meta_query' => wise_featured_post(), 'category_name' => $wise_slider_categ, 'offset' => 0, 'posts_per_page' => -1, 'ignore_sticky_posts' => 1 ) );		
		$wise_get_secondID = wp_list_pluck( $feat_grid2_queryall->posts, 'ID' ); // get array for the second query

		if( $wise_feat_id != null ) {
			$feat_id_sub = explode(',', $wise_feat_id);
			if ( ( $feat_id_key = array_search( $wise_get_firstID, $feat_id_sub ) ) !== false ) { // search the first ID on the query
				unset($feat_id_sub[$feat_id_key]); // unset the first ID on the first query
			}
		} else {
			if ( ( $feat_id_key = array_search( $wise_get_firstID, $wise_get_secondID ) ) !== false ) { // search the first ID on the query
				unset($wise_get_secondID[$feat_id_key]); // unset the first ID on the first query
			}
		}
		
		if( $wise_feat_id != null ) {
			$feat_grid2_query = new WP_Query( array ( 'post__in' => $feat_id_sub, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder_in, 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
		} else {
			$feat_grid2_query = new WP_Query( array ( 'post__in' => $wise_get_secondID, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => $wise_sliderorder, 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1, 'order' => $ascdesc ) );
		} ?>
	<div class="index-wrapper-outer">
		<div class="index-wrapper-grid">
			<?php while( $feat_grid2_query -> have_posts() ) : $feat_grid2_query -> the_post(); ?>
				<div class="index-divider-grid">
					<article <?php post_class(); ?>>

					<?php if ( has_post_thumbnail() ) {
						echo '<div class="feat-home-index-thumb">';
						echo '<div class="index-cat"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html__( 'Featured', 'wise-blog' ) . '</a></div>';
						echo '<a href="';
						echo esc_url(get_permalink());
						echo ' ">';
						the_post_thumbnail('wise-home-thumb');
						echo '</a></div>';
					} else { null; } // If there's no image then nothing will display
					?>						
						<div class="title-content-index-grid">
							<header class="entry-header-index-grid">
								<?php the_title( sprintf( '<h3 class="entry-title-index title-sub"><a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a></h3>' ); ?>
								
								<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta-index">
									<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php wise_comments(); ?>
									<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- .entry-meta -->
								<?php endif; ?>
							</header><!-- End of .entry-header -->

						</div><!-- End of .title-content-index -->
					</article><!-- End of #post-## -->	
				</div><!-- End of Index Divider -->
			<?php endwhile; ?>
		</div>
		
	</div><!-- End of Index Wrapper Outer -->
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>
	
<?php endif; ?>