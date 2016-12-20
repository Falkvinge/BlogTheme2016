<?php
/*
* Custom Social Share Buttons
*
*/
if( get_option('wise_disable_share_buttons') == false ) {
	$page_share = is_page() ? ' page-share-entry-meta' : '';
	echo '<div class="share-entry-meta' . esc_attr($page_share) . '"><ul>';
	$share_title = str_replace( ' ', '%20', get_the_title() );
	$share_url = esc_url(esc_url(get_the_permalink()));
	$share_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	
	$share_fb = 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url;
	$share_tw = 'https://twitter.com/intent/tweet?text=' . $share_title .'&amp;url='. $share_url .'&amp;via=' . get_option('wise_twitter_acc');
	$share_gg = 'https://plus.google.com/share?url=' . $share_url;
	$share_ln = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url;
	$share_pt = 'http://pinterest.com/pin/create/button/?url=' . $share_url . '&media=' . $share_img;
	
	echo '<li class="soc-facebook"><a class="my-post-like" data-id="<?php the_ID(); ?>" href="' . esc_url($share_fb) . '" target="_blank"><span class="soc-share">' . esc_html__('Share','wise-blog') . ' </span><span class="soc-on">' . esc_html__('on Facebook', 'wise-blog') . '</span></a></li>';
	echo '<li class="soc-twitter"><a href="' . esc_url($share_tw) . '" target="_blank"><span class="soc-share">' . esc_html__('Tweet','wise-blog') . ' </span><span class="soc-on">' . esc_html__('on Twitter', 'wise-blog') . '</span></a></li>';	
	echo '<li class="soc-google"><a href="' . esc_url($share_gg) . '" target="_blank"><span class="screen-reader-text">' . esc_html__('Google+','wise-blog') . '</span></a></li>';
	echo '<li class="soc-linkedin"><a href="' . esc_url($share_ln) . '" target="_blank"><span class="screen-reader-text">' . esc_html__('LinkedIn','wise-blog') . '</span></a></li>';	
	echo '<li class="soc-pint"><a href="' . esc_url($share_pt) . '" target="_blank"><span class="screen-reader-text">' . esc_html__('Pinterest','wise-blog') . '</span></a></li>';
	echo '</ul></div>';
} else {
	return;
}
?>