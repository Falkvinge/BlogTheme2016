<?php
/*
* Content Wise Ticker
*
*/
?>
<?php global $wise_tnumber, $wise_ttype, $wise_ttype_categ, $wise_tick_time, $wise_ticker_id;
	$cat_name = $wise_ttype_categ;
	if($wise_ttype == 'trending') {
		$wise_ticker_args = array ( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'offset' => 0, 'meta_key' => 'wise_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => $wise_tnumber, 'ignore_sticky_posts' => 1 );
	} elseif($wise_ttype == 'trendingc') {
		$wise_ticker_args = array ( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'offset' => 0, 'orderby' => 'comment_count', 'posts_per_page' => $wise_tnumber, 'ignore_sticky_posts' => 1 );
	} else {
		$wise_ticker_args = array ( 'category_name' => $cat_name, 'post_type' => 'post', 'post_status' => 'publish', 'offset' => 0, 'orderby' => 'date', 'posts_per_page' => $wise_tnumber, 'ignore_sticky_posts' => 1 );
	}
	$wise_ticker_query = new WP_Query($wise_ticker_args);
?>
<div class="ticker-carousel">
	<div id="wise-ticker<?php echo '-' . esc_attr($wise_ticker_id); ?>">
		<?php while( $wise_ticker_query -> have_posts() ) : $wise_ticker_query -> the_post(); ?>
			<div class="wise-ticker-title">
				<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url(get_permalink()) ), '</a>' ); ?>							
			</div><!-- End of .feat-title-content-index -->
		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
		"use strict";
		$('.wise-block-ticker<?php echo '-' . esc_js($wise_ticker_id); ?>').toggleClass('animated fadeIn show');
		$("#wise-ticker<?php echo '-' . esc_js($wise_ticker_id); ?>").owlCarousel({
		  navigation : true,
		  slideSpeed : 300,
		  singleItem: true,
		  autoPlay: <?php if( !empty($wise_tick_time) ) { echo esc_js($wise_tick_time * 1000); } else { echo '3000'; } ?>,
		  navigationText : false,
		  pagination: false,
		  transitionStyle: "fade"
		});
	}); /* End jQuery */
</script>