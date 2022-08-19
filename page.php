<?php
/*
* Template to Display Page
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
		<?php get_sidebar('docs_top'); ?>
		<div id="primary" class="content-area">
			<?php get_sidebar('pageleft'); ?>
			<main id="main" class="site-main">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'templates/content', 'page' );
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
					endwhile; // End of the loop.
				?>
			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		<?php get_sidebar('page'); ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
