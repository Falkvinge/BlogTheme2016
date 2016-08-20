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
        $this->setup('#Wise Ads', 'Displays advertisement dynamically.', array(
            Field::make('textarea', 'wise_ads_code', 'Enter Ads code here.'),
			Field::make("checkbox", "adis_home", "Disable on Homepage")
				->set_option_value('yes'),
			Field::make("checkbox", "adis_arch", "Disable on Archive")
				->set_option_value('yes'),
			Field::make("checkbox", "adis_post", "Disable on Posts")
				->set_option_value('yes'),
			Field::make("checkbox", "adis_page", "Disable on Pages")
				->set_option_value('yes'),
			Field::make("checkbox", "adis_paginate", "Disable if Paginated")
				->set_option_value('yes'),
			Field::make("checkbox", "sidebar_fix", "Check if Used in Sidebar")
				->set_option_value('yes')
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
        $wise_ads_code = $instance['wise_ads_code'];
		$block_ads = '<div class="ads-layout_bottom">' . $wise_ads_code . '</div>';
		$sidebar_ads = '<aside class="widget">' . $wise_ads_code . '</aside>';
		$wise_ads_home = $instance['adis_home'];
		$wise_ads_archive = $instance['adis_arch'];
		$wise_ads_post = $instance['adis_post'];
		$wise_ads_page = $instance['adis_page'];
		$wise_ads_paginate = $instance['adis_paginate'];
		$wise_use_sidebar = $instance['sidebar_fix'];
		
		global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true);
		if( $disable_ads == false ) :
			if( $wise_ads_paginate == true && is_paged() ) { // If paginated
				null;
			} else { // If not paginated
				if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && !is_bbpress() && ($wise_ads_home == true ? !is_home() : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? !is_page() : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { echo $sidebar_ads; } else { echo $block_ads; }
					} else { null; }
				} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ($wise_ads_home == true ? !is_home() : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? !is_page() : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { echo $sidebar_ads; } else { echo $block_ads; }
					} else { null; }
				} elseif( function_exists('is_bbpress') ) { // If bbPress exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_bbpress() && ($wise_ads_home == true ? !is_home() : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? !is_page() : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { echo $sidebar_ads; } else { echo $block_ads; }
					} else { null; }
				} else {
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ($wise_ads_home == 'yes' ? !is_home() : true ) && ($wise_ads_home == 'yes' ? !is_front_page() : true ) && ($wise_ads_archive == true ? !is_archive() : true ) && ($wise_ads_page == true ? !is_page() : true ) && ($wise_ads_post == true ? !is_single() : true ) ) {
						if( $wise_use_sidebar == true ) { echo $sidebar_ads; } else { echo $block_ads; }
					} else { null; }
				}
			}
		endif;
    }
}

/* Register Widget */
register_widget('WiseAds');
