<?php
/*
* Wise Panel
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. General Settings
    1.1 Preloader Type
    1.2 Preloader Image
    1.3 Predefined Preloader
    1.4 Predefined Preloader Color
    1.5 Background Image
    1.6 Disable Background Image
    1.7 Disable Sticky Sidebar
    1.8 Layout Column
2. Color Settings
    2.1 Predefined Colors
    2.2 Header Lines Color
    2.3 Buttons Color
    2.4 Tabs Color
    2.5 Text and Links Color
    2.6 Borders and Objects Color
3. Analytics Code Settings
    3.1 Before head close tag
    3.2 After body tag
    3.3 Before body close tag
4. Header Settings
    4.1 Header Type
    4.2 Header Logo
    4.3 Header Logo Retina
    4.4 Sticky Header Logo
    4.5 Sticky Header Logo Retina
    4.6 Custom Login Form Logo
    4.7 Custom Login Form Logo Retina
    4.8 Header Tag Lines Title
    4.9 Disable Header Tag Lines Title
    4.10 Header Tag Lines Span
    4.11 Disable Header Tag Lines Span
    4.12 Header Tag Lines Link
    4.13 Header Tag Lines Link Target
    4.14 Disable Top Header
    4.15 Disable Header Shopping Cart
    4.16 Disable Header Social Media
    4.17 Disable Sticky Header Social Media
    4.18 Disable Secondary Menu
    4.19 Disable Login/Register Links
    4.20 Disable Header Date
    4.21 Disable Sticky Header
    4.22 Header Opacity
    4.23 Sticky Header Opacity
5. Archive and Content Settings
    5.1 Archive Posts Layout Type
    5.2 Time Format for Posts and Comments
    5.3 Disable Breadcrumbs
    5.4 Disable Meta Date
    5.5 Disable Built-in Share Buttons
    5.6 Disable Author Info on Posts
    5.7 Disable Featured Image on Single Posts
    5.8 Affiliates Auto Disclaimer
    5.9 Affiliates Disclaimer Position
    5.10 Related Posts Number
6. AD for Posts Settings
    6.1 Top of the Content
    6.2 Middle of the Content
    6.3 After Posts Tags
    6.4 After Posts Navigation
    6.5 After Related Posts
7. Social Media Settings
    7.1 RSS Link
    7.2 Facebook Link
    7.3 Twitter Link
    7.4 Twitter Account Name for Share Buttons
    7.5 Instagram Link
    7.6 YouTube Link
    7.7 Vimeo Link
    7.8 LinkedIn Link
    7.9 Pinterest Link
    7.10 VK Link
8. Security Settings
    8.1 Disable Error Details for Login Form
9. WooCommerce Settings
    9.1 Product Archive Number
    9.2 Product Archive Layout Type
10. Footer Settings
    10.1 Footer Style
    10.2 Disable Social Media Icons for Single Footer
    10.3 Disable Footer Menu for Single Footer
    10.4 Footer Logo for Widgetized Footer
    10.5 Footer Logo Retina for Widgetized Footer
    10.6 Disable Footer Logo for Widgetized Footer
    10.7 Footer Text
    10.8 Disable Footer Text
    10.9 Disable Author Link
    10.10 Footer Opacity
--------------------------------------------------------------*/

class Wise_Panel {
    public static function register ( $wp_customize ) {

        $shortname = 'wise';
        $wise_null = null;

        /* List Categories */
        global $wp_cats;
        $categories = get_categories('hide_empty=0&orderby=name');
        $wp_cats = array();
        foreach ($categories as $category_list ) {
            $wp_cats[$category_list->slug] = $category_list->cat_name;
        }
        array_unshift($wp_cats, '');

        /* List Pages */
        global $wp_page;
        $page_entry = get_pages('hide_empty=0&orderby=name');
        $wp_page = array();
        foreach ($page_entry as $page_list ) {
            $wp_page[$page_list->ID] = $page_list->post_title;
        }
        array_unshift($wp_page, '');

        /* Font Weight List */
        $wise_fontweightval = array($wise_null,'100','200','300','400','500','600','700','800','900');
        $wise_fontweight = array_combine($wise_fontweightval, $wise_fontweightval);

        /* Transparency */
        $wise_opacity = wiseTransparency();

        /* Preloader */
        $wise_prelval = array($wise_null, 'blank-smooth', 'rotating-plane', 'double-bounce', 'wave', 'wandering-cubes', 'pulse', 'chasing-dots', 'three-bounce', 'circle', 'cube-grid', 'fading-circle', 'folding-cube' );
        $wise_prel = array_combine($wise_prelval, $wise_prelval);

        /* Predefined Color Scheme */
        $wise_precolor_schemeval = array('', 'newsred', 'orange', 'darkcyan', 'steelblue', 'olive', 'wallnut', 'sienna', 'hotpink', 'neonpurple');
        $wise_precolor_scheme = array_combine($wise_precolor_schemeval, $wise_precolor_schemeval);

        /* Sanitization Functions */
        // Image
        if( !function_exists('wise_sanitize_image') ) :
            function wise_sanitize_image( $file, $setting ) {
                $mimes = array(
                    'jpg|jpeg|jpe' => 'image/jpeg',
                    'gif'          => 'image/gif',
                    'png'          => 'image/png'
                );
                $file_ext = wp_check_filetype( $file, $mimes );
                
                return ( $file_ext['ext'] ? $file : $setting->default );
            }
        endif;

        // Checkbox
        if( !function_exists('wise_sanitize_checkbox') ) :
            function wise_sanitize_checkbox( $input ){
                return ( !empty( $input ) ? true : false );
            }
        endif;

        // Radio and Select
        if( !function_exists('wise_sanitize_choices') ) :
            function wise_sanitize_choices( $input, $setting ) {
                global $wp_customize;
                $control = $wp_customize->get_control( $setting->id );
            
                if ( array_key_exists( $input, $control->choices ) ) {
                    return $input;
                } else {
                    return $setting->default;
                }
            }
        endif;

        // Code
        if( !function_exists('wise_sanitize_code') ) :
            function wise_sanitize_code( $value ) {
                $allowed_html = array(
                    'script' => array(
                        'async'       => array(),
                        'defer'       => array(),
                        'charset'     => array(),
                        'crossorigin' => array(),
                        'src'         => array(),
                    ),
                    'noscript' => array(),
                    'img' => array(
                        'alt'    => array(),
                        'class'  => array(),
                        'height' => array(),
                        'src'    => array(),
                        'width'  => array(),
                    ),
                    'meta' => array(
                        'name'     => array(),
                        'property' => array(),
                        'charset'  => array(),
                        'content'  => array(),
                    ),
                    'div' => array(
                        'id'          => array(),
                        'class'       => array(),
                        'title'       => array(),
                        'style'       => array(),
                        'data-uri'    => array(),
                        'data-href'   => array(),
                        'data-action' => array(),
                    ),
                    'a' => array(
                        'href'   => array(),
                        'target' => array(),
                        'rel'    => array(),
                    ),
                    'ins' => array(
                        'class'                      => array(),
                        'style'                      => array(),
                        'data-ad-client'             => array(),
                        'data-ad-slot'               => array(),
                        'data-ad-format'             => array(),
                        'data-full-width-responsive' => array(),
                    ),
                );
                return wp_kses($value, $allowed_html);
            }
        endif;

        /*--------------------------------------------------------------
            WISE PANEL
        --------------------------------------------------------------*/
        $wp_customize->add_panel( 'wise_theme_options_panel',
            array(
                'title'           => esc_attr__( 'Wise Panel', 'wise-blog' ),
                'description'     => esc_attr__( 'Theme settings and configurations', 'wise-blog' ),
                'priority'        => 1,
                'capability'      => 'edit_theme_options',
                'theme_supports'  => '',
                'active_callback' => '',
            )
        );

        /*--------------------------------------------------------------
        1. General Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_general_settings',
            array(
                'title'       => esc_attr__( 'General Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('General settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        1.1 Preloader Type
        --------------------------------------------------------------*/
        // Preloader Type Settings
        $wp_customize->add_setting( $shortname.'_preload_option',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Preloader Type Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_preload_option',
            array(
                'label'       => esc_attr__( 'Preloader Type', 'wise-blog' ),
                'settings'    => $shortname.'_preload_option',
                'type'        => 'radio',
                'choices'     => array(
                                    ''        => esc_attr__( 'Predefined', 'wise-blog' ),
                                    'image'   => esc_attr__( 'Image', 'wise-blog' )
                                 ),
                'section'     => 'wise_general_settings',
                'description' => esc_attr__( 'Select preloader type.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.2 Preloader Image
        --------------------------------------------------------------*/ 
        // Preloader Image Settings
        $wp_customize->add_setting( $shortname.'_preload',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Preloader Image Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_preload',
            array(
                'label'           => esc_attr__( 'Preloader Image', 'wise-blog' ),
                'settings'        => $shortname.'_preload',
                'section'         => 'wise_general_settings',
                'description'     => esc_attr__( 'Upload or choose a preloader image (.gif, .png or .jpeg). Maximum of 372x152 pixels.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_preload_option') == 'image' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        1.3 Predefined Preloader
        --------------------------------------------------------------*/
        // Predefined Preloader Settings
        $wp_customize->add_setting( $shortname.'_pre_preload',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Predefined Preloader Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_pre_preload',
            array(
                'label'           => esc_attr__( 'Predefined Preloader', 'wise-blog' ),
                'settings'        => $shortname.'_pre_preload',
                'type'            => 'select',
                'choices'         => $wise_prel,
                'section'         => 'wise_general_settings',
                'description'     => esc_attr__( 'Choose predefined preloader.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_preload_option') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        1.4 Predefined Preloader Color
        --------------------------------------------------------------*/
        // Predefined Preloader Color Settings
        $wp_customize->add_setting( $shortname.'_def_preload_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Predefined Preloader Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_def_preload_color',
            array(
                'label'           => esc_attr__( 'Predefined Preloader Color', 'wise-blog' ),
                'settings'        => $shortname.'_def_preload_color',
                'type'            => 'color',
                'section'         => 'wise_general_settings',
                'description'     => esc_attr__( 'Choose predefined preloader color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_preload_option') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        1.5 Background Image
        --------------------------------------------------------------*/
        // Preloader Image Settings
        $wp_customize->add_setting( $shortname.'_mainback',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Preloader Image Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_mainback',
            array(
                'label'           => esc_attr__( 'Background Image', 'wise-blog' ),
                'settings'        => $shortname.'_mainback',
                'section'         => 'wise_general_settings',
                'description'     => esc_attr__( 'Upload or add background image (1460x876px). Leave blank to display default image.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_disable_back') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        1.6 Disable Background Image
        --------------------------------------------------------------*/
        // Disable Background Image Settings
        $wp_customize->add_setting( $shortname.'_disable_back',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Background Image Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_back',
            array(
                'label'       => esc_attr__( 'Disable Background Image', 'wise-blog' ),
                'settings'    => $shortname.'_disable_back',
                'type'        => 'checkbox',
                'section'     => 'wise_general_settings',
                'description' => esc_attr__( 'Check to disable background image.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.7 Disable Sticky Sidebar
        --------------------------------------------------------------*/
        // Disable Sticky Sidebar Settings
        $wp_customize->add_setting( $shortname.'_disable_sticky',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Sticky Sidebar Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_sticky',
            array(
                'label'       => esc_attr__( 'Disable Sticky Sidebar', 'wise-blog' ),
                'settings'    => $shortname.'_disable_sticky',
                'type'        => 'checkbox',
                'section'     => 'wise_general_settings',
                'description' => esc_attr__( 'Check to disable sticky sidebar.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.8 Layout Column
        --------------------------------------------------------------*/
        // Layout Column Settings
        $wp_customize->add_setting( $shortname.'_layout',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Layout Column Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_layout',
            array(
                'label'       => esc_attr__( 'Layout Column', 'wise-blog' ),
                'settings'    => $shortname.'_layout',
                'type'        => 'radio',
                'choices'     => array(
                                    ''      => esc_attr__( 'Three Column', 'wise-blog' ),
                                    'two'   => esc_attr__( 'Two Column', 'wise-blog' )
                                 ),
                'section'     => 'wise_general_settings',
                'description' => esc_attr__( 'Select three or two layout column style.', 'wise-blog' ),
            )
        ) );

        // End General Settings

        /*--------------------------------------------------------------
        2. Color Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_color_settings',
            array(
                'title'       => esc_attr__( 'Color Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('Color settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        2.1 Predefined Colors
        --------------------------------------------------------------*/
        // Predefined Colors Settings
        $wp_customize->add_setting( $shortname.'_pre_colors',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Predefined Colors Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_pre_colors',
            array(
                'label'       => esc_attr__( 'Predefined Colors', 'wise-blog' ),
                'settings'    => $shortname.'_pre_colors',
                'type'        => 'select',
                'choices'     => $wise_precolor_scheme,
                'section'     => 'wise_color_settings',
                'description' => esc_attr__( 'Select predefined color. Default is coolblue. Leave blank to activate custom colors.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        2.2 Header Lines Color
        --------------------------------------------------------------*/
        // Header Lines Color Settings
        $wp_customize->add_setting( $shortname.'_hline_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Header Lines Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_hline_color',
            array(
                'label'           => esc_attr__( 'Header Lines Color', 'wise-blog' ),
                'settings'        => $shortname.'_hline_color',
                'type'            => 'color',
                'section'         => 'wise_color_settings',
                'description'     => esc_attr__( 'Pick a color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_pre_colors') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );  

        /*--------------------------------------------------------------
        2.3 Buttons Color
        --------------------------------------------------------------*/
        // Buttons Color Settings
        $wp_customize->add_setting( $shortname.'_button_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Buttons Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_button_color',
            array(
                'label'           => esc_attr__( 'Buttons Color', 'wise-blog' ),
                'settings'        => $shortname.'_button_color',
                'type'            => 'color',
                'section'         => 'wise_color_settings',
                'description'     => esc_attr__( 'Pick a color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_pre_colors') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        2.4 Tabs Color
        --------------------------------------------------------------*/
        // Tabs Color Settings
        $wp_customize->add_setting( $shortname.'_tabs_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Tabs Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_tabs_color',
            array(
                'label'           => esc_attr__( 'Tabs Color', 'wise-blog' ),
                'settings'        => $shortname.'_tabs_color',
                'type'            => 'color',
                'section'         => 'wise_color_settings',
                'description'     => esc_attr__( 'Pick a color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_pre_colors') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        2.5 Text and Links Color
        --------------------------------------------------------------*/
        // Text and Links Color Settings
        $wp_customize->add_setting( $shortname.'_text_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Text and Links Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_text_color',
            array(
                'label'           => esc_attr__( 'Text and Links Color', 'wise-blog' ),
                'settings'        => $shortname.'_text_color',
                'type'            => 'color',
                'section'         => 'wise_color_settings',
                'description'     => esc_attr__( 'Pick a color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_pre_colors') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        2.6 Borders and Objects Color
        --------------------------------------------------------------*/
        // Borders and Objects Color Settings
        $wp_customize->add_setting( $shortname.'_line_color',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
 
        // Borders and Objects Color Control      
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            $shortname.'_line_color',
            array(
                'label'           => esc_attr__( 'Borders and Objects Color', 'wise-blog' ),
                'settings'        => $shortname.'_line_color',
                'type'            => 'color',
                'section'         => 'wise_color_settings',
                'description'     => esc_attr__( 'Pick a color.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_pre_colors') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        // End Color Scheme Settings

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            3. Analytics Code Settings
            --------------------------------------------------------------*/
            $wp_customize->add_section( 'wise_code_settings',
                array(
                    'title'       => esc_attr__( 'Analytics Code Settings', 'wise-blog' ),
                    'priority'    => 1,
                    'capability'  => 'edit_theme_options',
                    'description' => esc_attr__('Analytics code settings of the theme', 'wise-blog'),
                    'panel'       => 'wise_theme_options_panel',
                )
            );

            /*--------------------------------------------------------------
            3.1 Before head close tag
            --------------------------------------------------------------*/
            // Before head close tag Settings
            $wp_customize->add_setting( $shortname.'_code_before_head',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // Before head close tag Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_code_before_head',
                array(
                    'label'       => esc_attr__( 'Before head close tag', 'wise-blog' ),
                    'settings'    => $shortname.'_code_before_head',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_code_settings',
                    'description' => esc_attr__( 'Add custom html, style or script.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            3.2 After body tag
            --------------------------------------------------------------*/
            // After body tag Settings
            $wp_customize->add_setting( $shortname.'_code_after_body',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // After body tag Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_code_after_body',
                array(
                    'label'       => esc_attr__( 'After body tag', 'wise-blog' ),
                    'settings'    => $shortname.'_code_after_body',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_code_settings',
                    'description' => esc_attr__( 'Add custom html, style or script.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            3.3 Before body close tag
            --------------------------------------------------------------*/
            // Before body close tag Settings
            $wp_customize->add_setting( $shortname.'_code_before_body',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
            
            // Before body close tag Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_code_before_body',
                array(
                    'label'       => esc_attr__( 'Before body close tag', 'wise-blog' ),
                    'settings'    => $shortname.'_code_before_body',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_code_settings',
                    'description' => esc_attr__( 'Add custom html, style or script.', 'wise-blog' ),
                )
            ) );

            // End Code Settings
        endif; // End If wise_contents_plugin exists

        /*--------------------------------------------------------------
        4. Header Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_header_settings',
            array(
                'title'       => esc_attr__( 'Header Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('Header settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        4.1 Header Type
        --------------------------------------------------------------*/
        // Header Type Settings
        $wp_customize->add_setting( $shortname.'_header_type',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Header Type Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_header_type',
            array(
                'label'       => esc_attr__( 'Header Type', 'wise-blog' ),
                'settings'    => $shortname.'_header_type',
                'type'        => 'radio',
                'choices'     => array(
                                    ''        => esc_attr__( 'Default', 'wise-blog' ),
                                    'simple'  => esc_attr__( 'Simple', 'wise-blog' ),
                                 ),
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Select header type.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.2 Header Logo
        --------------------------------------------------------------*/ 
        // Header Logo Settings
        $wp_customize->add_setting( $shortname.'_header_logo',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Header Logo Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_header_logo',
            array(
                'label'       => esc_attr__( 'Header Logo', 'wise-blog' ),
                'settings'    => $shortname.'_header_logo',
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Add header logo here. Header Type: (Default 186x76px), (Simple 240x60px). Leave blank to display default image.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.3 Header Logo Retina
        --------------------------------------------------------------*/ 
        // Header Logo Retina Settings
        $wp_customize->add_setting( $shortname.'_header_logo_hq',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Header Logo Retina Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_header_logo_hq',
            array(
                'label'           => esc_attr__( 'Header Logo Retina', 'wise-blog' ),
                'settings'        => $shortname.'_header_logo_hq',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header logo here. Header Type: (Default 372x152px), (Simple 480x120px). Add @2x on its file name: mylogo@2x.png', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_header_logo') ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.4 Sticky Header Logo
        --------------------------------------------------------------*/ 
        // Sticky Header Logo Settings
        $wp_customize->add_setting( $shortname.'_headhesive_logo',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Sticky Header Logo Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_headhesive_logo',
            array(
                'label'       => esc_attr__( 'Sticky Header Logo', 'wise-blog' ),
                'settings'    => $shortname.'_headhesive_logo',
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Add header logo here. Header Type: (Default 100x41px), (Simple 152x38px). Leave blank to display default image.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.5 Sticky Header Logo Retina
        --------------------------------------------------------------*/ 
        // Sticky Header Logo Retina Settings
        $wp_customize->add_setting( $shortname.'_headhesive_logo_hq',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Sticky Header Logo Retina Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_headhesive_logo_hq',
            array(
                'label'           => esc_attr__( 'Sticky Header Logo Retina', 'wise-blog' ),
                'settings'        => $shortname.'_headhesive_logo_hq',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header logo here. Header Type: (Default 200x82px), (Simple 304x76px). Add @2x on its file name: mylogo@2x.png', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_headhesive_logo') ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.6 Custom Login Form Logo
        --------------------------------------------------------------*/ 
        // Custom Login Form Logo Settings
        $wp_customize->add_setting( $shortname.'_login_image_url',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Custom Login Form Logo Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_login_image_url',
            array(
                'label'       => esc_attr__( 'Custom Login Form Logo', 'wise-blog' ),
                'settings'    => $shortname.'_login_image_url',
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Add custom login form logo here. Header Type: (Default 186x76px), (Simple 240x60px). Leave blank to display default image.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.7 Custom Login Form Logo Retina
        --------------------------------------------------------------*/ 
        // Custom Login Form Logo Retina Settings
        $wp_customize->add_setting( $shortname.'_login_image_url_hq',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Custom Login Form Logo Retina Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_login_image_url_hq',
            array(
                'label'           => esc_attr__( 'Custom Login Form Logo Retina', 'wise-blog' ),
                'settings'        => $shortname.'_login_image_url_hq',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header logo here. Header Type: (Default 372x152px), (Simple 480x120px). Add @2x on its file name: mylogo@2x.png', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_login_image_url') ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.8 Header Tag Lines Title
        --------------------------------------------------------------*/
        // Header Tag Lines Title Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_title',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
 
        // Header Tag Lines Title Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_title',
            array(
                'label'           => esc_attr__( 'Header Tag Lines Title', 'wise-blog' ),
                'settings'        => $shortname.'_tag_lines_title',
                'type'            => 'text',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header tag lines title.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_tag_lines_title_dis') || get_theme_mod('wise_header_type') != '' ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.9 Disable Header Tag Lines Title
        --------------------------------------------------------------*/
        // Disable Header Tag Lines Title Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_title_dis',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Header Tag Lines Title Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_title_dis',
            array(
                'label'           => esc_attr__( 'Disable Header Tag Lines Title', 'wise-blog' ),
                'settings'        => $shortname.'_tag_lines_title_dis',
                'type'            => 'checkbox',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Check to disable header tag lines title.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_header_type') != '' ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.10 Header Tag Lines Span
        --------------------------------------------------------------*/
        // Header Tag Lines Span Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_span',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
 
        // Header Tag Lines Span Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_span',
            array(
                'label'           => esc_attr__( 'Header Tag Lines Span', 'wise-blog' ),
                'settings'        => $shortname.'_tag_lines_span',
                'type'            => 'text',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header tag lines span.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_tag_lines_span_dis') || get_theme_mod('wise_header_type') != '' || get_theme_mod('wise_tag_lines_title_dis') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.11 Disable Header Tag Lines Span
        --------------------------------------------------------------*/
        // Disable Header Tag Lines Span Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_span_dis',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Header Tag Lines Span Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_span_dis',
            array(
                'label'           => esc_attr__( 'Disable Header Tag Lines Span', 'wise-blog' ),
                'settings'        => $shortname.'_tag_lines_span_dis',
                'type'            => 'checkbox',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Check to disable tag lines span.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_header_type') != '' || get_theme_mod('wise_tag_lines_title_dis') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.12 Header Tag Lines Link
        --------------------------------------------------------------*/
        // Header Tag Lines Link Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_links',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'esc_url_raw',
            )
        );
 
        // Header Tag Lines Link Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_links',
            array(
                'label'           => esc_attr__( 'Header Tag Lines Link', 'wise-blog' ),
                'settings'        => $shortname.'_tag_lines_links',
                'type'            => 'url',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Add header tag lines links.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_tag_lines_title_dis') || get_theme_mod('wise_header_type') != '' ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.13 Header Tag Lines Link Target
        --------------------------------------------------------------*/
        // Header Tag Lines Link Target Settings
        $wp_customize->add_setting( $shortname.'_tag_lines_target',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Header Tag Lines Link Target      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_tag_lines_target',
            array(
                'label'             => esc_attr__( 'Header Tag Lines Link Target', 'wise-blog' ),
                'settings'          => $shortname.'_tag_lines_target',
                'type'              => 'radio',
                'choices'           => array(
                                        ''       => esc_attr__( 'Same Page', 'wise-blog' ),
                                        '_blank' => esc_attr__( 'New Tab', 'wise-blog' )
                                    ),
                'section'           => 'wise_header_settings',
                'description'       => esc_attr__( 'Choose on how the link opens.', 'wise-blog' ),
                'active_callback'   => function() {
                    $return_value = get_theme_mod('wise_tag_lines_title_dis') || get_theme_mod('wise_header_type') != '' ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.14 Disable Top Header
        --------------------------------------------------------------*/
        // Disable Top Header Settings
        $wp_customize->add_setting( $shortname.'_top_header',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Top Header Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_top_header',
            array(
                'label'       => esc_attr__( 'Disable Top Header', 'wise-blog' ),
                'settings'    => $shortname.'_top_header',
                'type'        => 'checkbox',
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Check to disable the entire top header.', 'wise-blog' ),
            )
        ) );

        if( class_exists('WooCommerce') ) : // If WooCommerce exists
            /*--------------------------------------------------------------
            4.15 Disable Header Shopping Cart
            --------------------------------------------------------------*/
            // Disable Header Shopping Cart Settings
            $wp_customize->add_setting( $shortname.'_head_shopcart_dis',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Header Shopping Cart Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_head_shopcart_dis',
                array(
                    'label'           => esc_attr__( 'Disable Header Shopping Cart', 'wise-blog' ),
                    'settings'        => $shortname.'_head_shopcart_dis',
                    'type'            => 'checkbox',
                    'section'         => 'wise_header_settings',
                    'description'     => esc_attr__( 'Check to disable shopping cart on header.', 'wise-blog' ),
                    'active_callback' => function() {
                        $return_value = get_theme_mod('wise_top_header') ? false : true;
                        return $return_value;
                    },
                )
            ) );
        endif; // End if WooCommerce exists

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            4.16 Disable Header Social Media
            --------------------------------------------------------------*/
            // Disable Header Social Media Settings
            $wp_customize->add_setting( $shortname.'_disable_headsocial',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Header Social Media Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_disable_headsocial',
                array(
                    'label'           => esc_attr__( 'Disable Header Social Media', 'wise-blog' ),
                    'settings'        => $shortname.'_disable_headsocial',
                    'type'            => 'checkbox',
                    'section'         => 'wise_header_settings',
                    'description'     => esc_attr__( 'Check to disable header social media.', 'wise-blog' ),
                    'active_callback' => function() {
                        $return_value = get_theme_mod('wise_top_header') ? false : true;
                        return $return_value;
                    },
                )
            ) );

            /*--------------------------------------------------------------
            4.17 Disable Sticky Header Social Media
            --------------------------------------------------------------*/
            // Disable Sticky Header Social Media Settings
            $wp_customize->add_setting( $shortname.'_disable_sticksocial',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Sticky Header Social Media Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_disable_sticksocial',
                array(
                    'label'           => esc_attr__( 'Disable Sticky Header Social Media', 'wise-blog' ),
                    'settings'        => $shortname.'_disable_sticksocial',
                    'type'            => 'checkbox',
                    'section'         => 'wise_header_settings',
                    'description'     => esc_attr__( 'Check to disable sticky header social media.', 'wise-blog' ),
                    'active_callback' => function() {
                        $return_value = get_theme_mod('wise_headhesive') ? false : true;
                        return $return_value;
                    },
                )
            ) );
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        4.18 Disable Secondary Menu
        --------------------------------------------------------------*/
        // Disable Secondary Menu Settings
        $wp_customize->add_setting( $shortname.'_secondary_menu',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Secondary Menu Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_secondary_menu',
            array(
                'label'           => esc_attr__( 'Disable Secondary Menu', 'wise-blog' ),
                'settings'        => $shortname.'_secondary_menu',
                'type'            => 'checkbox',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Check to remove the secondary header from top header.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_top_header') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.19 Disable Login/Register Links
        --------------------------------------------------------------*/
        // Disable Login/Register Links Settings
        $wp_customize->add_setting( $shortname.'_login',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Login/Register Links Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_login',
            array(
                'label'           => esc_attr__( 'Disable Login/Register Links', 'wise-blog' ),
                'settings'        => $shortname.'_login',
                'type'            => 'checkbox',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Check to remove the login or register links from top header.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_top_header') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.20 Disable Header Date
        --------------------------------------------------------------*/
        // Disable Header Date Settings
        $wp_customize->add_setting( $shortname.'_date_header',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Header Date Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_date_header',
            array(
                'label'           => esc_attr__( 'Disable Header Date', 'wise-blog' ),
                'settings'        => $shortname.'_date_header',
                'type'            => 'checkbox',
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Check to remove header date from top header.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_top_header') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        4.21 Disable Sticky Header
        --------------------------------------------------------------*/
        // Disable Sticky Header Settings
        $wp_customize->add_setting( $shortname.'_headhesive',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Sticky Header Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_headhesive',
            array(
                'label'       => esc_attr__( 'Disable Sticky Header', 'wise-blog' ),
                'settings'    => $shortname.'_headhesive',
                'type'        => 'checkbox',
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Check to remove sticky header.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.22 Header Opacity
        --------------------------------------------------------------*/
        // Header Opacity Settings
        $wp_customize->add_setting( $shortname.'_head_opacity',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Header Opacity Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_head_opacity',
            array(
                'label'       => esc_attr__( 'Header Opacity', 'wise-blog' ),
                'settings'    => $shortname.'_head_opacity',
                'type'        => 'select',
                'choices'     => $wise_opacity,
                'section'     => 'wise_header_settings',
                'description' => esc_attr__( 'Adjust opacity (Leave blank for defaults).', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.23 Sticky Header Opacity
        --------------------------------------------------------------*/
        // Sticky Header Opacity Settings
        $wp_customize->add_setting( $shortname.'_headhesive_opacity',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Sticky Header Opacity Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_headhesive_opacity',
            array(
                'label'           => esc_attr__( 'Sticky Header Opacity', 'wise-blog' ),
                'settings'        => $shortname.'_headhesive_opacity',
                'type'            => 'select',
                'choices'         => $wise_opacity,
                'section'         => 'wise_header_settings',
                'description'     => esc_attr__( 'Adjust opacity (Leave blank for defaults).', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_headhesive') ? false : true;
                    return $return_value;
                },
            )
        ) );

        // End Header Settings

        /*--------------------------------------------------------------
        5. Archive and Content Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_arcont_settings',
            array(
                'title'       => esc_attr__( 'Archive and Content Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('Archive and content settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        5.1 Archive Posts Layout Type
        --------------------------------------------------------------*/
        // Archive Posts Layout Type Settings
        $wp_customize->add_setting( $shortname.'_posts_layout',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Archive Posts Layout Type Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_posts_layout',
            array(
                'label'       => esc_attr__( 'Archive Posts Layout Type', 'wise-blog' ),
                'settings'    => $shortname.'_posts_layout',
                'type'        => 'radio',
                'choices'     => array(
                                    ''      => esc_attr__( 'Single', 'wise-blog' ),
                                    'grid'  => esc_attr__( 'Grid', 'wise-blog' )
                                 ),
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Select grid or single type for posts layout.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        5.2 Time Format for Posts and Comments
        --------------------------------------------------------------*/
        // Time Format for Posts and Comments Settings
        $wp_customize->add_setting( $shortname.'_date_format',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Time Format for Posts and Comments Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_date_format',
            array(
                'label'       => esc_attr__( 'Time Format for Posts and Comments', 'wise-blog' ),
                'settings'    => $shortname.'_date_format',
                'type'        => 'radio',
                'choices'     => array(
                                    ''                => esc_attr__( 'Default', 'wise-blog' ),
                                    'human readable'  => esc_attr__( 'Human Readable', 'wise-blog' )
                                 ),
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Select default or human readable time format.', 'wise-blog' ),
            )
        ) );

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            5.3 Disable Breadcrumbs
            --------------------------------------------------------------*/
            // Disable Breadcrumbs Settings
            $wp_customize->add_setting( $shortname.'_dis_breadcrumbs',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Breadcrumbs Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_dis_breadcrumbs',
                array(
                    'label'       => esc_attr__( 'Disable Breadcrumbs', 'wise-blog' ),
                    'settings'    => $shortname.'_dis_breadcrumbs',
                    'type'        => 'checkbox',
                    'section'     => 'wise_arcont_settings',
                    'description' => esc_attr__( 'Check to disable breadcrumbs on all posts and pages.', 'wise-blog' ),
                )
            ) );
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        5.4 Disable Meta Date
        --------------------------------------------------------------*/
        // Disable Meta Date Settings
        $wp_customize->add_setting( $shortname.'_disable_post_date',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Meta Date Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_post_date',
            array(
                'label'       => esc_attr__( 'Disable Meta Date', 'wise-blog' ),
                'settings'    => $shortname.'_disable_post_date',
                'type'        => 'checkbox',
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Check to disable meta date tags.', 'wise-blog' ),
            )
        ) );

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            5.5 Disable Built-in Share Buttons
            --------------------------------------------------------------*/
            // Disable Built-in Share Buttons Settings
            $wp_customize->add_setting( $shortname.'_disable_share_buttons',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Built-in Share Buttons Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_disable_share_buttons',
                array(
                    'label'       => esc_attr__( 'Disable Built-in Share Buttons', 'wise-blog' ),
                    'settings'    => $shortname.'_disable_share_buttons',
                    'type'        => 'checkbox',
                    'section'     => 'wise_arcont_settings',
                    'description' => esc_attr__( 'Check to disable built-in share buttons for posts and pages.', 'wise-blog' ),
                )
            ) );
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        5.6 Disable Author Info on Posts
        --------------------------------------------------------------*/
        // Disable Author Info on Posts Settings
        $wp_customize->add_setting( $shortname.'_disable_author_posts',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Author Info on Posts Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_author_posts',
            array(
                'label'       => esc_attr__( 'Disable Author Info on Posts', 'wise-blog' ),
                'settings'    => $shortname.'_disable_author_posts',
                'type'        => 'checkbox',
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Check to disable Author Biography for single posts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        5.7 Disable Featured Image on Single Posts
        --------------------------------------------------------------*/
        // Disable Featured Image on Single Posts Settings
        $wp_customize->add_setting( $shortname.'_disfeat_singpost',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Featured Image on Single Posts Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disfeat_singpost',
            array(
                'label'       => esc_attr__( 'Disable Featured Image on Single Posts', 'wise-blog' ),
                'settings'    => $shortname.'_disfeat_singpost',
                'type'        => 'checkbox',
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Check to disable featured image for all single posts.', 'wise-blog' ),
            )
        ) );

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            5.8 Affiliates Auto Disclaimer
            --------------------------------------------------------------*/
            // Affiliates Auto Disclaimer Settings
            $wp_customize->add_setting( $shortname.'_aff_disclaimer',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'sanitize_textarea_field',
                )
            );
    
            // Affiliates Auto Disclaimer Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_aff_disclaimer',
                array(
                    'label'       => esc_attr__( 'Affiliates Auto Disclaimer', 'wise-blog' ),
                    'settings'    => $shortname.'_aff_disclaimer',
                    'type'        => 'textarea',
                    'section'     => 'wise_arcont_settings',
                    'description' => esc_attr__( 'Add affiliate disclaimer here.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            5.9 Affiliates Disclaimer Position
            --------------------------------------------------------------*/
            // Affiliates Disclaimer Position Settings
            $wp_customize->add_setting( $shortname.'_aff_top_bottom',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_choices',
                )
            );
    
            // Affiliates Disclaimer Position Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_aff_top_bottom',
                array(
                    'label'       => esc_attr__( 'Affiliates Disclaimer Position', 'wise-blog' ),
                    'settings'    => $shortname.'_aff_top_bottom',
                    'type'        => 'radio',
                    'choices'     => array(
                                        ''        => esc_attr__( 'Top', 'wise-blog' ),
                                        'bottom'  => esc_attr__( 'Bottom', 'wise-blog' )
                                    ),
                    'section'     => 'wise_arcont_settings',
                    'description' => esc_attr__( 'Select affiliates disclaimer position on posts. Position is top or bottom of the content.', 'wise-blog' ),
                )
            ) );
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        5.10 Related Posts Number
        --------------------------------------------------------------*/
        // Related Posts Number Settings
        $wp_customize->add_setting( $shortname.'_relnum',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
 
        // Related Posts Number Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_relnum',
            array(
                'label'       => esc_attr__( 'Related Posts Number', 'wise-blog' ),
                'settings'    => $shortname.'_relnum',
                'type'        => 'number',
                'section'     => 'wise_arcont_settings',
                'description' => esc_attr__( 'Set the number of related posts to show on single post. Default is 6. Type 0 to disable related posts.', 'wise-blog' ),
            )
        ) );

        // End Archive and Content Settings

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            6. AD for Posts Settings
            --------------------------------------------------------------*/
            $wp_customize->add_section( 'wise_ads_settings',
                array(
                    'title'       => esc_attr__( 'AD for Posts Settings', 'wise-blog' ),
                    'priority'    => 1,
                    'capability'  => 'edit_theme_options',
                    'description' => esc_attr__('AD for posts settings of the theme', 'wise-blog'),
                    'panel'       => 'wise_theme_options_panel',
                )
            );

            /*--------------------------------------------------------------
            6.1 Top of the Content
            --------------------------------------------------------------*/
            // Top of the Content Settings
            $wp_customize->add_setting( $shortname.'_top_post',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // Top of the Content Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_top_post',
                array(
                    'label'       => esc_attr__( 'Top of the Content', 'wise-blog' ),
                    'settings'    => $shortname.'_top_post',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_ads_settings',
                    'description' => esc_attr__( 'Paste AD code here.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            6.2 Middle of the Content
            --------------------------------------------------------------*/
            // Middle of the Content Settings
            $wp_customize->add_setting( $shortname.'_middle_post',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // Middle of the Content Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_middle_post',
                array(
                    'label'       => esc_attr__( 'Middle of the Content', 'wise-blog' ),
                    'settings'    => $shortname.'_middle_post',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_ads_settings',
                    'description' => esc_attr__( 'Paste AD code here.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            6.3 After Posts Tags
            --------------------------------------------------------------*/
            // After Posts Tags Settings
            $wp_customize->add_setting( $shortname.'_bottom_post_1',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // After Posts Tags Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_bottom_post_1',
                array(
                    'label'       => esc_attr__( 'After Posts Tags', 'wise-blog' ),
                    'settings'    => $shortname.'_bottom_post_1',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_ads_settings',
                    'description' => esc_attr__( 'Paste AD code here.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            6.4 After Posts Navigation
            --------------------------------------------------------------*/
            // After Posts Navigation Settings
            $wp_customize->add_setting( $shortname.'_bottom_post_2',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // After Posts Navigation Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_bottom_post_2',
                array(
                    'label'       => esc_attr__( 'After Posts Navigation', 'wise-blog' ),
                    'settings'    => $shortname.'_bottom_post_2',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_ads_settings',
                    'description' => esc_attr__( 'Paste AD code here.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            6.5 After Related Posts
            --------------------------------------------------------------*/
            // After Related Posts Settings
            $wp_customize->add_setting( $shortname.'_bottom_post_3',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_code',
                )
            );
    
            // After Related Posts Control      
            $wp_customize->add_control( new WP_Customize_Code_Editor_Control(
                $wp_customize,
                $shortname.'_bottom_post_3',
                array(
                    'label'       => esc_attr__( 'After Related Posts', 'wise-blog' ),
                    'settings'    => $shortname.'_bottom_post_3',
                    'code_type'   => 'text/html',
                    'section'     => 'wise_ads_settings',
                    'description' => esc_attr__( 'Paste AD code here.', 'wise-blog' ),
                )
            ) );

            // End AD for Posts Settings
        endif; // End if function exists

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            7. Social Media Settings
            --------------------------------------------------------------*/
            $wp_customize->add_section( 'wise_socmedia_settings',
                array(
                    'title'       => esc_attr__( 'Social Media Settings', 'wise-blog' ),
                    'priority'    => 1,
                    'capability'  => 'edit_theme_options',
                    'description' => esc_attr__('Social media settings of the theme', 'wise-blog'),
                    'panel'       => 'wise_theme_options_panel',
                )
            );

            /*--------------------------------------------------------------
            7.1 RSS Link
            --------------------------------------------------------------*/
            // RSS Link Settings
            $wp_customize->add_setting( $shortname.'_soc_rss_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // RSS Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_rss_links',
                array(
                    'label'       => esc_attr__( 'RSS Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_rss_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add RSS URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.2 Facebook Link
            --------------------------------------------------------------*/
            // Facebook Link Settings
            $wp_customize->add_setting( $shortname.'_soc_fb_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // Facebook Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_fb_links',
                array(
                    'label'       => esc_attr__( 'Facebook Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_fb_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Facebook URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.3 Twitter Link
            --------------------------------------------------------------*/
            // Twitter Link Settings
            $wp_customize->add_setting( $shortname.'_soc_twitter_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // Twitter Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_twitter_links',
                array(
                    'label'       => esc_attr__( 'Twitter Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_twitter_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Twitter URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.4 Twitter Account Name for Share Buttons
            --------------------------------------------------------------*/
            // Twitter Account Name for Share Buttons Settings
            $wp_customize->add_setting( $shortname.'_twitter_acc',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'sanitize_text_field',
                )
            );
    
            // Twitter Account Name for Share Buttons Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_twitter_acc',
                array(
                    'label'       => esc_attr__( 'Twitter Account Name for Share Buttons', 'wise-blog' ),
                    'settings'    => $shortname.'_twitter_acc',
                    'type'        => 'text',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Twitter Account Name. Ex. probewise', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.5 Instagram Link
            --------------------------------------------------------------*/
            // Instagram Link Settings
            $wp_customize->add_setting( $shortname.'_soc_ins_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // Instagram Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_ins_links',
                array(
                    'label'       => esc_attr__( 'Instagram Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_ins_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Instagram URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.6 YouTube Link
            --------------------------------------------------------------*/
            // YouTube Link Settings
            $wp_customize->add_setting( $shortname.'_soc_yt_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // YouTube Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_yt_links',
                array(
                    'label'       => esc_attr__( 'YouTube Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_yt_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add YouTube URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.7 Vimeo Link
            --------------------------------------------------------------*/
            // Vimeo Link Settings
            $wp_customize->add_setting( $shortname.'_soc_vim_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // Vimeo Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_vim_links',
                array(
                    'label'       => esc_attr__( 'Vimeo Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_vim_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Vimeo URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.8 LinkedIn Link
            --------------------------------------------------------------*/
            // LinkedIn Link Settings
            $wp_customize->add_setting( $shortname.'_soc_in_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // LinkedIn Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_in_links',
                array(
                    'label'       => esc_attr__( 'LinkedIn Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_in_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add LinkedIn URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.9 Pinterest Link
            --------------------------------------------------------------*/
            // Pinterest Link Settings
            $wp_customize->add_setting( $shortname.'_soc_pin_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // Pinterest Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_pin_links',
                array(
                    'label'       => esc_attr__( 'Pinterest Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_pin_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add Pinterest URL.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            7.10 VK Link
            --------------------------------------------------------------*/
            // VK Link Settings
            $wp_customize->add_setting( $shortname.'_soc_vk_links',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'esc_url_raw',
                )
            );
    
            // VK Link Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_soc_vk_links',
                array(
                    'label'       => esc_attr__( 'VK Link', 'wise-blog' ),
                    'settings'    => $shortname.'_soc_vk_links',
                    'type'        => 'url',
                    'section'     => 'wise_socmedia_settings',
                    'description' => esc_attr__( 'Add VK URL.', 'wise-blog' ),
                )
            ) );

            // End Social Media Settings
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        8. Security Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_security_settings',
            array(
                'title'       => esc_attr__( 'Security Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('Security settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        8.1 Disable Error Details for Login Form
        --------------------------------------------------------------*/
        // Disable Error Details for Login Form Settings
        $wp_customize->add_setting( $shortname.'_disable_error_details',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Error Details for Login Form Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_error_details',
            array(
                'label'       => esc_attr__( 'Disable Error Details for Login Form', 'wise-blog' ),
                'settings'    => $shortname.'_disable_error_details',
                'type'        => 'checkbox',
                'section'     => 'wise_security_settings',
                'description' => esc_attr__( 'Check to disable error details in login form.', 'wise-blog' ),
            )
        ) );
        // End Security Settings

        if( class_exists('WooCommerce') ) : // If WooCommerce exists
            /*--------------------------------------------------------------
            9. WooCommerce Settings
            --------------------------------------------------------------*/
            $wp_customize->add_section( 'wise_woocommerce_settings',
                array(
                    'title'       => esc_attr__( 'WooCommerce Settings', 'wise-blog' ),
                    'priority'    => 1,
                    'capability'  => 'edit_theme_options',
                    'description' => esc_attr__('WooCommerce settings of the theme', 'wise-blog'),
                    'panel'       => 'wise_theme_options_panel',
                )
            );

            /*--------------------------------------------------------------
            9.1 Product Archive Number
            --------------------------------------------------------------*/
            // Product Archive Number Settings
            $wp_customize->add_setting( $shortname.'_woo_archive_num',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'absint',
                )
            );
    
            // Product Archive Number Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_woo_archive_num',
                array(
                    'label'       => esc_attr__( 'Product Archive Number', 'wise-blog' ),
                    'settings'    => $shortname.'_woo_archive_num',
                    'type'        => 'number',
                    'section'     => 'wise_woocommerce_settings',
                    'description' => esc_attr__( 'Set the number of products to display on product archive. Leave blank or type 0 for defaults.', 'wise-blog' ),
                )
            ) );

            /*--------------------------------------------------------------
            9.2 Product Archive Layout Type
            --------------------------------------------------------------*/
            // Product Archive Layout Type Settings
            $wp_customize->add_setting( $shortname.'_prod_layout',
                array(
                    'default'           => '',
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_choices',
                )
            );
    
            // Product Archive Layout Type Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_prod_layout',
                array(
                    'label'       => esc_attr__( 'Product Archive Layout Type', 'wise-blog' ),
                    'settings'    => $shortname.'_prod_layout',
                    'type'        => 'radio',
                    'choices'     => array(
                                        ''      => esc_attr__( 'Single', 'wise-blog' ),
                                        'grid'  => esc_attr__( 'Grid', 'wise-blog' )
                                    ),
                    'section'     => 'wise_woocommerce_settings',
                    'description' => esc_attr__( 'Select product layout type.', 'wise-blog' ),
                )
            ) );

            // End WooCommerce Settings
        endif; // End if WooCommerce exists

        /*--------------------------------------------------------------
        10. Footer Settings
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_footer_settings',
            array(
                'title'       => esc_attr__( 'Footer Settings', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__('Footer settings of the theme', 'wise-blog'),
                'panel'       => 'wise_theme_options_panel',
            )
        );

        /*--------------------------------------------------------------
        10.1 Footer Style
        --------------------------------------------------------------*/
        // Footer Style Settings
        $wp_customize->add_setting( $shortname.'_footer_style',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Footer Style Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_style',
            array(
                'label'       => esc_attr__( 'Footer Style', 'wise-blog' ),
                'settings'    => $shortname.'_footer_style',
                'type'        => 'radio',
                'choices'     => array(
                                    ''           => esc_attr__( 'Widgetized', 'wise-blog' ),
                                    'single'     => esc_attr__( 'Single', 'wise-blog' )
                                 ),
                'section'     => 'wise_footer_settings',
                'description' => esc_attr__( 'Select footer style.', 'wise-blog' ),
            )
        ) );

        if( function_exists('wise_contents_plugin') ) : // If wise_contents_plugin exists
            /*--------------------------------------------------------------
            10.2 Disable Social Media Icons for Single Footer
            --------------------------------------------------------------*/
            // Disable Social Media Icons for Single Footer Settings
            $wp_customize->add_setting( $shortname.'_disable_footericons',
                array(
                    'default'           => 0,
                    'type'              => 'theme_mod',
                    'capability'        => 'edit_theme_options',
                    'transport'         => 'refresh',
                    'sanitize_callback' => 'wise_sanitize_checkbox',
                )
            );
    
            // Disable Social Media Icons for Single Footer Control      
            $wp_customize->add_control( new WP_Customize_Control(
                $wp_customize,
                $shortname.'_disable_footericons',
                array(
                    'label'           => esc_attr__( 'Disable Social Media Icons for Single Footer', 'wise-blog' ),
                    'settings'        => $shortname.'_disable_footericons',
                    'type'            => 'checkbox',
                    'section'         => 'wise_footer_settings',
                    'description'     => esc_attr__( 'Check to disable social media icons for single footer.', 'wise-blog' ),
                    'active_callback' => function() {
                        $return_value = get_theme_mod('wise_footer_style') == 'single' ? true : false;
                        return $return_value;
                    },
                )
            ) );
        endif; // End if wise_contents_plugin exists

        /*--------------------------------------------------------------
        10.3 Disable Footer Menu for Single Footer
        --------------------------------------------------------------*/
        // Disable Footer Menu for Single Footer Settings
        $wp_customize->add_setting( $shortname.'_disable_footermenu',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Footer Menu for Single Footer Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_disable_footermenu',
            array(
                'label'           => esc_attr__( 'Disable Footer Menu for Single Footer', 'wise-blog' ),
                'settings'        => $shortname.'_disable_footermenu',
                'type'            => 'checkbox',
                'section'         => 'wise_footer_settings',
                'description'     => esc_attr__( 'Check to disable footer menu for single footer.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_footer_style') == 'single' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        10.4 Footer Logo for Widgetized Footer
        --------------------------------------------------------------*/ 
        // Footer Logo for Widgetized Footer Settings
        $wp_customize->add_setting( $shortname.'_footer_logo_url',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Footer Logo for Widgetized Footer Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_footer_logo_url',
            array(
                'label'           => esc_attr__( 'Footer Logo for Widgetized Footer', 'wise-blog' ),
                'settings'        => $shortname.'_footer_logo_url',
                'section'         => 'wise_footer_settings',
                'description'     => esc_attr__( 'Add footer logo here. Header Type: (Default 49x20px), (Simple 80x20px). Leave blank to display default image.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_footer_style') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        10.5 Footer Logo Retina for Widgetized Footer
        --------------------------------------------------------------*/ 
        // Footer Logo Retina for Widgetized Footer Settings
        $wp_customize->add_setting( $shortname.'_footer_logo_url_hq',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_image',
            )
        );
 
        // Footer Logo Retina for Widgetized Footer Control
        $wp_customize->add_control( new WP_Customize_Image_Control(
            $wp_customize,
            $shortname.'_footer_logo_url_hq',
            array(
                'label'           => esc_attr__( 'Footer Logo Retina for Widgetized Footer', 'wise-blog' ),
                'settings'        => $shortname.'_footer_logo_url_hq',
                'section'         => 'wise_footer_settings',
                'description'     => esc_attr__( 'Add footer logo here. Header Type: (Default 98x40px), (Simple 160x40px). Ex: mylogo@2x.png', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_footer_style') == '' && get_theme_mod('wise_footer_logo_url') ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        10.6 Disable Footer Logo for Widgetized Footer
        --------------------------------------------------------------*/
        // Disable Footer Logo for Widgetized Footer
        $wp_customize->add_setting( $shortname.'_footer_logo',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Footer Logo for Widgetized Footer Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_logo',
            array(
                'label'           => esc_attr__( 'Disable Footer Logo for Widgetized Footer', 'wise-blog' ),
                'settings'        => $shortname.'_footer_logo',
                'type'            => 'checkbox',
                'section'         => 'wise_footer_settings',
                'description'     => esc_attr__( 'Check to disable footer logo for widgetized footer.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_footer_style') == '' ? true : false;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        10.7 Footer Text
        --------------------------------------------------------------*/
        // Footer Text Settings
        $wp_customize->add_setting( $shortname.'_footer_text',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_code',
            )
        );
 
        // Footer Text Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_text',
            array(
                'label'           => esc_attr__( 'Footer Text', 'wise-blog' ),
                'settings'        => $shortname.'_footer_text',
                'type'            => 'textarea',
                'section'         => 'wise_footer_settings',
                'description'     => esc_attr__( 'Add footer text.', 'wise-blog' ),
                'active_callback' => function() {
                    $return_value = get_theme_mod('wise_footer_text_dis') ? false : true;
                    return $return_value;
                },
            )
        ) );

        /*--------------------------------------------------------------
        10.8 Disable Footer Text
        --------------------------------------------------------------*/
        // Disable Footer Text Settings
        $wp_customize->add_setting( $shortname.'_footer_text_dis',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Footer Text Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_text_dis',
            array(
                'label'       => esc_attr__( 'Disable Footer Text', 'wise-blog' ),
                'settings'    => $shortname.'_footer_text_dis',
                'type'        => 'checkbox',
                'section'     => 'wise_footer_settings',
                'description' => esc_attr__( 'Check to disable footer text.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        10.9 Disable Author Link
        --------------------------------------------------------------*/
        // Disable Author Link Settings
        $wp_customize->add_setting( $shortname.'_footer_authlink_dis',
            array(
                'default'           => 0,
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_checkbox',
            )
        );
 
        // Disable Author Link Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_authlink_dis',
            array(
                'label'       => esc_attr__( 'Disable Author Link', 'wise-blog' ),
                'settings'    => $shortname.'_footer_authlink_dis',
                'type'        => 'checkbox',
                'section'     => 'wise_footer_settings',
                'description' => esc_attr__( 'Check to disable author link.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        10.10 Footer Opacity
        --------------------------------------------------------------*/
        // Footer Opacity Settings
        $wp_customize->add_setting( $shortname.'_footer_opacity',
            array(
                'default'           => '',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Footer Opacity Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_footer_opacity',
            array(
                'label'       => esc_attr__( 'Footer Opacity', 'wise-blog' ),
                'settings'    => $shortname.'_footer_opacity',
                'type'        => 'select',
                'choices'     => $wise_opacity,
                'section'     => 'wise_footer_settings',
                'description' => esc_attr__( 'Adjust opacity (Leave blank for defaults).', 'wise-blog' ),
            )
        ) );

        // End Footer Settings
    }
}

add_action( 'customize_register' , array( 'Wise_Panel' , 'register' ) );

/*--------------------------------------------------------------
Includes
--------------------------------------------------------------*/
// Customizer Styles
include get_template_directory() . '/inc/wise-panel/styles.php';

// Gutenberg Styles
if( is_admin() ) :
    include get_template_directory() . '/inc/wise-panel/styles-gutenberg.php';
endif;

// Import/Export
include get_template_directory() . '/inc/wise-panel/import-export.php';