<?php
/*
* Content Featured Defaults Grid
*
*/
?>
<?php if (!is_paged()): ?>
	<?php
		global $wise_feat_num, $wise_slider_categ, $wise_feat_id;
		$number_featured = $wise_feat_num - 1;
		$feat_id = explode(',', $wise_feat_id);
		if( $wise_feat_id == true ) {
			query_posts( array ( 'post__in' => $feat_id, 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => 'post__in', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1 ) );
		} else {
			query_posts( array ( 'meta_key' => 'wise_featured_post', 'category_name' => $wise_slider_categ, 'offset' => 0, 'orderby' => 'date', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1 ) );
		}
		?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="feat-index-divider">
			<?php if ( has_post_thumbnail() ) {
				echo '<div class="feat-home-index-thumb">';
				echo '<div class="index-cat"><a href="' . esc_url(esc_url(get_the_permalink())) . '">' . esc_html__( 'Featured', 'wise-blog' ) . '</a></div>';
				echo '<a href="';
				echo esc_url(get_permalink());
				echo ' ">';
				echo the_post_thumbnail('wise-post-thumb');
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

	<?php wp_reset_query(); ?>
	
	<?php if( $wise_feat_id == true ) {
			query_posts( array ( 'post__in' => $feat_id, 'category_name' => $wise_slider_categ, 'offset' => 1, 'orderby' => 'post__in', 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1 ) );
		} else {
			query_posts( array ( 'meta_key' => 'wise_featured_post', 'category_name' => $wise_slider_categ, 'offset' => 1, 'orderby' => 'date', 'posts_per_page' => $number_featured, 'ignore_sticky_posts' => 1 ) );
		} ?>
	<div class="index-wrapper-outer">
		<div class="index-wrapper-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="index-divider-grid">
					<article <?php post_class(); ?>>

					<?php if ( has_post_thumbnail() ) {
						echo '<div class="feat-home-index-thumb">';
						echo '<div class="index-cat"><a href="' . esc_url(esc_url(get_the_permalink())) . '">' . esc_html__( 'Featured', 'wise-blog' ) . '</a></div>';
						echo '<a href="';
						echo esc_url(get_permalink());
						echo ' ">';
						echo the_post_thumbnail('wise-home-thumb');
						echo '</a></div>';
					} else { null; } // If there's no image then nothing will display
					?>						
						<div class="title-content-index-grid">
							<header class="entry-header-index-grid">
								<?php the_title( sprintf( '<h3 class="entry-title-index title-sub"><a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a></h3>' ); ?>
								
								<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta-index">
									<?php wise_posted_on(); ?><?php wise_comments(); ?>
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
	<?php wp_reset_query(); ?>
	
<?php endif; ?>