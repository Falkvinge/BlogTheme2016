<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Ticker Block */
global $wp_cats, $wise_tickblock_name;
$wise_tickblock_name = esc_attr__( 'Wise Ticker Block', 'wise-blog' );
Block::make( esc_attr( $wise_tickblock_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_tickblock_title', esc_attr__( 'Wise Ticker Block', 'wise-blog' ) ),
		Field::make( 'text', 'wise_tick_id', esc_attr__( 'Custom ID', 'wise-blog' ) ),
		Field::make( 'text', 'wise_tname', esc_attr__( 'Wise Ticker Label', 'wise-blog' ) ),
		Field::make( 'select', 'wise_ttype', esc_attr__( 'Type of Posts to Show', 'wise-blog' ) )
			->add_options(array(
				'trending' => esc_attr__( 'Trending Posts by Views', 'wise-blog' ),
				'trendingc' => esc_attr__( 'Trending Posts by Comments', 'wise-blog' ),
				'latest' => esc_attr__( 'Latest Posts', 'wise-blog' ),
			))->set_default_value('trending'),
		Field::make( 'select', 'wise_ttype_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'text', 'wise_tnumber', esc_attr__( 'No. of Posts', 'wise-blog' ) )
			->set_default_value('7'),
		Field::make( 'text', 'wise_tick_time', esc_attr__( 'Ticker Speed in Seconds', 'wise-blog' ) ),
	))
	->set_description( esc_attr__( 'Displays wise ticker block.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php

		global $wise_tickblock_name, $wise_tnumber, $wise_ttype, $wise_ttype_categ, $wise_tick_time, $wise_ticker_id;
		$wise_tick_id = !empty( $fields['wise_tick_id'] ) ? ( $fields['wise_tick_id'] ) : '';
		$wise_tname = !empty( $fields['wise_tname'] ) ? ( $fields['wise_tname'] ) : '';
		$wise_ttype = !empty( $fields['wise_ttype'] ) ? ( $fields['wise_ttype'] ) : '';
		$wise_ttype_categ = !empty( $fields['wise_ttype_categ'] ) ? ( $fields['wise_ttype_categ'] ) : '';
		$wise_tnumber = !empty( $fields['wise_tnumber'] ) ? ( $fields['wise_tnumber'] ) : '';
		$wise_tick_time = !empty( $fields['wise_tick_time'] ) ? ( $fields['wise_tick_time'] ) : '';
		$wise_tds_home = !empty( $fields['tdis_home'] ) ? ( $fields['tdis_home'] ) : '';
		$wise_tds_archive = !empty( $fields['tdis_arch'] ) ? ( $fields['tdis_arch'] ) : '';
		$wise_tds_post = !empty( $fields['tdis_post'] ) ? ( $fields['tdis_post'] ) : '';
		$wise_tds_page = !empty( $fields['tdis_page'] ) ? ( $fields['tdis_page'] ) : '';

		if( !empty($wise_tick_id) ) {
			$wise_ticker_id = $wise_tick_id;
		} else {
			$wise_ticker_id = uniqid();
        }
        
        $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-ticker-block.jpg';
        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_tickblock_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php

		if( is_single() || is_page() ) { $disable_ads = function_exists('carbon_get_post_meta') ? carbon_get_post_meta( get_the_ID(), 'wise_disads_post' ) : null; } else { $disable_ads = null; }

		if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
			if( !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && !is_bbpress() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker wise-block-ticker<?php echo '-' . esc_attr($wise_ticker_id); ?> clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true  ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php if( !empty($wise_tname) ) { echo esc_html($wise_tname); } else { echo esc_html__( 'Trending Now', 'wise-blog' ); } ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
			if( !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker wise-block-ticker<?php echo '-' . esc_attr($wise_ticker_id); ?> clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php if( !empty($wise_tname) ) { echo esc_html($wise_tname); } else { echo esc_html__( 'Trending Now', 'wise-blog' ); } ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} elseif( function_exists('is_bbpress') ) { // If bbPress exists
			if( !is_404() && !is_search() && !is_attachment() && !is_bbpress() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker wise-block-ticker<?php echo '-' . esc_attr($wise_ticker_id); ?> clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php if( !empty($wise_tname) ) { echo esc_html($wise_tname); } else { echo esc_html__( 'Trending Now', 'wise-blog' ); } ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} else {
			if( !is_404() && !is_search() && !is_attachment() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker wise-block-ticker<?php echo '-' . esc_attr($wise_ticker_id); ?> clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php if( !empty($wise_tname) ) { echo esc_html($wise_tname); } else { echo esc_html__( 'Trending Now', 'wise-blog' ); } ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
        }
        
        ?></div><?php

	} ); // End set_render_callback