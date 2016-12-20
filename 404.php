<?php
/*
* Template to Display 404 Error Page
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">
			<?php get_sidebar('left'); ?>
			<main id="main" class="site-main">
				<?php get_template_part( 'templates/content', 'none' ); ?>
			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
		<?php get_sidebar(); ?>	
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
