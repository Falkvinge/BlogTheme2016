<?php
/*
* Content Page
*
*/
?>
<?php $wise_page_feat = carbon_get_post_meta(get_the_ID(), 'wise_page_feat');
	  $wise_page_share = carbon_get_post_meta(get_the_ID(), 'wise_page_share'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="top-meta">
			<?php wise_breadcrumbs(); ?>
		</div><!-- End of .top-meta -->
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if( $wise_page_share == 'enable' ) : ?>
			<?php get_template_part('templates/custom-social'); ?>
		<?php endif; ?>
	</header><!-- End of .entry-header -->
	
	<?php if( $wise_page_feat == 'enable' ) : ?>
		<?php if( has_post_thumbnail() ) :
				echo '<div class="single-post-thumb">';
				echo the_post_thumbnail('wise-post-thumb');
				echo '</div>'; endif; ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wise_custom_wp_link_pages(); ?>
	</div><!-- End of .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- End of .entry-footer -->
</article><!-- End of #post-## -->

