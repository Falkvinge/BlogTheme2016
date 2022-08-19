<?php
/*
* Content None
*
*/
?>
<section class="<?php if (is_404 ()) { echo 'no-results'; } else { echo 'error-404'; } ?> not found">
	<header class="page-header">
		<h1 class="page-title-archive">
			<?php 
				if (is_404()) {
					echo esc_html__( 'Sorry! Page Not Found', 'wise-blog' );
				} elseif(is_search()) { 
					echo esc_html__( 'Nothing found for', 'wise-blog' ) . ' &#34;<em>' . get_search_query() . '&#34;</em>';
				} else {
					echo esc_html__( 'Nothing Found', 'wise-blog' );
				}
				?>
		</h1>
	</header><!-- End of .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<div class="wise-error-message"><p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wise-blog' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p></div>
			
		<?php elseif ( is_404() ) : ?>

			<div class="wise-error-message"><p><?php esc_html_e( 'The article you requested has either been removed or doesn&rsquo;t exist in our site. Check out the articles below or try searching.', 'wise-blog' ); ?></p></div>
			<?php get_search_form(); ?>
		
		<?php elseif ( is_search() ) : ?>

			<div class="wise-error-message"><p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Check out the articles below or try again with some different keywords.', 'wise-blog' ); ?></p></div>
			<?php get_search_form(); ?>

		<?php else : ?>

			<div class="wise-error-message"><p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wise-blog' ); ?></p></div>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- End of .page-content -->
	
	<?php if ( is_404() || is_search() ) : ?>
	
		<?php query_posts( array('post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'rand' ) ); ?>
		<?php if ( have_posts() ) : ?>
		<?php if(get_theme_mod('wise_def_name')) { echo '<header class="page-header"><h1 class="page-title">' . esc_html__('Consider These Articles','wise-blog') . '</h1></header>'; } ?>
			
			<?php if(get_theme_mod('wise_posts_layout') == 'grid') { echo '<div class="index-wrapper-outer">'; } ?>
				<div id="index-lists<?php if (get_theme_mod('wise_posts_layout')) { echo '-' . get_theme_mod('wise_posts_layout'); } ?>" class="index-wrapper<?php if (get_theme_mod('wise_posts_layout')) { echo '-' . esc_attr(get_theme_mod('wise_posts_layout')); } ?>">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/content', get_post_format() ); ?>

				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
				</div>
			<?php if(get_theme_mod('wise_posts_layout') == 'grid') { echo '</div>'; } ?>
			
		<?php endif; ?>
	
	<?php endif; ?>

</section><!-- End of .no-results -->
