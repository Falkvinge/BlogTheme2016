<?php
/*
* Template to Display Post Archive
*
*/
?>
<?php $wise_post_layout = get_option('wise_posts_layout'); ?>
<div class="content-wrapper-outer">
	<div class="content-wrapper" data-sticky_parent>
		<?php get_sidebar('docs_top'); ?>
		<div id="primary" class="content-area">
			<?php get_sidebar('left'); ?>
			<main id="main" class="site-main<?php if( !have_posts() ) : echo ' single-page'; endif; ?>">

			<?php if ( have_posts() ) : ?>
			
				<div class="top-meta-2">
					<?php wise_breadcrumbs(); ?>
				</div><!-- End of Breadcrumbs -->
				
				<?php if( !is_home() ) : ?>
				<header class="page-header">
					<?php	$wise_arch_title = sprintf( '<h2 class="page-title-archive">%s</h2>', get_the_archive_title() );
							echo wp_kses_post( str_replace( 'Category: ', '', $wise_arch_title ) );
							the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
				</header><!-- End of .page-header -->
				<?php endif; ?>

				<?php if( $wise_post_layout == 'grid' ) { 
						echo '<div class="index-wrapper-outer"><div id="index-lists-grid" class="index-wrapper-grid">';
					} else {
						echo '<div id="index-lists" class="index-wrapper">';
					}
				?>
					<?php	while ( have_posts() ) : the_post();
							
								get_template_part( 'templates/content', get_post_format() );								
							
							endwhile; ?>
						
					</div><!-- End Index Wrapper -->
				<?php if( $wise_post_layout == 'grid' ) : echo '</div>'; endif; ?>
				
				<?php wise_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- End of #main -->
		</div><!-- End of #primary -->
		
		<?php get_sidebar(); ?>
	</div><!-- End of #content-wrapper -->
</div><!-- End of #content-wrapper-outer -->
