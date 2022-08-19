<?php
/*
* Theme Functions
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Global Variables
2. Wise Setup
	2.1 Visual Editor Theme
	2.2 Language
	2.3 RSS Links Support
	2.4 Manage Document Title
	2.5 Posts Thumbnails Sizes
	2.6 Register Navigation
	2.7 Make HTML5 Valid
	2.8 Posts Format Support
3. Set Maximum Content Width
4. Register Sidebars
5. Enqueue Scripts and Style
6. Require Functions
	6.1 Additional Functions
	6.2 Wise Panel and Wise Typography
	6.3 Wise Blocks and Fields
	6.4 Dynamic Sidebar
	6.5 TGM Plugin Activation
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Global Variables
--------------------------------------------------------------*/	
// Styles Directory
$wise_style_css = get_template_directory_uri() . '/style.css';
$wise_font_awesome = get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css';
$wise_tabs_css = get_template_directory_uri() . '/css/tabs.css';
$wise_bbpress_css = get_template_directory_uri() . '/css/bbpress.css';
$wise_owl_carousel = get_template_directory_uri() . '/css/owl.carousel.css';
$wise_woocommerce_css = get_template_directory_uri() . '/css/woocommerce.css';
$wise_animate_css = get_template_directory_uri() . '/css/animate.css';
$wise_prism_css = get_template_directory_uri() . '/css/prism.css';

// Header Style
$wise_header_simple_css = get_template_directory_uri() . '/css/header-simple.css';

// Predefined Colors
$wise_pre_colors_css = get_template_directory_uri() . '/css/all-colors.css';  // default
$wise_precs_newsred_css = get_template_directory_uri() . '/css/pre-colors/color-newsred.css';
$wise_precs_orange_css = get_template_directory_uri() . '/css/pre-colors/color-orange.css';
$wise_precs_darkcyan_css = get_template_directory_uri() . '/css/pre-colors/color-darkcyan.css';
$wise_precs_steelblue_css = get_template_directory_uri() . '/css/pre-colors/color-steelblue.css';
$wise_precs_olive_css = get_template_directory_uri() . '/css/pre-colors/color-olive.css';
$wise_precs_wallnut_css = get_template_directory_uri() . '/css/pre-colors/color-wallnut.css';
$wise_precs_sienna_css = get_template_directory_uri() . '/css/pre-colors/color-sienna.css';
$wise_precs_hotpink_css = get_template_directory_uri() . '/css/pre-colors/color-hotpink.css';
$wise_precs_neonpurple_css = get_template_directory_uri() . '/css/pre-colors/color-neonpurple.css';

// Columns
$wise_layout_opt = get_theme_mod('wise_layout');
$wise_3column_layout = get_template_directory_uri() . '/css/three-column.css';
$wise_2column_layout = get_template_directory_uri() . '/css/two-column.css';

// Scripts Directory
$wise_headhesive_js = get_template_directory_uri() . '/js/headhesive.min.js';
$wise_superfish_js = get_template_directory_uri() . '/js/superfish.min.js';
$wise_tabs_js = get_template_directory_uri() . '/js/tabs.min.js';
$wise_sticky_js = get_template_directory_uri() . '/js/sticky-kit.min.js';
$wise_owl_js = get_template_directory_uri() . '/js/owl.carousel.min.js';
$wise_masonry_js = get_template_directory_uri() . '/js/wise-masonry.js';
$wise_retina_js = get_template_directory_uri() . '/js/retina.min.js';
$wise_alert_js = get_template_directory_uri() . '/js/alert.min.js';
$wise_settings_js = get_template_directory_uri() . '/js/all-settings.js';
$wise_smooth_scroll_js = get_template_directory_uri() . '/js/smooth-scroll.min.js';
$wise_homeToggle_js = get_template_directory_uri() . '/js/toggle.js';
$wise_prism_js = get_template_directory_uri() . '/js/prism.min.js';

// WP KSES Allowed HTML
$wise_allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
		'alt' => array(),
		'rel' => array()
	),
	'br' => array(),
	'em' => array(),
	'strong' => array(),
	'i' => array(),
	'span' => array()
);

/* List Categories */
global $wp_cats;
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
	$wp_cats[$category_list->slug] = $category_list->cat_name;
}
array_unshift($wp_cats, '');

/*--------------------------------------------------------------
2. Wise Setup
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_setup' ) ) :
	function wise_setup() {
		
		/*--------------------------------------------------------------
		2.1 Visual Editor Theme
		--------------------------------------------------------------*/
		if( is_admin() ) {
			$wise_google_fonts_settings = function_exists('wise_google_fonts_settings') ? wise_google_fonts_settings() : null;
			$font_url = str_replace( ',', '%2C', $wise_google_fonts_settings );
			add_editor_style( 'css/custom-editor-style.css' );
			add_editor_style( '/fonts/font-awesome/css/font-awesome.min.css' );
			add_editor_style( $font_url );
		}
			
		/*--------------------------------------------------------------
		2.2 Language
		--------------------------------------------------------------*/
		load_theme_textdomain( 'wise-blog', get_template_directory() . '/lang' );

		/*--------------------------------------------------------------
		2.3 RSS Links Support
		--------------------------------------------------------------*/
		add_theme_support( 'automatic-feed-links' );

		/*--------------------------------------------------------------
		2.4 Manage Document Title
		--------------------------------------------------------------*/
		add_theme_support( 'title-tag' );

		/*--------------------------------------------------------------
		2.5 Posts Thumbnails Sizes
		--------------------------------------------------------------*/
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'wise-post-thumb', 730, 438, true );
		add_image_size( 'wise-related-thumb', 230, 138, true );
		add_image_size( 'wise-home-thumb', 380, 228, true );
		add_image_size( 'wise-side-thumb', 88, 53, true );

		/*--------------------------------------------------------------
		2.6 Register Navigation
		--------------------------------------------------------------*/
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'wise-blog' ),
			'secondary' => esc_html__( 'Secondary Menu', 'wise-blog' ),
			'sitelinks_first' => esc_html__( 'Sitelinks First Column', 'wise-blog' ), // Sitelinks first column for sitelinks footer widget
			'sitelinks_second' => esc_html__( 'Sitelinks Second Column', 'wise-blog' ), // Sitelinks second column for sitelinks footer widget
			'footers' => esc_html__( 'Footer Menu', 'wise-blog' ),
			'bbpress' => esc_html__( 'bbPress Menu', 'wise-blog' ),
			'woocommerce' => esc_html__( 'WooCommerce Menu', 'wise-blog' ),
		) );

		/*--------------------------------------------------------------
		2.7 Make HTML5 Valid
		--------------------------------------------------------------*/	
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*--------------------------------------------------------------
		2.8 Posts Format Support
		--------------------------------------------------------------*/
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );
	}

	/* End wise_setup */
	add_action( 'after_setup_theme', 'wise_setup' );
endif;

/*--------------------------------------------------------------
3. Set Maximum Content Width
--------------------------------------------------------------*/
if ( ! isset( $content_width ) ) :
	$content_width = 730;
endif;

/*--------------------------------------------------------------
4. Register Sidebars
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_widgets_init' ) ) :
	function wise_widgets_init() {
		register_sidebar( array(
			'name'          => esc_attr__( 'Sidebar Right', 'wise-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_attr__( 'Add widgets to be displayed at the right side of the post.', 'wise-blog' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_attr__( 'Sidebar Left', 'wise-blog' ),
			'id'            => 'sidebar-2',
			'description'   => esc_attr__( 'Add widgets to be displayed at the left side of the post.', 'wise-blog' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );

		register_sidebar( array(
			'name'          => esc_attr__( 'Footer Column', 'wise-blog' ),
			'id'            => 'sidebar-3',
			'description'   => esc_attr__( 'Add widgets to be displayed at the footer.', 'wise-blog' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_attr__( 'Sidebar Forum', 'wise-blog' ),
			'id'            => 'sidebar-4',
			'description'   => esc_attr__( 'Add widgets to be displayed at the forum page.', 'wise-blog' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_attr__( 'Sidebar Shop', 'wise-blog' ),
			'id'            => 'sidebar-5',
			'description'   => esc_attr__( 'Add widgets to be displayed at the shop page.', 'wise-blog' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_attr__( 'Top Ads', 'wise-blog' ),
			'id'            => 'sidebar-6',
			'description'   => esc_attr__( 'Add widgets to be displayed at the bottom of header.', 'wise-blog' ),
		) );

		register_sidebar( array(
			'name'          => esc_attr__( 'Top Document', 'wise-blog' ),
			'id'            => 'sidebar-7',
			'description'   => esc_attr__( 'Add widgets to the top of page before header.', 'wise-blog' ),
		) );
		
		register_sidebar( array(
			'name'          => esc_attr__( 'Bottom Ads', 'wise-blog' ),
			'id'            => 'sidebar-8',
			'description'   => esc_attr__( 'Add widgets to be displayed at the top of footer.', 'wise-blog'),
		) );
	}

add_action( 'widgets_init', 'wise_widgets_init' );
endif; // End Register Widgets

/*--------------------------------------------------------------
5. Enqueue Scripts and Style
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_scripts' ) ) :

	function wise_scripts() {
		
		global $wise_style_css, $wise_font_awesome, $wise_tabs_css, $wise_bbpress_css, $wise_owl_carousel, $wise_woocommerce_css, $wise_animate_css, $wise_pre_colors_css, $wise_3column_layout, $wise_2column_layout, $wise_prism_css, 
		$wise_headhesive_js, $wise_superfish_js, $wise_tabs_js, $wise_sticky_js, $wise_owl_js, $wise_masonry_js, $wise_retina_js, $wise_alert_js, $wise_settings_js, $wise_smooth_scroll_js, $wise_homeToggle_js, $wise_prism_js,
        $wise_precs_newsred_css, $wise_precs_orange_css, $wise_precs_darkcyan_css, $wise_precs_steelblue_css, $wise_precs_olive_css, $wise_precs_wallnut_css, $wise_precs_sienna_css, $wise_precs_hotpink_css, $wise_precs_neonpurple_css,
        $wise_header_simple_css;
	
		$wise_google_fonts_settings = function_exists('wise_google_fonts_settings') ? wise_google_fonts_settings() : null;

		wp_enqueue_style ( 'wise-tabs', $wise_tabs_css );
		
		wp_enqueue_style( 'wise-style', $wise_style_css );
		
		wp_enqueue_style ( 'wise-google-fonts', $wise_google_fonts_settings, false, null, 'all' );
		
		wp_enqueue_style ( 'font-awesome', $wise_font_awesome );
				
		wp_enqueue_style ( 'tab-css', $wise_tabs_css );
		
		wp_enqueue_style ( 'owl-carousel', $wise_owl_carousel );
		
		wp_enqueue_style ( 'wise-three-column-layout', $wise_3column_layout );

		wp_enqueue_style ( 'wise-two-column-layout', $wise_2column_layout );
		
		if( function_exists('is_bbpress') ) {
			wp_enqueue_style ( 'bbpress', $wise_bbpress_css );
		}
		
		if( function_exists('is_woocommerce') ) {
			wp_enqueue_style ( 'woocommerce', $wise_woocommerce_css );
		}
								
		// Predefined Color Scheme
		wp_enqueue_style ( 'wise-precs-neonpurple', $wise_precs_neonpurple_css );
		wp_enqueue_style ( 'wise-precs-hotpink', $wise_precs_hotpink_css );
		wp_enqueue_style ( 'wise-precs-sienna', $wise_precs_sienna_css );
		wp_enqueue_style ( 'wise-precs-wallnut', $wise_precs_wallnut_css );
		wp_enqueue_style ( 'wise-precs-olive', $wise_precs_olive_css );
		wp_enqueue_style ( 'wise-precs-steelblue', $wise_precs_steelblue_css );
		wp_enqueue_style ( 'wise-precs-darkcyan', $wise_precs_darkcyan_css );
		wp_enqueue_style ( 'wise-precs-orange', $wise_precs_orange_css );
		wp_enqueue_style ( 'wise-precs-newsred', $wise_precs_newsred_css );
		
		wp_enqueue_style ( 'animate', $wise_animate_css );
		
        wp_enqueue_style ( 'prism', $wise_prism_css );
        
        if( get_theme_mod( 'wise_header_type' ) == 'simple' ){
            wp_enqueue_style ( 'wise-header-simple', $wise_header_simple_css );
        }
					
		// Original Javascript			
		if (get_theme_mod('wise_headhesive') == false) : wp_enqueue_script ( 'headhesive', $wise_headhesive_js, array('jquery'), '20150714', true ); endif;
			
		wp_enqueue_script( 'superfish', $wise_superfish_js, array('jquery'), '20150713', true );	
		
		wp_enqueue_script( 'wise-tabs', $wise_tabs_js, array('jquery'), '1.12.1', true );
			
		if( get_theme_mod('wise_disable_sticky') == false ) : wp_enqueue_script( 'sticky-kit', $wise_sticky_js, array(), '20151118', true ); endif;
				
		wp_enqueue_script ( 'owl-carousel', $wise_owl_js, array('jquery'), '20151201', true );
		
		wp_enqueue_script ( 'masonry-settings', $wise_masonry_js, array('masonry'), '20151203', true );
		
		wp_enqueue_script ( 'retina', $wise_retina_js, array(), '20190923', true );
		
		wp_enqueue_script ( 'alert', $wise_alert_js, array(), '20160222', true );		
		
		wp_enqueue_script ( 'smooth-scroll', $wise_smooth_scroll_js, array(), '20160423', true );
		
		wp_enqueue_script ( 'wise-all-settings', $wise_settings_js, array(), '20160108', true );
									
		wp_enqueue_script ( 'wise-toggle-js', $wise_homeToggle_js, array('jquery'), '20160630', true );
		
		wp_enqueue_script ( 'prism', $wise_prism_js, array('jquery'), '20160702', true );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
			
	} // End Original CSS and Javascript
			
	add_action( 'wp_enqueue_scripts', 'wise_scripts' );
	
endif; // End Enqueue

/*--------------------------------------------------------------
6. Require Functions
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	6.1 Additional Functions
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/additional-functions.php';
	require get_template_directory() . '/inc/falkvinge-functions.php';

	/*--------------------------------------------------------------
	6.2 Wise Panel and Wise Typography
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/wise-panel/wise-panel.php';
	require get_template_directory() . '/inc/wise-typography/main.php';
	
	/*--------------------------------------------------------------
	6.3 Wise Blocks and Fields
	--------------------------------------------------------------*/
	if( function_exists('carbon_fields_boot_plugin') && !function_exists('wise_register_builder') ) :
		function wise_register_builder() {
			/* Verify if it is installed */
			if ( !function_exists('carbon_get_post_meta') ) {
				function carbon_get_post_meta( $id, $name, $type = null ) {
					return false;
				}   
			}

			if ( !function_exists( 'carbon_get_the_post_meta' ) ) {
				function carbon_get_the_post_meta( $name, $type = null ) {
					return false;
				}   
			}

			if ( !function_exists( 'carbon_get_theme_option' ) ) {
				function carbon_get_theme_option( $name, $type = null ) {
					return false;
				}   
			}

			if ( !function_exists( 'carbon_get_term_meta' ) ) {
				function carbon_get_term_meta( $id, $name, $type = null ) {
					return false;
				}   
			}

			if ( !function_exists( 'carbon_get_user_meta' ) ) {
				function carbon_get_user_meta( $id, $name, $type = null ) {
					return false;
				}   
			}

			if ( !function_exists( 'carbon_get_comment_meta' ) ) {
				function carbon_get_comment_meta( $id, $name, $type = null ) {
					return false;
				}   
			}

			/* Blocks and fields */
			include_once get_template_directory() . '/inc/page-fields.php';
            include_once get_template_directory() . '/inc/post-fields.php';
            if( method_exists( '\\Carbon_Fields\\Container\\Block_Container', 'set_mode' ) ) { // plugin is version 3.2 or higher, using set_mode instead of set_preview_mode
                include_once get_template_directory() . '/inc/wise-blocks/wise-slider-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-ticker-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-content-sidebar-layout.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-ads-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-defaults-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-complex-one-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-complex-two-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-complex-three-block.php';
                include_once get_template_directory() . '/inc/wise-blocks/wise-complex-four-block.php';
            }
		}
		add_action('carbon_fields_register_fields', 'wise_register_builder');
	endif;

	/*--------------------------------------------------------------
	6.4 Dynamic Sidebar
	--------------------------------------------------------------*/
	if( function_exists('carbon_fields_boot_plugin') && !function_exists('wise_dynamic_sidebar') ) : // If Carbon Field exists
		function wise_dynamic_sidebar($index = 1, $options = array()) {
			global $wp_registered_sidebars;

			// Get the sidebar index the same way as the dynamic_sidebar() function
			if ( is_int($index) ) {
				$index = 'sidebar-$index';
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
	endif;
	
	/*--------------------------------------------------------------
	6.5 TGM Plugin Activation
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/tgmpa/tgmpa-settings.php';
