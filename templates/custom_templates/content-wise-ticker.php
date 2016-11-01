<?php
/*
* Content Wise Ticker
*
*/
?>
<?php global $wise_tnumber, $wise_ttype;
	if($wise_ttype == 'trending') {
	  query_posts( array ( 'offset' => 0, 'meta_key' => 'wise_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => $wise_tnumber, 'ignore_sticky_posts' => 1 ) );		
	} else {
	  query_posts( array ( 'offset' => 0, 'orderby' => 'date', 'posts_per_page' => $wise_tnumber, 'ignore_sticky_posts' => 1 ) );
	}
?>

<div id="wise-ticker" class="ticker-carousel">
	<?php while ( have_posts() ) : the_post(); ?>
			<div class="wise-ticker-title">
					<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a>' ); ?>
			</div><!-- End of .feat-title-content-index -->
	<?php endwhile; ?>

	<?php wp_reset_query(); ?>
</div>	