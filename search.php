<?php
/*
* Template to Display Search Page
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">
			<main id="main" class="site-main single-page">
			
				<?php if ( have_posts() ) : ?>

					<?php if(get_option('wise_posts_layout') == 'grid') { echo '<div class="index-wrapper-outer">'; } ?>
						<div id="index-lists<?php if (get_option('wise_posts_layout')) { echo '-' . esc_attr(get_option('wise_posts_layout')); } ?>" class="index-wrapper page-singles">
						
						<header class="page-header">
							<h2 class="page-title-archive"><?php printf( esc_html__( 'Search Results for: %s', 'wise-blog' ), '<span><em>&#34;' . get_search_query() . '&#34;</em></span>' ); ?></h2>
						</header><!-- End of .page-header -->
						
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'templates/content', 'search' ); ?>

						<?php endwhile; ?>
						<?php wise_paging_nav(); ?>
						</div>
					<?php if(get_option('wise_posts_layout') == 'grid') { echo '</div>'; } ?>

				<?php else : ?>

					<?php get_template_part( 'templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
