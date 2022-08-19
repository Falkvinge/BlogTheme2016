<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Ads Block */
global $wp_cats, $wise_adsblock_name;
$wise_adsblock_name = esc_attr__( 'Wise Ads Block', 'wise-blog' );
Block::make( esc_attr( $wise_adsblock_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_adsblock_title', esc_attr__( 'Wise Ads Block', 'wise-blog' ) ),
		Field::make( 'textarea', 'wise_ads_code', esc_attr__( 'Enter Ads code here.', 'wise-blog' ) ),
		Field::make( 'checkbox', 'adis_paginate', esc_attr__( 'Disable if Paginated', 'wise-blog' ) )
			->set_option_value('yes')->set_default_value('yes'),
		Field::make( 'checkbox', 'adis_tagcond', esc_attr__( 'Disable if has tag: wise-noads', 'wise-blog' ) )
			->set_option_value('yes')
	))
	->set_description( esc_attr__( 'Displays ads block.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php

		global $wise_adsblock_name, $sidebar_ads, $block_ads, $home_block_ads;
		$wise_ads_code = !empty( $fields['wise_ads_code'] ) ? $fields['wise_ads_code'] : '';
		$home_block_ads = '<div class="ads-layout_bottom">' . $wise_ads_code . '</div>';
		$adis_home_back = 'withback';
		$block_ads = is_single() ? '<div class="sbottom-wrapper ads-layout_responsive_post"' : '<div class="sbottom-wrapper"';
		$block_ads .= ($adis_home_back == 'noback') ? ' style="background: transparent !important;"' : '';
		$block_ads .= '><div class="ads-layout_both ads-layout_responsive">' . $wise_ads_code . '</div></div>';
		$wise_ads_home = null;
		$wise_ads_archive = null;
		$wise_ads_post = null;
		$wise_ads_page = null;
		$wise_ads_paginate = !empty( $fields['adis_paginate'] ) ? $fields['adis_paginate'] : '';
		$wise_use_sidebar = null;
		$wise_use_block = !empty( $fields['homeblock_fix'] ) ? $fields['homeblock_fix'] : '';
        $wise_tagcond = !empty( $fields['adis_tagcond'] ) ? $fields['adis_tagcond'] : '';
        
        $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-ads-block.jpg';
        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_adsblock_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php
		
		if(is_single() || is_page()) { // If it is single with disable ads per post
			$wise_disable_ads = function_exists('carbon_get_post_meta') ? carbon_get_post_meta( get_the_ID(), 'wise_disads_post' ) : null;
			if( $wise_disable_ads == null ) :
				if( $wise_ads_paginate == true && is_paged() ) { // If paginated
					null;
				} else { // If not paginated
					if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} elseif( function_exists('is_bbpress') ) { // If bbPress exists
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
							if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
						} else { null; }
					} else {
						if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
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
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} elseif( function_exists('is_bbpress') ) { // If bbPress exists
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				} else {
					if( ( $wise_ads_code == true ) && !is_404() && !is_search() && !is_attachment() && ( $wise_ads_home == true ? ( !is_home() && !is_front_page() ) : true ) && ( $wise_ads_archive == true ? !is_archive() : true ) && ( $wise_ads_page == true ? ( !is_page() || is_front_page() ) : true ) && ( $wise_ads_post == true ? !is_single() : true ) && ( $wise_tagcond == true ? !has_tag('wise-noads') : true ) ) {
						if( $wise_use_sidebar == true ) { wise_sidebar_ads(); } elseif( $wise_use_block == true ) { wise_block_ads(); } else { wise_home_wise_block_ads(); }
					} else { null; }
				}
			}
        } // End else
        
        ?></div><?php

	} ); // End set_render_callback

/* AD functions */
if( !function_exists('wise_sidebar_ads') ) :
	function wise_sidebar_ads() {
		global $sidebar_ads;
		echo !empty($sidebar_ads) ? $sidebar_ads : null;
	}
endif;

if( !function_exists('wise_block_ads') ) :
	function wise_block_ads() {
		global $block_ads;
		echo !empty($block_ads) ? $block_ads : null;
	}
endif;

if( !function_exists('wise_home_wise_block_ads') ) :
	function wise_home_wise_block_ads() {
		global $home_block_ads;
		echo !empty($home_block_ads) ? $home_block_ads : null;
	}
endif;