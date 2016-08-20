<?php
/*
* Template to Display Single Posts
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">
			<?php get_sidebar('left'); ?>
			<main id="main" class="site-main">

				<?php get_template_part( 'templates/content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->

		<?php get_sidebar(); ?>		
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>