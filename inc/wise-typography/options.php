<?php
/*
* Wise Typography Options
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Heading Fonts
2. Body Fonts
3. Input and Meta Fonts
4. Button Fonts
5. Navigation Fonts
6. Description Fonts
--------------------------------------------------------------*/

class Wise_Panel_Typography {
    public static function register( $wp_customize ) {

        $shortname = 'wise';
        $wise_null = null;

        /* Font Weight List */
        $wise_fontweight = array(
            ''    => '',
            '100' => esc_attr( 'Ultra-Light', 'wise-blog'),
			'200' => esc_attr( 'Light', 'wise-blog'),
			'300' => esc_attr( 'Book', 'wise-blog'),
			'400' => esc_attr( 'Normal (default)', 'wise-blog'),
			'500' => esc_attr( 'Medium', 'wise-blog'),
			'600' => esc_attr( 'Semi-Bold', 'wise-blog'),
			'700' => esc_attr( 'Bold', 'wise-blog'),
			'800' => esc_attr( 'Extra-Bold', 'wise-blog'),
			'900' => esc_attr( 'Ultra-Bold', 'wise-blog'),
        );

        /* Choices */
        $wise_google_fonts = wise_google_fonts();

        /* Sanitization Functions */
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

        // Numbers
        if( !function_exists('wise_sanitize_num') ) :
            function wise_sanitize_num( $input ) {
                if( ( $input <= 0 ) ) {
                    return '';
                } else {
                    return absint($input);
                }
            }
        endif;

        /*--------------------------------------------------------------
            WISE TYPOGRAPHY
        --------------------------------------------------------------*/
        $wp_customize->add_panel( 'wise_typography_options_panel',
            array(
                'title'           => esc_attr__( 'Wise Typography', 'wise-blog' ),
                'description'     => esc_attr__( 'Theme font settings', 'wise-blog' ),
                'priority'        => 1,
                'capability'      => 'edit_theme_options',
                'theme_supports'  => '',
                'active_callback' => '',
            )
        );

        /*--------------------------------------------------------------
        1. Heading Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_heading_settings',
            array(
                'title'       => esc_attr__( 'Heading Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for heading', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        1.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_heading_font',
            array(
                'default'           => 'Roboto',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_heading_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_heading_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_heading_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.2 Slider and Block Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_big_heading_weight',
            array(
                'default'           => '700',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_big_heading_weight',
            array(
                'label'       => esc_attr__( 'Slider and Block Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_big_heading_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_heading_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.3 General Heading Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_gen_heading_weight',
            array(
                'default'           => '500',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_gen_heading_weight',
            array(
                'label'       => esc_attr__( 'General Heading Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_gen_heading_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_heading_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        1.4 Other Heading Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_other_heading_weight',
            array(
                'default'           => '400',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_other_heading_weight',
            array(
                'label'       => esc_attr__( 'Other Heading Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_other_heading_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_heading_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Heading Font Settings

        /*--------------------------------------------------------------
        2. Body Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_bodycont_settings',
            array(
                'title'       => esc_attr__( 'Body Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for body contents', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        2.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_bodycont_font',
            array(
                'default'           => 'Open Sans',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_bodycont_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_bodycont_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_bodycont_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        2.2 Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_bodycont_weight',
            array(
                'default'           => '400',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_bodycont_weight',
            array(
                'label'       => esc_attr__( 'Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_bodycont_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_bodycont_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Body Fonts Settings

        /*--------------------------------------------------------------
        3. Input and Meta Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_inmeta_settings',
            array(
                'title'       => esc_attr__( 'Input and Meta Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for input and meta', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        3.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_inmeta_font',
            array(
                'default'           => 'Ubuntu',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_inmeta_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_inmeta_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_inmeta_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        3.2 Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_inmeta_weight',
            array(
                'default'           => '400',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_inmeta_weight',
            array(
                'label'       => esc_attr__( 'Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_inmeta_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_inmeta_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Input and Meta Fonts Settings

        /*--------------------------------------------------------------
        4. Button Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_button_settings',
            array(
                'title'       => esc_attr__( 'Button Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for buttons', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        4.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_button_font',
            array(
                'default'           => 'Open Sans',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_button_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_button_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_button_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        4.2 Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_button_weight',
            array(
                'default'           => '600',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_button_weight',
            array(
                'label'       => esc_attr__( 'Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_button_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_button_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Button Font Settings

        /*--------------------------------------------------------------
        5. Navigation Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_navi_settings',
            array(
                'title'       => esc_attr__( 'Navigation Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for navigation including tag lines', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        5.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_navi_font',
            array(
                'default'           => 'Open Sans',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_navi_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_navi_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_navi_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        5.2 Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_navi_weight',
            array(
                'default'           => '600',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_navi_weight',
            array(
                'label'       => esc_attr__( 'Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_navi_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_navi_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Navigation Fonts Settings

        /*--------------------------------------------------------------
        6. Description Fonts
        --------------------------------------------------------------*/
        $wp_customize->add_section( 'wise_taxdesc_settings',
            array(
                'title'       => esc_attr__( 'Description Fonts', 'wise-blog' ),
                'priority'    => 1,
                'capability'  => 'edit_theme_options',
                'description' => esc_attr__( 'Typography for taxonomy descriptions', 'wise-blog' ),
                'panel'       => 'wise_typography_options_panel',
            )
        );

        /*--------------------------------------------------------------
        6.1 Font Family
        --------------------------------------------------------------*/
        // Font Family Settings
        $wp_customize->add_setting( $shortname.'_taxdesc_font',
            array(
                'default'           => 'Raleway',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Family Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_taxdesc_font',
            array(
                'label'       => esc_attr__( 'Font Family', 'wise-blog' ),
                'settings'    => $shortname.'_taxdesc_font',
                'type'        => 'select',
                'choices'     => $wise_google_fonts,
                'section'     => 'wise_taxdesc_settings',
                'description' => esc_attr__( 'Select fonts.', 'wise-blog' ),
            )
        ) );

        /*--------------------------------------------------------------
        6.2 Font Weight
        --------------------------------------------------------------*/
        // Font Weight Settings
        $wp_customize->add_setting( $shortname.'_taxdesc_weight',
            array(
                'default'           => '400',
                'type'              => 'theme_mod',
                'capability'        => 'edit_theme_options',
                'transport'         => 'refresh',
                'sanitize_callback' => 'wise_sanitize_choices',
            )
        );
 
        // Font Weight Control      
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            $shortname.'_taxdesc_weight',
            array(
                'label'       => esc_attr__( 'Font Weight', 'wise-blog' ),
                'settings'    => $shortname.'_taxdesc_weight',
                'type'        => 'select',
                'choices'     => $wise_fontweight,
                'section'     => 'wise_taxdesc_settings',
                'description' => esc_attr__( 'Select font weight.', 'wise-blog' ),
            )
        ) );

        // End Description Fonts Settings
    }
}
add_action( 'customize_register' , array( 'Wise_Panel_Typography' , 'register' ) );