<?php
/*
* Content Complex Defaults-5
*
*/
?>
<article <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) {
		echo '<div class="home-index-thumb zero">';

		echo '<a href="';
		echo esc_url(get_permalink());
		echo ' ">';
		echo the_post_thumbnail('wise-related-thumb');
		echo '</a></div>';
	} else { null; } // If there's no image then nothing will display
	?>
	
	<div class="title-content-index zero <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
		<header class="entry-header-index">
			
			<?php
				echo '<h3 class="entry-title-index">';
				echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title() . '</a></h3>';
			?>
			
		</header><!-- .entry-header -->

	</div><!-- title-content-index -->
</article><!-- #post-## -->