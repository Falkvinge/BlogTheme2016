<?php
/*
* Content Defaults
*
*/
?>
<?php
	if ( get_query_var('paged') ) { $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) { $paged = get_query_var('page');
	} else { $paged = 1; }
	global $wise_post_layout, $wise_lpost_number, $wise_lpost_pagination, $wise_post_categ;
query_posts( array( 'category_name' => $wise_post_categ, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', 'posts_per_page' => $wise_lpost_number, 'paged' => $paged ) ); ?>

<?php if ( have_posts() ) : ?>

	<?php if( $wise_post_layout == 'grid' ) { echo '<div class="index-wrapper-outer">'; } ?>
		<div id="index-lists<?php if ( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>" class="index-wrapper<?php if ( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="index-divider<?php if( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php // index_cat will display only if the archive title is not equal to each index_cat
						if( has_category() ) : // If it has category
						$categories = get_the_category(); 
						$first_cats = ($categories[0]->name);
						$single_cat_title = single_cat_title( '', false ); endif;
						
						if ( has_post_thumbnail() ) {
							echo '<div class="home-index-thumb';
							if ( $wise_post_layout == 'grid' ) { echo '-grid'; }
							echo '">';
							if ( has_category() && ( $first_cats != $single_cat_title ) ) {
								echo '<div class="index-cat">';	
								wise_parent_cat();
								echo '</div>';
							}
							echo '<a href="';
							echo esc_url(get_permalink());
							echo ' ">';
							the_post_thumbnail('wise-home-thumb');
							echo '</a></div>';
						} else { null; } // If there's no image then nothing will display
						?>
						
						<div class="title-content-index<?php if( $wise_post_layout == 'grid' ) { echo '-grid'; } ?> <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
							<header class="entry-header-index<?php if( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>">
								
								<?php
									echo '<h2 class="entry-title-index';
									if( $wise_post_layout == 'grid' ) { echo '-grid title-sub'; }
									echo '">';
									echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h2>';
								?>
								
								<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta-index">
									<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php wise_comments(); ?>
									<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
								</div><!-- End of .entry-meta -->
								<?php endif; ?>
							</header><!-- End of .entry-header -->

							<div class="entry-content-index">
								<?php the_excerpt();
									echo '<a class="read-more" href="' . esc_url(get_permalink()) . '" title="' . esc_attr__('Read More ', 'wise-blog') . esc_attr( get_the_title() ) . '" rel="bookmark">' . esc_html__('Read More ', 'wise-blog') . '</a>';
								?>
							</div><!-- End of .entry-content -->
						</div><!-- End of .title-content-index -->
					</article><!-- End of #post-## -->	
				</div><!-- End of Index Divider -->

			<?php endwhile; ?>
		</div>
	<?php if( $wise_post_layout == 'grid' ) { echo '</div>'; } ?>
	
	<?php if( $wise_lpost_pagination == 'paginate' ) : wise_paging_nav(); endif; wp_reset_query(); ?>

<?php else : ?>

	<?php get_template_part( 'templates/content', 'none' ); ?>

<?php endif; ?>