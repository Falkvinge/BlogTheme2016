<?php
/*
* Index Page
*
*/
get_header(); ?>
<div id="blog">
	<div class="content-wrapper-outer">
		<div class="content-wrapper" data-sticky_parent>
			<?php get_sidebar('docs_top'); ?>
			<div id="primary" class="content-area">	
				<?php get_sidebar('pageleft'); ?>
				<main id="main" class="site-main">
					
					<?php
						if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
						elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
						else { $paged = 1; }
						$number_default = get_theme_mod('wise_def_posts');
						query_posts( array('post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'date', /* 'posts_per_page' => $number_default, */ 'paged' => $paged ) ); ?>
					<?php if ( have_posts() ) : ?>
					<?php if(get_theme_mod('wise_def_name')) { echo '<header class="page-header"><h1 class="page-title-archive">' . esc_html(get_theme_mod('wise_def_name')) . '</h1></header>'; } ?>
					
						<?php if(get_theme_mod('wise_posts_layout') == 'grid') { echo '<div class="index-wrapper-outer">'; } ?>
							<div id="index-lists<?php if (get_theme_mod('wise_posts_layout')) { echo '-' . esc_attr(get_theme_mod('wise_posts_layout')); } ?>" class="index-wrapper<?php if (get_theme_mod('wise_posts_layout')) { echo '-' . esc_attr(get_theme_mod('wise_posts_layout')); } ?>">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'templates/content', get_post_format() ); ?>

							<?php endwhile; ?>
							</div>
						<?php if(get_theme_mod('wise_posts_layout') == 'grid') { echo '</div>'; } ?>
						
						<?php wise_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'templates/content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- End of #main -->
			</div><!-- End of #primary -->
			
			<?php get_sidebar(); ?>
		</div><!-- End of #content-wrapper -->
	</div><!-- End of #content-wrapper-outer -->
</div><!-- #blog Smooth Scrolling -->
<?php get_footer(); ?>