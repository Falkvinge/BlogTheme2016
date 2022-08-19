<?php
/*
*
* One Click Demo Functions Settings
* @dependent on One Click Demo Import plugin
*
*/
	/*--------------------------------------------------------------
	Demo File URL
	--------------------------------------------------------------*/
	function wise_blog_import_files() {
	  return array(
		array(
		  'import_file_name'           => 'Wise Blog WordPress Theme',
		  'import_file_url'            => 'https://www.probewise.com/demo/import/wise-blog-demo-xml-import.xml', // Contents
		  'import_widget_file_url'     => 'https://www.probewise.com/demo/import/wise-blog-widgets-import.wie', // Widgets
		  'import_customizer_file_url' => 'https://www.probewise.com/demo/import/wise-blog-customizer-import.dat', // Customizer
		),
	  );
	}
	add_filter( 'pt-ocdi/import_files', 'wise_blog_import_files' );

	/*--------------------------------------------------------------
	Menu/Homepage Assignment
	--------------------------------------------------------------*/
	function wise_blog_after_import_setup() {
		// Assign menus to their locations
		$wise_blog_main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		$wise_blog_secondary_menu = get_term_by( 'name', 'Secondary Menu', 'nav_menu' );
		$wise_blog_sitelinks1_menu = get_term_by( 'name', 'Sitelinks 1', 'nav_menu' );
		$wise_blog_sitelinks2_menu = get_term_by( 'name', 'Sitelinks 2', 'nav_menu' );
		$wise_blog_footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
		$wise_blog_bbpress_menu = get_term_by( 'name', 'Forum Menu', 'nav_menu' );
		$wise_blog_woocommerce_menu = get_term_by( 'name', 'Shop Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'primary' 		   => $wise_blog_main_menu->term_id,
				'secondary' 	   => $wise_blog_secondary_menu->term_id,
				'sitelinks_first'  => $wise_blog_sitelinks1_menu->term_id,
				'sitelinks_second' => $wise_blog_sitelinks2_menu->term_id,
				'footers' 		   => $wise_blog_footer_menu->term_id,
				'bbpress' 		   => $wise_blog_bbpress_menu->term_id,
				'woocommerce' 	   => $wise_blog_woocommerce_menu->term_id,
			)
		);

		// Assign front page
		$wise_blog_front_page_id = get_page_by_title( 'Home' );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $wise_blog_front_page_id->ID );

	}
	add_action( 'pt-ocdi/after_import', 'wise_blog_after_import_setup' );
	
	/*--------------------------------------------------------------
	Add Predefined Widget Column Before Import
	--------------------------------------------------------------*/
	function wise_blog_before_content_import( $selected_import ) {
		// Register sidebars
		$wise_registered_sidebars = array(
			'sidebar-news' => array(
				'id'   => 'sidebar-news',
				'name' => 'Sidebar News',
			),
			'sidebar-lifestyle' => array(
				'id'   => 'sidebar-lifestyle',
				'name' => 'Sidebar Lifestyle',
			),
			'sidebar-technology' => array(
				'id'   => 'sidebar-technology',
				'name' => 'Sidebar Technology',
			),
			'sidebar-entertainment' => array(
				'id'   => 'sidebar-entertainment',
				'name' => 'Sidebar Entertainment',
			),
			'sidebar-sports' => array(
				'id'   => 'sidebar-sports',
				'name' => 'Sidebar Sports',
			),
		);
		return update_option( 'carbon_custom_sidebars', $wise_registered_sidebars );
	}
	add_action( 'pt-ocdi/before_content_import_execution', 'wise_blog_before_content_import' );
