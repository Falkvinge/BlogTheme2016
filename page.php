<?php
/*
* Template to Display Page
*
*/
get_header(); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
	
		<div id="primary" class="content-area">
			<?php get_sidebar('left'); ?>
			<main id="main" class="site-main">
				<?php $wise_endis_home = carbon_get_post_meta(get_the_ID(), 'wise_endis_homepage');
					if( $wise_endis_home == 'enable' ) {
						get_sidebar('home');
					} else {
						while ( have_posts() ) : the_post();
							get_template_part( 'templates/content', 'page' );
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
						endwhile; // End of the loop.
					} // End conditionals ?>
			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
		<?php get_sidebar('page'); ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
<?php get_footer(); ?>
