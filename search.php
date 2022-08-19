<?php
/*
* Template to Display Search Page
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>	
		<div id="primary" class="content-area">
			<?php get_sidebar('pageleft'); ?>
			<main id="main" class="site-main">
			
				<?php if ( have_posts() ) : ?>
				
					<header class="page-header">
						<h1 class="page-title-archive"><?php echo esc_html__( 'Search Results for: ', 'wise-blog' ), '<span><em>&#34;' . get_search_query() . '&#34;</em></span>'; ?></h1>
					</header><!-- End of .page-header -->

					<?php $wise_post_layout = get_theme_mod('wise_posts_layout'); if( $wise_post_layout == 'grid' ) { echo '<div class="index-wrapper-outer">'; } ?>
						<div id="index-lists<?php if( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>" class="index-wrapper<?php if( $wise_post_layout == 'grid' ) { echo '-grid'; } ?>">
						
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'templates/content', 'search' ); ?>

						<?php endwhile; ?>
						<?php wise_paging_nav(); ?>
						</div>
					<?php if( $wise_post_layout == 'grid' ) { echo '</div>'; } ?>

				<?php else : ?>

					<?php get_template_part( 'templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
		<?php get_sidebar(); ?>	
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
