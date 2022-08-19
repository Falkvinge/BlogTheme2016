<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Featured Contents Block */
global $wp_cats, $wise_slideblock_name;
$wise_slideblock_name = esc_attr__( 'Wise Featured Contents Block', 'wise-blog' );
Block::make( esc_attr( $wise_slideblock_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_slideblock_title', esc_attr__( 'Wise Featured Contents Block', 'wise-blog' ) ),
		Field::make( 'text', 'wise_featured_id', esc_attr__( 'Posts ID (separate by comma: 1, 2, 3; leave blank to automate)', 'wise-blog' ) ),
		Field::make( 'select', 'wise_featured_type', esc_attr__( 'Block Type', 'wise-blog' ) )
			->add_options(array(
				'grid' => esc_attr__( 'Grid Type', 'wise-blog' ),
				'carousel' => esc_attr__( 'Carousel Type', 'wise-blog' ),
			))
			->set_default_value('grid'),
		Field::make( 'select', 'wise_slider_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'select', 'wise_slider_orderby', esc_attr__( 'Order by', 'wise-blog' ) )
			->add_options(array(
				'' => '',
				'date' => esc_attr__( 'Date', 'wise-blog' ),
				'rand' => esc_attr__( 'Random', 'wise-blog' ),
				'title' => esc_attr__( 'Title', 'wise-blog' ),
				'comment_count' => esc_attr__( 'Comment', 'wise-blog' ),
			))->set_default_value(''),
		Field::make( 'text', 'wise_featured_number', esc_attr__( 'No. of Featured Posts', 'wise-blog' ) )
			->set_default_value('3'),
		Field::make( 'text', 'wise_feat_time_cover', esc_attr__( 'Slider Speed in Seconds', 'wise-blog' ) )
	))
	->set_description( esc_attr__( 'Displays home slider in grid or carousel format.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php

		global $wise_slideblock_name, $wise_feat_num, $wise_slider_categ, $wise_feat_id, $wise_feat_time_cover, $wise_slider_orderby;
        $wise_feat_type = !empty( $fields['wise_featured_type'] ) ? $fields['wise_featured_type'] : '';
		$wise_feat_num = !empty( $fields['wise_featured_number'] ) ? $fields['wise_featured_number'] : '';
		$wise_feat_time_cover = !empty( $fields['wise_feat_time_cover'] ) ? $fields['wise_feat_time_cover'] : '';
		$wise_slider_categ = !empty( $fields['wise_slider_categ'] ) ? $fields['wise_slider_categ'] : '';
		$wise_slider_orderby = !empty( $fields['wise_slider_orderby'] ) ? ( $fields['wise_slider_orderby'] ) : '';
        $wise_feat_id = !empty( $fields['wise_featured_id'] ) ? $fields['wise_featured_id'] : '';
        
        if($wise_feat_type == 'carousel') {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-featured-contents-slide-block.jpg';
        } else {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-featured-contents-grid-block.jpg';
        }

        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_slideblock_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php
		
		if( !empty('$wise_feat_type') ) :
			get_template_part( 'templates/custom_templates/content', 'featured-' . $wise_feat_type );
        endif;
        
        ?></div><?php

	} ); // End set_render_callback
