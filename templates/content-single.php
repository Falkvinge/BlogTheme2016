<?php
/*
* Content Single
*
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="top-meta">
			<?php wise_breadcrumbs(); ?>			
		</div><!-- End of .top-meta -->
		
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>		

		<div class="entry-meta">
			<?php echo wise_entry_header(); ?><br>
			<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php echo '<span class="post-views"> ' . wise_get_post_views(get_the_ID()) . '</span>'; ?><?php wise_comments(); ?>
		</div><!-- End of .entry-meta -->
		<!--<div class="share-entry-meta">-->
			<?php /* get_template_part('templates/custom-social'); --commented out; no other way to disable pre-article social buttons */ ?>
		<!--</div>--><!-- End of Custom Social -->
	</header><!-- End of .entry-header -->
	
	<?php if( has_post_thumbnail() ) :
			echo '<div class="single-post-thumb">';
			echo the_post_thumbnail('wise-post-thumb');
			echo '</div>'; endif; ?>
			
	<?php if( get_option('wise_enable_aff_top') == true ) : echo wise_affiliates_disclaimer(); endif; ?>
	
	<div class="entry-content">
		<?php global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true); ?>
		<?php if($disable_ads == false) : echo ads_top_post(); endif; ?>
		<?php /* wise_cont_ads(); */ falkvinge_formatted_post(); ?>
		<?php wise_custom_wp_link_pages(); ?>
		
		<?php if( get_option('wise_enable_aff_top') == false ) : echo wise_affiliates_disclaimer(); endif; ?>
		
	</div><!-- End of .entry-content -->

	<footer class="entry-footer clear">
		<?php wise_entry_footer(); ?>	
	</footer><!-- End of .entry-footer -->
	
	<?php if($disable_ads == false) : echo ads_bottom_post_1(); endif; ?>
		
	<div class="share-entry-meta">
		<?php get_template_part('templates/custom-social'); ?>
	</div><!-- Custom Social -->

	<?php if( get_option('wise_disable_author_posts') == false ) { ?>
	<!-- About The Author -->
	<div class="author-posts">
		<span class="alignleft"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 102 ); ?></span>
		<div class="author-name-info">
			<h3><?php echo get_the_author(); ?></h3>
			<div class="author-posts-info">
				<?php the_author_meta( 'description' ); ?>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<?php /* wise_single_post_nav(); --Falkvinge disabled prev/next links-- */ ?>
	
	<?php if($disable_ads == false) : echo ads_bottom_post_2(); endif; ?>
		
	<?php
		/* Related Posts */
		//for use in the loop, list 4 post titles related to first tag on current post
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {		
		$first_tag = $tags[0]->term_id;
		$args=array(
		'tag__in' => array($first_tag),
		'post__not_in' => array($post->ID),
		'posts_per_page'=>3,
		'ignore_sticky_posts'=>1
		);
		$wise_rel_query = new WP_Query($args);
		if( $wise_rel_query->have_posts() ) {
		echo '<h2 class="page-title">' . esc_html__( 'Related Posts', 'wise-blog' ) . '</h2>';
		echo '<div class="index-wrapper-outer"><div id="comp4" class="col-4">';
		while ($wise_rel_query->have_posts()) : $wise_rel_query->the_post(); ?>
			<div class="comp-grid-3 related-proper">
				<?php get_template_part( 'templates/content', 'related' ); ?>
			</div>
		<?php
		endwhile;
		echo '</div></div>';
		}		
		wp_reset_postdata();
		}
	?>
	
	<?php if($disable_ads == false) : echo ads_bottom_post_3(); endif; ?>
	
</article><!-- End of #post-## -->

