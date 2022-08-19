<?php 
/*
* Template Name: Page Full
*
*/
get_header(); ?>
<?php $wise_page_feat = function_exists('carbon_get_post_meta') ? carbon_get_post_meta(get_the_ID(), 'wise_page_feat') : null;
	  $wise_page_share = function_exists('carbon_get_post_meta') ? carbon_get_post_meta(get_the_ID(), 'wise_page_share') : null; ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
		<?php get_sidebar('docs_top'); ?>
		<div id="primary" class="content-area">

			<main id="main" class="site-main true-full-page">
				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('page-full'); ?>>
					<header class="entry-header">
						<?php if( function_exists('wise_breadcrumbs') && get_theme_mod('wise_dis_breadcrumbs') == null ) : ?>
						<div class="top-meta">
							<?php wise_breadcrumbs(); ?>
						</div><!-- End of .top-meta -->
						<?php endif; ?>
						
						<?php $wise_title_align = function_exists('carbon_get_post_meta') ? carbon_get_post_meta(get_the_ID(), 'wise_page_title_align') : null; ?>
						<?php 	if($wise_title_align == 'center') {
									the_title( '<h1 class="entry-title center">', '</h1>' );
									if( $wise_page_share == true ) : ?>
										<div class="center">
											<?php if( function_exists('wise_share_buttons') ) : wise_share_buttons(); endif; ?>
										</div><!-- End of Custom Social -->
									<?php endif;
								} elseif($wise_title_align == 'right') {
									the_title( '<h1 class="entry-title tright">', '</h1>' );
									if( $wise_page_share == true ) : ?>
										<div class="tright">
											<?php if( function_exists('wise_share_buttons') ) : wise_share_buttons(); endif; ?>
										</div>
									<?php endif;
								} else {
									the_title( '<h1 class="entry-title">', '</h1>' );
									if( $wise_page_share == true ) : ?>
										<?php if( function_exists('wise_share_buttons') ) : wise_share_buttons(); endif; ?>
									<?php endif;
								} ?>
					</header><!-- End of .entry-header -->
					
					<?php if( $wise_page_feat == true ) : ?>
						<?php if( has_post_thumbnail() ) :
								echo '<div class="single-post-thumb">';
								the_post_thumbnail('wise-post-thumb');
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

				<?php endwhile; // End of the loop. ?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
