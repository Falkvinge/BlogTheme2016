<?php
use Carbon_Fields\Widget;
use Carbon_Fields\Field;

/* Wise Ads */
class WiseAds extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( esc_attr__( '#Wise Ads', 'wise-blog' ), esc_attr__( 'Displays advertisement dynamically.', 'wise-blog' ), array(
            Field::make('textarea', 'wise_ads_code', esc_attr__( 'Enter Ads code here.', 'wise-blog' ) ),
			Field::make("checkbox", "homeblock_fix", esc_attr__( 'Check if Used in Top/Bottom Ads', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("select", "adis_home_back", esc_attr__( 'Enable/Disable Background for Top/Bottom Ads', 'wise-blog' ) )
				->add_options(array(
					'withback' => esc_attr__( 'With Background', 'wise-blog' ),
					'noback' => esc_attr__( 'No Background', 'wise-blog' ),
				))->set_default_value('withback'),
			Field::make("checkbox", "sidebar_fix", esc_attr__( 'Check if Used in Sidebar', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "adis_paginate", esc_attr__( 'Disable if Paginated', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "adis_home", esc_attr__( 'Disable on Homepage', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "adis_arch", esc_attr__( 'Disable on Archive', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "adis_post", esc_attr__( 'Disable on Posts', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "adis_page", esc_attr__( 'Disable on Pages', 'wise-blog' ) )
				->set_option_value('yes')
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $sidebar_ads, $block_ads, $home_block_ads;
        $wise_ads_code = $instance['wise_ads_code'];
		$home_block_ads = '<div class="ads-layout_bottom">' . $wise_ads_code . '</div>';
		$sidebar_ads = '<aside class="widget ads-layout_sidebar">' . $wise_ads_code . '</aside>';
		$adis_home_back = $instance['adis_home_back'];
		$block_ads = '<div class="sbottom-wrapper"';
		$block_ads .= ($adis_home_back == 'noback') ? ' style="background: transparent !important;"' : '';
		$block_ads .= '><div class="ads-layout_both">' . $wise_ads_code . '</div></div>';
		$wise_ads_home = $instance['adis_home'];
		$wise_ads_archive = $instance['adis_arch'];
		$wise_ads_post = $instance['adis_post'];
		$wise_ads_page = $instance['adis_page'];
		$wise_ads_paginate = $instance['adis_paginate'];
		$wise_use_sidebar = $instance['sidebar_fix'];
		$wise_use_block = $instance['homeblock_fix'];
		
		global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true);
		if(is_single() || is_page()) { // If it is single with disable ads per post
			if( $disable_ads == false ) :
				if( $wise_ads_paginate == true && is_paged() ) { // If paginated
					null;
				} else { // If not paginated
					if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && !is_bbpress() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} elseif( function_exists('is_bbpress') ) { // If bbPress exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_bbpress() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} else {
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					}
				}
			endif;
		} else { // If it is not a single post
			if( $wise_ads_paginate == true && is_paged() ) { // If paginated
				null;
			} else { // If not paginated
				if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && !is_bbpress() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} elseif( function_exists('is_bbpress') ) { // If bbPress exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_bbpress() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} else {
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ($wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				}
			}
		} // End else
    } // End function
} // End class widget

/* Register Widget */
register_widget('WiseAds');

/* AD functions */
function wise_sidebar_ads() {
	global $sidebar_ads;
	printf( $sidebar_ads );
}

function wise_block_ads() {
	global $block_ads;
	printf( $block_ads );
}

function wise_home_wise_block_ads() {
	global $home_block_ads;
	printf( $home_block_ads );
}