<?php
/*
* Template to Display bbPress
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">	
			<main id="main" class="site-main-two-column">	 
				<?php while ( have_posts() ) : the_post(); ?>
				 
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
					<header class="page-header">			 
						<h2 class="page-title-archive"><?php the_title(); ?></h2>			 
					</header>			 
					<div class="entry-content">
						<?php the_content(); ?>
					</div>		 
				</article>		 
				
				<?php endwhile;?>
			</main><!-- End of #main -->			 
		</div><!-- End of #primary -->
		
		<?php get_sidebar('forum'); ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>