<?php
/*
* Wise Panel Main
*
*/

include get_template_directory() . '/inc/wise-panel/panel-opt.php'; // Get panel options

/* Wise Panel Admin */
function wise_add_admin() {
global $themename, $shortname, $options;

if (isset($_GET['page'])) :

	if ( $_GET['page'] == basename(__FILE__) ) {	
	
		if ( 'save' == isset($_REQUEST['action'] ) ) {
			
			foreach ($options as $value) {
					update_option( @$value['id'], @$_REQUEST[ $value['id'] ] );
			} // End options
		 
			foreach ($options as $value) {
				if( isset( $_REQUEST[ @$value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				} else {
					delete_option( @$value['id'] ); 
				}
			} // End options

			header("Location: admin.php?page=wise-panel.php&saved=true"); die;			
		
		} else if( 'reset' == isset($_REQUEST['action'] ) ) {
		 
			foreach ($options as $value) {
				delete_option( $value['id'] ); 
			} // End options
			
			header("Location: admin.php?page=wise-panel.php&reset=true"); die;
		 
		} // End Reset
	} // End Get Page
	
endif; // End if Page is set
 
add_theme_page( $themename, 'Wise ' . esc_attr__( 'Panel', 'wise-blog'), 'administrator', basename(__FILE__), 'wise_admin' );
}

/* Wise Panel Styles and Scripts */
function wise_add_init() {
	wp_enqueue_style( 'wise-panel-css', get_template_directory_uri() . '/inc/wise-panel/css/wise-panel.css' );
	wp_enqueue_style ( 'wise-google-fonts', wise_google_fonts_settings(), false, null, 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style ( 'animate-css', get_template_directory_uri() . '/css/animate.css' );
	wp_register_script( 'wise-custom-js', get_template_directory_uri() . '/inc/wise-panel/js/wise-admin.js', array('jquery','media-upload','thickbox'), '20150714', true );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_style('wp-color-picker');

	wp_enqueue_script( 'media-upload');
	wp_enqueue_script( 'wise-custom-js');
	wp_enqueue_script('wp-color-picker');
} // End enqueue styles and script

/* Wise Panel Media Upload */
function wise_options_setup() {
    global $pagenow; 
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        // Insert into Post text replacement
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
    }
}
add_action( 'admin_init', 'wise_options_setup' );

/* Wise Panel Replace Thickbox */
function replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {
        $referer = strpos( wp_get_referer(), 'wise-settings' );
        if ( $referer != '' ) {
            return esc_attr__('Insert Now', 'wise-blog' );
        }
    }
    return $translated_text;
}

include get_template_directory() . '/inc/wise-panel/panel-back.php'; // Get panel backend

add_action( 'admin_init', 'wise_add_init' );
add_action( 'admin_menu', 'wise_add_admin' );
?>