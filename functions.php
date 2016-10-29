<?php
/*
* Theme Functions
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Initializations
	1.1 Disable Magic Quotes
	1.2 Global Variables
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
4. Register Widgets
5. Enqueue Scripts and Style
6. Require Functions
	6.1 Additional Functions
	6.2 Wise Widgets
	6.3 Wise Panel
	6.4 Wise Custom Fields
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Initializations
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	1.1 Disable Magic Quotes
	--------------------------------------------------------------*/
	$_POST      = array_map( 'stripslashes_deep', $_POST );
	$_GET       = array_map( 'stripslashes_deep', $_GET );
	$_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
	$_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );

	/*--------------------------------------------------------------
	1.2 Global Variables
	--------------------------------------------------------------*/
	$wise_default_location = get_template_directory() . '/minified/'; // default location of minified files
	
	// Styles Directory
	$wise_style_css = get_template_directory_uri() . '/style.css';
	$wise_font_awesome = get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css';
	$wise_tabs_css = get_template_directory_uri() . '/css/tab.css';
	$wise_bbpress_css = get_template_directory_uri() . '/css/bbpress.css';
	$wise_owl_carousel = get_template_directory_uri() . '/css/owl.carousel.css';
	$wise_woocommerce_css = get_template_directory_uri() . '/css/woocommerce.css';
	if( get_option('wise_pre_colors') != null ) { $wise_pre_colors_css = get_template_directory_uri() . '/css/pre-colors/color-' . get_option('wise_pre_colors') . '.css'; } else { $wise_pre_colors_css = null; };
	$wise_animate_css = get_template_directory_uri() . '/css/animate.css';
	$wise_prism_css = get_template_directory_uri() . '/css/prism.css';
	
	// Columns
	$wise_layout_opt = get_option('wise_layout');
	if( $wise_layout_opt != null ) { $wise_column_layout = get_template_directory_uri() . '/css/' . $wise_layout_opt . '-column.css'; } else { $wise_column_layout = get_template_directory_uri() . '/css/two-column.css'; }
	
	// Scripts Directory
	$wise_headhesive_js = get_template_directory_uri() . '/js/headhesive.js';
	$wise_superfish_js = get_template_directory_uri() . '/js/superfish.js';
	$wise_tab_js = get_template_directory_uri() . '/js/tab.js';
	$wise_sticky_js = get_template_directory_uri() . '/js/sticky-kit.js';
	$wise_owl_js = get_template_directory_uri() . '/js/owl.carousel.min.js';
	$wise_masonry_js = get_template_directory_uri() . '/js/wise-masonry.js';
	$wise_retina_js = get_template_directory_uri() . '/js/retina.js';
	$wise_alert_js = get_template_directory_uri() . '/js/alert.js';
	$wise_settings_js = get_template_directory_uri() . '/js/all-settings.js';
	$wise_smooth_scroll_js = get_template_directory_uri() . '/js/smooth-scroll.min.js';
	$wise_homeToggle_js = get_template_directory_uri() . '/js/toggle.js';
	$wise_prism_js = get_template_directory_uri() . '/js/prism.js';
	
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
	
if ( ! function_exists( 'wise_setup' ) ) :

/*--------------------------------------------------------------
2. Wise Setup
--------------------------------------------------------------*/
function wise_setup() {
	
	/*--------------------------------------------------------------
	2.1 Visual Editor Theme
	--------------------------------------------------------------*/
		if( is_admin() ) {
			$font_url = str_replace( ',', '%2C', wise_google_fonts_settings() );
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
4. Register Widgets
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_widgets_init' ) ) :
	function wise_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Right', 'wise-blog' ),
			'id'            => 'sidebar-1',
			'description'   => 'Add widgets to be displayed at the right side of the post.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Left', 'wise-blog' ),
			'id'            => 'sidebar-2',
			'description'   => 'Add widgets to be displayed at the left side of the post.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Column', 'wise-blog' ),
			'id'            => 'sidebar-3',
			'description'   => 'Add widgets to be displayed at the footer.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Forum', 'wise-blog' ),
			'id'            => 'sidebar-4',
			'description'   => 'Add widgets to be displayed at the forum page.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'wise-blog' ),
			'id'            => 'sidebar-5',
			'description'   => 'Add widgets to be displayed at the shop page.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widget-title"><h2>',
			'after_title'   => '</h2></div>',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Top Ads', 'wise-blog' ),
			'id'            => 'sidebar-6',
			'description'   => 'Add widgets to be displayed at the bottom of header.',
		) );
		
		register_sidebar( array(
			'name'          => esc_html__( 'Bottom Ads', 'wise-blog' ),
			'id'            => 'sidebar-7',
			'description'   => 'Add widgets to be displayed at the top of footer.',
		) );

	}

add_action( 'widgets_init', 'wise_widgets_init' );
endif; // End Register Widgets

/*--------------------------------------------------------------
5. Enqueue Scripts and Style
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_scripts' ) ) :
	function wise_scripts() {
		
		// Enabled minified CSS and JavaScript
		if ( get_option('wise_minify_optimize') == true ) {

			global $wp_filesystem, $wise_default_location, $wise_style_css, $wise_font_awesome, $wise_tabs_css, $wise_bbpress_css, $wise_owl_carousel, $wise_woocommerce_css, $wise_animate_css, $wise_pre_colors_css, $wise_column_layout, $wise_prism_css, 
			$wise_headhesive_js, $wise_superfish_js, $wise_tab_js, $wise_sticky_js, $wise_owl_js, $wise_masonry_js, $wise_retina_js, $wise_alert_js, $wise_settings_js, $wise_smooth_scroll_js, $wise_homeToggle_js, $wise_prism_js;
			
			// Enqueue Minified CSS and JavaScript			
			$min_all = get_template_directory_uri() . '/minified/css/all.min.css';
			
			$min_headhesive = get_template_directory_uri() . '/minified/js/headhesive.min.js';
			$min_superfish = get_template_directory_uri() . '/minified/js/superfish.min.js';
			$min_stickykit = get_template_directory_uri() . '/minified/js/sticky-kit.min.js';
			$min_retina = get_template_directory_uri() . '/minified/js/retina.min.js';
			$min_settings = get_template_directory_uri() . '/minified/js/all-settings.min.js';
			$min_alert = get_template_directory_uri() . '/minified/js/alert.min.js';
			$min_tab_js = get_template_directory_uri() . '/minified/js/tab.min.js';
			$min_masonry = get_template_directory_uri() . '/minified/js/masonry.min.js';
			$min_toggle = get_template_directory_uri() . '/minified/js/toggle.min.js';
			
			// Minified CSS			
			wp_enqueue_style ( 'wise-all-css', $min_all );
			
			// Minified JavaScript			
			if (get_option('wise_headhesive') == false) : wp_enqueue_script ( 'headhesive', $min_headhesive, array('jquery'), '20150714', true ); endif;
				
			wp_enqueue_script( 'superfish', $min_superfish, array('jquery'), '20150713', true );	
			
			wp_enqueue_script( 'tab', $min_tab_js, array(), '20160109', true );
				
			if (get_option('wise_disable_sticky') == false) : wp_enqueue_script( 'sticky-kit', $min_stickykit, array(), '20151118', true ); endif;
					
			wp_enqueue_script ( 'owl-carousel', $wise_owl_js, array('jquery'), '20151201', true );
			
			wp_enqueue_script ( 'wise-masonry-settings', $min_masonry, array('masonry'), '20151203', true );
			
			wp_enqueue_script ( 'retina', $min_retina, array(), '20151228', true );
			
			wp_enqueue_script ( 'alert', $min_alert, array(), '20160222', true );
			
			wp_enqueue_script ( 'smooth-scroll', $wise_smooth_scroll_js, array(), '20160423', true );
			
			wp_enqueue_script ( 'wise-all-settings', $min_settings, array(), '20160108', true );
												
			wp_enqueue_script ( 'toggle-js', $min_toggle, array('jquery'), '20160630', true );
			
			wp_enqueue_script ( 'prism', $wise_prism_js, array('jquery'), '20160702', true );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			
		} // End Minified CSS and Javascript
		
		else { // Original CSS
		
			global $wp_filesystem, $wise_default_location, $wise_style_css, $wise_font_awesome, $wise_tabs_css, $wise_bbpress_css, $wise_owl_carousel, $wise_woocommerce_css, $wise_animate_css, $wise_pre_colors_css, $wise_column_layout, $wise_prism_css, 
			$wise_headhesive_js, $wise_superfish_js, $wise_tab_js, $wise_sticky_js, $wise_owl_js, $wise_masonry_js, $wise_retina_js, $wise_alert_js, $wise_settings_js, $wise_smooth_scroll_js, $wise_homeToggle_js, $wise_prism_js;
		
			wp_enqueue_style( 'wise-style', $wise_style_css );
			
			wp_enqueue_style ( 'wise-google-fonts', wise_google_fonts_settings(), false, null, 'all' );
			
			wp_enqueue_style ( 'font-awesome', $wise_font_awesome );
					
			wp_enqueue_style ( 'tab-css', $wise_tabs_css );
			
			wp_enqueue_style ( 'owl-carousel-css', $wise_owl_carousel );
			
			wp_enqueue_style ( 'wise-layout-style', $wise_column_layout );
			
			if( function_exists('is_bbpress') ) {
				wp_enqueue_style ( 'bbpress', $wise_bbpress_css );
			}
			
			if( function_exists('is_woocommerce') ) {
				wp_enqueue_style ( 'woocommerce', $wise_woocommerce_css );
			}
									
			wp_enqueue_style ( 'wise-pre-colors-css', $wise_pre_colors_css );
			
			wp_enqueue_style ( 'animate-css', $wise_animate_css );
			
			wp_enqueue_style ( 'prism-css', $wise_prism_css );
						
			// Original Javascript			
			if (get_option('wise_headhesive') == false) : wp_enqueue_script ( 'headhesive', $wise_headhesive_js, array('jquery'), '20150714', true ); endif;
				
			wp_enqueue_script( 'superfish', $wise_superfish_js, array('jquery'), '20150713', true );	
			
			wp_enqueue_script( 'tab', $wise_tab_js, array(), '20160109', true );
				
			if (get_option('wise_disable_sticky') == false) : wp_enqueue_script( 'sticky-kit', $wise_sticky_js, array(), '20151118', true ); endif;
					
			wp_enqueue_script ( 'owl-carousel', $wise_owl_js, array('jquery'), '20151201', true );
			
			wp_enqueue_script ( 'masonry-settings', $wise_masonry_js, array('masonry'), '20151203', true );
			
			wp_enqueue_script ( 'retina', $wise_retina_js, array(), '20151228', true );
			
			wp_enqueue_script ( 'alert', $wise_alert_js, array(), '20160222', true );		
			
			wp_enqueue_script ( 'smooth-scroll', $wise_smooth_scroll_js, array(), '20160423', true );
			
			wp_enqueue_script ( 'wise-all-settings', $wise_settings_js, array(), '20160108', true );
										
			wp_enqueue_script ( 'wise-toggle-js', $wise_homeToggle_js, array('jquery'), '20160630', true );
			
			wp_enqueue_script ( 'prism', $wise_prism_js, array('jquery'), '20160702', true );
						
			} // End Original CSS and Javascript
			
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
	}
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
	6.2 Wise Widgets
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/wise-widgets/wise-about.php';
	require get_template_directory() . '/inc/wise-widgets/wise-popular-posts.php';
	require get_template_directory() . '/inc/wise-widgets/wise-recent-posts.php';
	require get_template_directory() . '/inc/wise-widgets/wise-tab-popular-recent.php';
	require get_template_directory() . '/inc/wise-widgets/wise-sitelinks.php';
	require get_template_directory() . '/inc/wise-widgets/wise-social-media-footer.php';
	require get_template_directory() . '/inc/wise-widgets/wise-subscribe-footer.php';
	require get_template_directory() . '/inc/wise-widgets/wise-subscribe-sidebar.php';
	require get_template_directory() . '/inc/wise-widgets/wise-text-alert.php';
	require get_template_directory() . '/inc/wise-widgets/wise-script.php';
	require get_template_directory() . '/inc/wise-widgets/wise-dashboard-user.php';

	/*--------------------------------------------------------------
	6.3 Wise Panel
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/wise-panel/wise-panel.php';
	
	/*--------------------------------------------------------------
	6.4 Wise Custom Fields
	--------------------------------------------------------------*/
	require get_template_directory() . '/inc/carbon-fields/carbon-fields-main.php';
	
	function wise_register_builder() {
		include_once(get_template_directory() . '/inc/page-fields.php');
	}
	add_action('carbon_register_fields', 'wise_register_builder');	
	
	function load_widgets() {
		include_once(get_template_directory() . '/inc/wise-widgets/home-widgets.php');
		include_once(get_template_directory() . '/inc/wise-widgets/wise-ads.php');
	}
	add_action('widgets_init', 'load_widgets');
