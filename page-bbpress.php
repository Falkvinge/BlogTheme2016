<?php
/*
* Template Name: Page Forum Index
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
		<?php get_sidebar('docs_top'); ?>
		<div id="primary" class="content-area">	
			<main id="main" class="site-main-two-column">	 
				<?php while ( have_posts() ) : the_post(); ?>
				 
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
					<header class="page-header">
						<div class="top-meta">
							<?php bbp_breadcrumb(); ?><div class="clear"></div>
						</div><!-- End of .top-meta -->					
						<h1 class="page-title-archive"><?php the_title(); ?></h1>			 
					</header>			 
					<div class="entry-content">
						<?php if( shortcode_exists('bbp-topic-index') ) : echo do_shortcode('[bbp-forum-index]'); endif; ?>
					</div>		 
				</article>		 
				
				<?php endwhile; ?>
			</main><!-- End of #main -->			 
		</div><!-- End of #primary -->
		
		<?php get_sidebar('forum'); ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
