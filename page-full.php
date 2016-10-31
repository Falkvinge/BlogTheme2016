<?php 
/*
* Template Name: Page Full
*
*/
get_header(); ?>
<?php $wise_page_feat = carbon_get_post_meta(get_the_ID(), 'wise_page_feat');
	  $wise_page_share = carbon_get_post_meta(get_the_ID(), 'wise_page_share'); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">
			<main id="main" class="site-main true-full-page">
				<?php $wise_endis_home = carbon_get_post_meta(get_the_ID(), 'wise_endis_homepage');
					if( $wise_endis_home == 'enable' ) {
						echo '<div class="page-full">';
						echo get_sidebar('home');
						echo '</div>';
					} else { 
						while ( have_posts() ) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('page-full'); ?>>
								<header class="entry-header">
									<div class="top-meta">
										<?php wise_breadcrumbs(); ?>
									</div><!-- End of .top-meta -->
									
									<?php the_title( '<h2 class="entry-title center">', '</h2>' ); ?>
									<?php if( $wise_page_share == 'enable' ) : ?>
										<div class="center">
											<?php get_template_part('templates/custom-social'); ?>
										</div><!-- End of Custom Social -->
									<?php endif; ?>
								</header><!-- End of .entry-header -->
								
								<?php if( $wise_page_feat == 'enable' ) : ?>
									<?php if( has_post_thumbnail() ) :
											echo '<div class="single-post-thumb">';
											echo the_post_thumbnail('wise-post-thumb');
											echo '</div>'; endif; ?>
								<?php endif; ?>

								<div class="entry-content">
									<?php the_content(); ?>
									<?php wise_custom_wp_link_pages(); ?>
								</div><!-- End of .entry-content -->

								<footer class="entry-footer">
									<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- End of .entry-footer -->
								
								<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								?>
							</article><!-- End of #post-## -->

						<?php endwhile; // End of the loop.

					} // End conditionals ?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>