<?php
/*
* Content Complex Sub-1
*
*/
?>
<div class="index-divider-compsub">
	<article <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) {
			echo '<div class="home-index-thumb-compsub">';

			echo '<a href="';
			echo esc_url(get_permalink());
			echo ' ">';
			the_post_thumbnail('wise-side-thumb');
			echo '</a></div>';
		} else { null; } // If there's no image then nothing will display
		?>
		
		<div class="title-content-index-compsub <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
			<header class="entry-header-index-compsub">				
				<?php
					echo '<h5 class="entry-title-index-compsub">';
					echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h5>';
				?>
			</header><!-- .entry-header -->

		</div><!-- title-content-index -->
	</article><!-- #post-## -->	
</div><!-- index-divider -->