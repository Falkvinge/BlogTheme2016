<?php
/*
* Content Complex Defaults-1
*
*/
?>
<div class="index-divider zero">
	<article <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) {
			echo '<div class="home-index-thumb">';

			echo '<a href="';
			echo esc_url(get_permalink());
			echo ' ">';
			the_post_thumbnail('wise-home-thumb');
			echo '</a></div>';
		} else { null; } // If there's no image then nothing will display
		?>
		
		<div class="title-content-index <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
			<header class="entry-header-index">
				
				<?php
					echo '<h3 class="entry-title-index">';
					echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h3>';
				?>
				
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta-index">
					<?php wise_posted_on(); ?><?php wise_posted_by(); ?><?php wise_comments(); ?>
					<?php edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-content-index">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</div><!-- title-content-index -->
	</article><!-- #post-## -->
</div><!-- index-divider -->