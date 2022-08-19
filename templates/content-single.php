<?php
/*
* Content Single
*
*/
?>
<?php $wise_disable_ads = function_exists('carbon_get_post_meta') ? carbon_get_post_meta( get_the_ID(), 'wise_disads_post' ) : null; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if( function_exists('wise_breadcrumbs') && get_theme_mod('wise_dis_breadcrumbs') == null ) : ?>
		<div class="top-meta">
			<?php wise_breadcrumbs(); ?>
		</div><!-- End of .top-meta -->
		<?php endif; ?>
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>		

		<div class="entry-meta">
			<?php wise_entry_header(); ?>
			<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php if( function_exists('wise_get_post_views') ) : wise_get_post_views( get_the_ID() ); endif; ?><?php wise_comments(); ?>
		</div><!-- End of .entry-meta -->
		<?php if( function_exists('wise_share_buttons') ) : wise_share_buttons(); endif; ?>
	</header><!-- End of .entry-header -->
	
	<?php global $page; $wise_disingfeat = get_theme_mod('wise_disfeat_singpost');
		if( has_post_thumbnail() && ($page == 1) && ($wise_disingfeat == false) ) :
			echo '<div class="single-post-thumb">';
			the_post_thumbnail('wise-post-thumb');
			echo '</div>'; endif; ?>
			
	<?php if( function_exists('wise_affiliates_disclaimer') && get_theme_mod('wise_aff_top_bottom') == null ) : wise_affiliates_disclaimer(); endif; ?>
	
	<div class="entry-content">
		<?php if( $wise_disable_ads == null && function_exists('ads_top_post') ) : ads_top_post(); endif; ?>
		<?php if( function_exists('wise_cont_ads') ) { wise_cont_ads(); } else { the_content(); } ?>
		<?php /* wise_cont_ads(); */ falkvinge_formatted_post(); ?>
		<?php wise_custom_wp_link_pages(); ?>
		
	<?php if( function_exists('wise_affiliates_disclaimer') && get_theme_mod('wise_aff_top_bottom') == 'bottom' ) : wise_affiliates_disclaimer(); endif; ?>
		
	</div><!-- End of .entry-content -->
	
	<?php wise_entry_footer(); ?>
	
	<?php if( $wise_disable_ads == null && function_exists('ads_bottom_post_1') ) : ads_bottom_post_1(); endif; ?>
		
	<?php if( function_exists('wise_share_buttons') ) : wise_share_buttons(); endif; ?>

	<?php $wise_disauthor = get_theme_mod('wise_disable_author_posts');
		  $wise_authormeta = get_the_author_meta('description');
		  if( $wise_disauthor == false && !empty( $wise_authormeta ) ) { ?>
	<!-- About The Author -->
	<div class="author-posts">
		<span class="alignleft"><?php printf( get_avatar( get_the_author_meta( 'user_email' ), 102 ) ); ?></span>
		<div class="author-name-info">
			<h3><?php echo wp_kses_post(get_the_author()); ?></h3>
			<div class="author-posts-info">
				<?php the_author_meta('description'); ?>
			</div>
		</div>
	</div>
	<?php } ?>
	
	<?php /* wise_single_post_nav(); --Falkvinge disabled prev/next links-- */ ?>
	
	<?php if( $wise_disable_ads == null && function_exists('ads_bottom_post_2') ) : ads_bottom_post_2(); endif; ?>
		
	<?php
		/* Related Posts */
		$tags = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
		if( get_theme_mod('wise_relnum') != null ) {
			$relnum = get_theme_mod('wise_relnum');
		} else {
			$relnum = 6;
		}
		if ($tags && get_theme_mod('wise_relnum') !== 0) {
			$args = array(
				'tag__in' => $tags,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $relnum,
				'ignore_sticky_posts'=> 1,
				'orderby' => 'rand'
			);
			$wise_rel_query = new WP_Query($args);
			if( $wise_rel_query->have_posts() ) {
				echo '<div class="rel-wrapper"><h2 class="page-title">' . esc_html__( 'Related Posts', 'wise-blog' ) . '</h2>';
				echo '<div class="index-wrapper-outer"><div id="comp4" class="col-4">';
				while ($wise_rel_query->have_posts()) : $wise_rel_query->the_post(); ?>
					<div class="comp-grid-3 related-proper">
						<?php get_template_part( 'templates/content', 'related' ); ?>
					</div>
				<?php
				endwhile;
				echo '</div></div></div>';
			} wp_reset_postdata();
		}
	?>
	
	<?php if( $wise_disable_ads == null && function_exists('ads_bottom_post_3') ) : ads_bottom_post_3(); endif; ?>
	
</article><!-- End of #post-## -->

