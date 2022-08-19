<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Complex 2 Block */
global $wp_cats, $wise_comp2block_name;
$wise_comp2block_name = esc_attr__( 'Wise Complex 2 Block', 'wise-blog' );
Block::make( esc_attr( $wise_comp2block_name ) )
	->add_fields( array(
        Field::make( 'separator', 'wise_comp2_title', esc_attr__( 'Wise Complex 2 Block', 'wise-blog' ) ),
		Field::make( 'select', 'wise_c21title_type', esc_attr__( 'Title Design', 'wise-blog' ) )
			->add_options(array(
				'back' => esc_attr__( 'Background', 'wise-blog' ),
				'light' => esc_attr__( 'Light', 'wise-blog' ),
			))->set_default_value('back'),
		// Complex 2-1
		Field::make( 'separator', 'wise_comp_21', esc_attr__( 'Complex 2-1', 'wise-blog' ) ),
		Field::make( 'text', 'wise_c21post_title', esc_attr__( 'Posts Title', 'wise-blog' ) ),
		Field::make( 'checkbox', 'wise_c21post_title_dis', esc_attr__( 'Disable Posts Title', 'wise-blog' ) ),	
		Field::make( 'select', 'wise_c21post_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'text', 'wise_c21post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )
			->set_default_value('5'),

		// Complex 2-2
		Field::make( 'separator', 'wise_comp_22', esc_attr__( 'Complex 2-2', 'wise-blog' ) ),
		Field::make( 'text', 'wise_c22post_title', esc_attr__( 'Posts Title', 'wise-blog' ) ),
		Field::make( 'checkbox', 'wise_c22post_title_dis', esc_attr__( 'Disable Posts Title', 'wise-blog' ) ),
		Field::make( 'select', 'wise_c22post_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'text', 'wise_c22post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )
			->set_default_value('5'),
	))
	->set_description( esc_attr__( 'Displays complex 2 posts block.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php
	
		// Complex 2-1
		global $wise_comp2block_name, $wise_c21post_number, $wise_c21post_categ;
		$wise_c21post_title = !empty( $fields['wise_c21post_title'] ) ? ( $fields['wise_c21post_title'] ) : '';
		$wise_c21post_title_dis = !empty( $fields['wise_c21post_title_dis'] ) ? ( $fields['wise_c21post_title_dis'] ) : '';
		$wise_c21title_type = !empty( $fields['wise_c21title_type'] ) ? ( $fields['wise_c21title_type'] ) : '';
		$wise_c21post_categ = !empty( $fields['wise_c21post_categ'] ) ? ( $fields['wise_c21post_categ'] ) : '';
        $wise_c21post_number = !empty( $fields['wise_c21post_number'] ) ? ( $fields['wise_c21post_number'] ) : '';

		global $wise_c22post_number, $wise_c22post_categ;
		$wise_c22post_title = !empty( $fields['wise_c22post_title'] ) ? ( $fields['wise_c22post_title'] ) : '';
		$wise_c22post_title_dis = !empty( $fields['wise_c22post_title_dis'] ) ? ( $fields['wise_c22post_title_dis'] ) : '';
		$wise_c22post_categ = !empty( $fields['wise_c22post_categ'] ) ? ( $fields['wise_c22post_categ'] ) : '';
		$wise_c22post_number = !empty( $fields['wise_c22post_number'] ) ? ( $fields['wise_c22post_number'] ) : '';
        
        if( $wise_c21title_type == 'light' ) {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-complex-two-light-block.jpg';
        } else {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-complex-two-back-block.jpg';
        }
        
        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_comp2block_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php
		
		if( !empty($wise_c21post_categ) ) {
			$wise_c21post_categ_slug = get_term_by( 'slug', $wise_c21post_categ, 'category' );
			$cat_id1 = $wise_c21post_categ_slug->term_id;
			$cat_url1 = get_category_link( $cat_id1 );
		} else { $wise_c21post_categ_slug = null; }
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><div class="complex-design comp-1"><?php
		if( $wise_c21post_title_dis != 'yes' ) : // if title is not disabled
			if( $wise_c21title_type == 'light' ) {
				if( $wise_c21post_categ == true ) {
					if( !empty($wise_c21post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title-archive">' . esc_html__( 'Complex-2-1', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c21post_title) ) {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html__( 'Complex-2-1', 'wise-blog' ) . '</h2></header>';
					}
				}
			} else {
				if( $wise_c21post_categ == true ) {
					if( !empty($wise_c21post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title">' . esc_html__( 'Complex-2-1', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c21post_title) ) {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html__( 'Complex-2-1', 'wise-blog' ) . '</h2></header>';
					}
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-2-1' ); ?>
		</div><?php endif;
		
		// Complex 2-2
		if( !empty($wise_c22post_categ) ) {
			$wise_c22post_categ_slug = get_term_by( 'slug', $wise_c22post_categ, 'category' );
			$cat_id2 = $wise_c22post_categ_slug->term_id;
			$cat_url2 = get_category_link( $cat_id2 );
		} else { $wise_c22post_categ_slug = null; }
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design comp-2"><?php
		if( $wise_c22post_title_dis != 'yes' ) : // if title is not disabled
			if( $wise_c21title_type == 'light' ) {
				if( $wise_c22post_categ == true ) {
					if( !empty($wise_c22post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title-archive">' . esc_html__( 'Complex-2-2', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c22post_title) ) {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html__( 'Complex-2-2', 'wise-blog' ) . '</h2></header>';
					}
				}
			} else {
				if( $wise_c22post_categ == true ) {
					if( !empty($wise_c22post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title">' . esc_html__( 'Complex-2-2', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c22post_title) ) {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html__( 'Complex-2-2', 'wise-blog' ) . '</h2></header>';
					}
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-2-2' ); ?>
        </div></div><?php endif;
        
        ?></div><?php

	} ); // End set_render_callback
