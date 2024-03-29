<?php
/*
* Content Complex Defaults-3
*
*/
?>
<article <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) {
		echo '<div class="home-index-thumb zero">';

		echo '<a href="';
		echo esc_url(get_permalink());
		echo ' ">';
		the_post_thumbnail('wise-related-thumb');
		echo '</a></div>';
	} else { null; } // If there's no image then nothing will display
	?>
	
	<div class="title-content-index zero <?php if ( !has_post_thumbnail() ) { echo 'full-block-layout'; } ?>">
		<header class="entry-header-index">
			
			<?php
				echo '<h3 class="entry-title-index">';
				echo '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . esc_html( get_the_title() ) . '</a></h3><span class="entry-meta-subig">';
				if( function_exists('wise_posted_on') ) : wise_posted_on(); endif; echo '</span>';
			?>
			
		</header><!-- .entry-header -->

	</div><!-- title-content-index -->
</article><!-- #post-## -->
