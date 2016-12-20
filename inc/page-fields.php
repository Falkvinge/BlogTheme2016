<?php

/* Verify if it is installed */
if ( ! function_exists( 'carbon_get_post_meta' ) ) {
    function carbon_get_post_meta( $id, $name, $type = null ) {
        return false;
    }   
}

if ( ! function_exists( 'carbon_get_the_post_meta' ) ) {
    function carbon_get_the_post_meta( $name, $type = null ) {
        return false;
    }   
}

if ( ! function_exists( 'carbon_get_theme_option' ) ) {
    function carbon_get_theme_option( $name, $type = null ) {
        return false;
    }   
}

if ( ! function_exists( 'carbon_get_term_meta' ) ) {
    function carbon_get_term_meta( $id, $name, $type = null ) {
        return false;
    }   
}

if ( ! function_exists( 'carbon_get_user_meta' ) ) {
    function carbon_get_user_meta( $id, $name, $type = null ) {
        return false;
    }   
}

if ( ! function_exists( 'carbon_get_comment_meta' ) ) {
    function carbon_get_comment_meta( $id, $name, $type = null ) {
        return false;
    }   
}

/* Custom Fields */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', esc_attr__( 'Homepage & Sidebar Selector', 'wise-blog') )
    ->show_on_post_type('page')
    ->add_fields(array(
		Field::make("select", "wise_page_title_align", esc_attr__( 'Title Alignment', 'wise-blog' ) )
			->add_options(array(
				'left' => esc_attr__( 'Left', 'wise-blog' ),
				'center' => esc_attr__( 'Center', 'wise-blog' ),
				'right' => esc_attr__( 'Right', 'wise-blog' ),
			))->set_default_value('left'),
		Field::make("radio", "wise_page_feat", esc_attr__( 'Featured Image', 'wise-blog' ) )
			->add_options(array(
				'disable' => esc_attr__( 'Disabled', 'wise-blog' ),
				'enable' => esc_attr__( 'Enabled', 'wise-blog' ),
			))->set_default_value('disable'),
		Field::make("radio", "wise_page_share", esc_attr__( 'Share Buttons', 'wise-blog' ) )
			->add_options(array(
				'disable' => esc_attr__( 'Disabled', 'wise-blog' ),
				'enable' => esc_attr__( 'Enabled', 'wise-blog' ),
			))->set_default_value('disable'),
		Field::make("radio", "wise_endis_homepage", esc_attr__( 'Custom Homepage', 'wise-blog' ) )
			->add_options(array(
				'disable' => esc_attr__( 'Disabled', 'wise-blog' ),
				'enable' => esc_attr__( 'Enabled', 'wise-blog' ),
			))->set_default_value('disable'),
		Field::make('sidebar', 'wise_custom_homepage', esc_attr__( 'Select Homepage', 'wise-blog' ) ),
        Field::make('sidebar', 'wise_custom_sidebar', esc_attr__( 'Select Sidebar', 'wise-blog' ) ),
    ));

function wise_dynamic_sidebar($index = 1, $options = array()) {
    global $wp_registered_sidebars;

    // Get the sidebar index the same way as the dynamic_sidebar() function
    if ( is_int($index) ) {
        $index = "sidebar-$index";
    } else {
        $index = sanitize_title($index);
        foreach ( (array) $wp_registered_sidebars as $key => $value ) {
            if ( sanitize_title($value['name']) == $index ) {
                $index = $key;
                break;
            }
        }
    }

    // Bail if this sidebar doesn't exist
    if ( empty( $wp_registered_sidebars[$index] ) ) {
        return false;
    }

    // Get the current sidebar options
    $sidebar = $wp_registered_sidebars[$index];

    // Update the sidebar options
    $wp_registered_sidebars[$index] = wp_parse_args($options, $sidebar);

    // Display the sidebar
    $status = dynamic_sidebar($index);

    // Restore the original sidebar options
    $wp_registered_sidebars[$index] = $sidebar;

    return $status;
}