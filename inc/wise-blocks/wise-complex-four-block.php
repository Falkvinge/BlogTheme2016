<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Complex 4 Block */
global $wp_cats, $wise_comp4block_name;
$wise_comp4block_name = esc_attr__( 'Wise Complex 4 Block', 'wise-blog' );
Block::make( esc_attr( $wise_comp4block_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_comp4_title', esc_attr__( 'Wise Complex 4 Block', 'wise-blog' ) ),
		Field::make( 'text', 'wise_c4post_title', esc_attr__( 'Posts Title', 'wise-blog' ) ),
		Field::make( 'checkbox', 'wise_c4post_title_dis', esc_attr__( 'Disable Posts Title', 'wise-blog' ) ),
		Field::make( 'select', 'wise_c4title_type', esc_attr__( 'Title Design', 'wise-blog' ) )
			->add_options(array(
				'back' => esc_attr__( 'Background', 'wise-blog' ),
				'light' => esc_attr__( 'Light', 'wise-blog' ),
			))->set_default_value('back'),
		Field::make( 'select', 'wise_c4post_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'text', 'wise_c4post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )
			->set_default_value('6'),
	))
	->set_description( esc_attr__( 'Displays complex 4 posts block.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php
	
		global $wise_comp4block_name, $wise_c4post_number, $wise_c4post_categ;
        $wise_c4post_title = !empty( $fields['wise_c4post_title'] ) ? ( $fields['wise_c4post_title'] ) : '';
		$wise_c4post_title_dis = !empty( $fields['wise_c4post_title_dis'] ) ? ( $fields['wise_c4post_title_dis'] ) : '';
		$wise_c4title_type = !empty( $fields['wise_c4title_type'] ) ? ( $fields['wise_c4title_type'] ) : '';
		$wise_c4post_categ = !empty( $fields['wise_c4post_categ'] ) ? ( $fields['wise_c4post_categ'] ) : '';
        $wise_c4post_number = !empty( $fields['wise_c4post_number'] ) ? ( $fields['wise_c4post_number'] ) : '';
        
        $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-complex-four-block.jpg';

        if($wise_c4title_type == 'light') {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-complex-four-light-block.jpg';
        } else {
            $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-complex-four-back-block.jpg';
        }

        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_comp4block_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php
		
		if( !empty($wise_c4post_categ) ) {
			$wise_c4post_categ_slug = get_term_by( 'slug', $wise_c4post_categ, 'category' );
			$cat_id = $wise_c4post_categ_slug->term_id;
			$cat_url = get_category_link( $cat_id );
		} else { $wise_c4post_categ_slug = null; }
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( $wise_c4post_title_dis != 'yes' ) : // if title is not disabled
			if( $wise_c4title_type == 'light' ) {
				if( $wise_c4post_categ == true ) {
					if( !empty($wise_c4post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html__( 'Complex-4', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c4post_title) ) {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html__( 'Complex-4', 'wise-blog' ) . '</h2></header>';
					}
				}
			} else {
				if( $wise_c4post_categ == true ) {
					if( !empty($wise_c4post_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html__( 'Complex-4', 'wise-blog' ) . '</h2></a></header></div>';
					}
				} else {
					if( !empty($wise_c4post_title) ) {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></header>';
					} else {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html__( 'Complex-4', 'wise-blog' ) . '</h2></header>';
					}
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-4' ); ?>
        </div><?php endif;
        
        ?></div><?php

	} ); // End set_render_callback