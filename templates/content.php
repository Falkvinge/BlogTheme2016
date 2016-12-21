<?php
/*
* Posts Contents
*
*/
?>
<?php $wise_posts_layout = get_option('wise_posts_layout'); ?>
<div class="index-divider<?php if ( $wise_posts_layout == 'grid' ) { echo '-grid'; } ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php // index_cat will display only if the archive title is not equal to each index_cat
		if( has_category() ) : // If it has category
		$categories = get_the_category(); 
		$first_cats = ($categories[0]->name);
		$single_cat_title = single_cat_title( '', false ); endif;
		
		if ( has_post_thumbnail() ) {
			echo '<div class="home-index-thumb';
			if ( $wise_posts_layout == 'grid' ) { echo '-grid'; }
			echo '">';
			if ( (has_category()) && ($first_cats != $single_cat_title) ) {
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
		
		<div class="title-content-index<?php if ( $wise_posts_layout == 'grid' ) { echo '-grid'; } ?> <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
			<header class="entry-header-index<?php if ( $wise_posts_layout == 'grid' ) { echo '-grid'; } ?>">
				
				<?php
					echo '<h2 class="entry-title-index';
					if( $wise_posts_layout == 'grid' ) { echo '-grid title-sub'; }
					echo '">';
					echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h2>';
				?>
				
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta-index">
					<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php printf( '<span class="post-views"> %d</span>', wise_get_post_views( get_the_ID() ) ); ?><?php wise_comments(); ?>
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
