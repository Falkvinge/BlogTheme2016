<?php
use Carbon_Fields\Block;
use Carbon_Fields\Field;

/* Wise Defaults Block */
global $wp_cats, $wise_defblock_name;
$wise_defblock_name = esc_attr__( 'Wise Defaults Block', 'wise-blog' );
Block::make( esc_attr( $wise_defblock_name ) )
	->add_fields( array(
		Field::make( 'separator', 'wise_defblock_title', esc_attr__( 'Wise Defaults Block', 'wise-blog' ) ),
		Field::make( 'text', 'wise_lpost_title', esc_attr__( 'Latest Posts Title', 'wise-blog' ) ),
		Field::make( 'checkbox', 'wise_lpost_title_dis', esc_attr__( 'Disable Latest Posts Title', 'wise-blog' ) )
			->set_option_value('yes'),
		Field::make( 'select', 'wise_title_type', esc_attr__( 'Title Design', 'wise-blog' ) )
			->add_options(array(
				'light' => esc_attr__( 'Light', 'wise-blog' ),
				'back' => esc_attr__( 'Background', 'wise-blog' ),
			))->set_default_value('back'),
		Field::make( 'select', 'wise_post_layout', esc_attr__( 'Post Layout', 'wise-blog' ) )
			->add_options(array(
				'defaults' => esc_attr__( 'Default Block', 'wise-blog' ),
				'grid' => esc_attr__( 'Grid Block', 'wise-blog' ),
			)),
		Field::make( 'select', 'wise_post_categ', esc_attr__( 'Post Categories', 'wise-blog' ) )
			->add_options($wp_cats),
		Field::make( 'text', 'wise_lpost_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )
			->set_default_value('6'),
		Field::make( 'radio', 'wise_lpost_pagination', esc_attr__( 'Pagination', 'wise-blog' ) )
			->add_options(array(
				'notpaginated' => esc_attr__( 'Not Paginated', 'wise-blog' ),
				'paginate' => esc_attr__( 'Paginated', 'wise-blog' ),
			))->set_default_value('paginate'),
	))
	->set_description( esc_attr__( 'Displays defaults block.', 'wise-blog' ) )
	->set_mode( 'both' )
	->set_category( 'wise_blocks', esc_attr__( 'Wise Blocks', 'wise-blog' ) )	
	->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {

		if( !is_page_template('page-empty.php') && is_page() ) : return; endif; // Return if page template is not page-empty.php
	
		global $wise_defblock_name, $wise_post_layout, $wise_lpost_number, $wise_lpost_pagination, $wise_post_categ;
        $wise_lpost_title = !empty( $fields['wise_lpost_title'] ) ? $fields['wise_lpost_title'] : '';
		$wise_lpost_title_dis = !empty( $fields['wise_lpost_title_dis'] ) ? $fields['wise_lpost_title_dis'] : '';
		$wise_title_type = !empty( $fields['wise_title_type'] ) ? $fields['wise_title_type'] : '';
		$wise_post_layout = !empty( $fields['wise_post_layout'] ) ? $fields['wise_post_layout'] : '';
		$wise_post_categ = !empty( $fields['wise_post_categ'] ) ? $fields['wise_post_categ'] : '';
		$wise_lpost_number = !empty( $fields['wise_lpost_number'] ) ? $fields['wise_lpost_number'] : '';
        $wise_lpost_pagination = !empty( $fields['wise_lpost_pagination'] ) ? $fields['wise_lpost_pagination'] : '';
        
        if($wise_post_layout == 'grid') {
            if($wise_title_type == 'light') {
                $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-defaults-grid-light-block.jpg';
            } else {
                $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-defaults-grid-back-block.jpg';
            }
        } else {
            if($wise_title_type == 'light') {
                $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-defaults-light-block.jpg';
            } else {
                $wise_blocks_imgprev = get_template_directory_uri() . '/img/wise-defaults-back-block.jpg';
            }
        }

        if( function_exists('wise_block_placeholder') ) : wise_block_placeholder($wise_defblock_name, $wise_blocks_imgprev); endif; // Block placeholder

        ?><div class="wise-block-placeholder"<?php if(!is_page()) : echo ' style="display:none;"'; endif; ?>><?php
		
		if( !empty($wise_post_categ) ) {
			$wise_post_categ_slug = get_term_by( 'slug', $wise_post_categ, 'category' );
			$cat_id = $wise_post_categ_slug->term_id;
			$cat_url = get_category_link( $cat_id );
		} else { $wise_post_categ_slug = null; }
		
        $get_the_excerpt = get_the_excerpt();

		if( $wise_lpost_title_dis != 'yes' ) : // If title is not disabled
			if( $wise_title_type == 'light' ) {
				if( $wise_post_categ == true ) {
					if( !empty($wise_lpost_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2></a>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html__( 'Latest Posts', 'wise-blog' ) . '</h2></a>';
					}
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header></div>';
				} else {
					if( !empty($wise_lpost_title) ) {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2>';
					} else {
						echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html__( 'Latest Posts', 'wise-blog' ) . '</h2>';
					}					
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header>';
				}
			} else {
				if( $wise_post_categ == true ) {
					if( !empty($wise_lpost_title) ) {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2></a>';
					} else {
						echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html__( 'Latest Posts', 'wise-blog' ) . '</h2></a>';
					}
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header></div>';
				} else {
					if( !empty($wise_lpost_title) ) {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2>';
					} else {
						echo '<header class="page-header"><h2 class="page-title">' . esc_html__( 'Latest Posts', 'wise-blog' ) . '</h2>';
					}
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header>';
				}
			}
		endif;
        get_template_part( 'templates/content', 'defaults' );

        ?></div><?php

	} ); // End set_render_callback
