<?php
/*
* Wise Panel Options
*
*/

/* Theme name and shortname */
$themename = "Wise Blog";
$shortname = "wise";

/* List Categories */
global $wp_cats;
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
	$wp_cats[$category_list->cat_name] = $category_list->cat_name;
}
array_unshift($wp_cats, "");

/* List Pages */
$page_entry = get_pages('hide_empty=0&orderby=name');
$wp_page = array();
foreach ($page_entry as $page_list ) {
       $wp_page[$page_list->ID] = $page_list->post_title;
}
array_unshift($wp_page, "");

/* Font Weight List */
$fontweight = array("","100","200","300","400","500","600","700","800","900");

/* Options Starts Here */
$options = array (
 
array( "name" => $themename . " Options",
	"type" => "title"),
	
// General Settings
array( "name" => "General Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Favicon",
	"id" => $shortname."_favicon",
	"placeholder" => esc_attr__( 'Upload or enter your favicon URL here (32x32px). Leave blank to display default image.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Preloader URL",
	"id" => $shortname."_preload",
	"placeholder" => esc_attr__( 'Upload or enter preloader URL here (.gif, .png or .jpeg). Maximum of 372x152 pixels.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Disable Preloader",
	"id" => $shortname."_disable_preloader",
	"placeholder" => esc_attr__( 'Check this to disable site preloader.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Background URL",
	"id" => $shortname."_mainback",
	"placeholder" => esc_attr__( 'Upload or enter background URL here (1460x876px). Leave blank to display default image.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Disable Site Image Background",
	"id" => $shortname."_disable_back",
	"placeholder" => esc_attr__( 'Check this to disable site image background.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Layout Column",
	"id" => $shortname."_layout",
	"placeholder" => esc_attr__( 'Select Layout Column', 'wise-blog' ),
	"type" => "select",
	"options" => array("two","three"),
	"def" => ""),
	
array( "name" => "Disable Sticky Sidebar",
	"id" => $shortname."_disable_sticky",
	"placeholder" => esc_attr__( 'Check this to disable sticky sidebar.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "type" => "close"),

// Font Settings
array( "name" => "Font Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Heading Fonts",
	"id" => $shortname."_head_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Heading Font Weight",
	"id" => $shortname."_head_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "name" => "Paragraph Fonts",
	"id" => $shortname."_parag_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Paragraph Font Weight",
	"id" => $shortname."_parag_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "name" => "Input and Meta Fonts",
	"id" => $shortname."_meta_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Input and Meta Font Weight",
	"id" => $shortname."_meta_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "name" => "Button Fonts",
	"id" => $shortname."_button_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Button Font Weight",
	"id" => $shortname."_button_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "name" => "Navigation Fonts",
	"id" => $shortname."_nav_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Navigation Font Weight",
	"id" => $shortname."_nav_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "name" => "Description Fonts",
	"id" => $shortname."_desc_fonts",
	"placeholder" => esc_attr__( 'Select fonts from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => wise_google_fonts(),
	"def" => ""),
	
array( "name" => "Description Font Weight",
	"id" => $shortname."_desc_weight",
	"placeholder" => esc_attr__( 'Select font weight from the list', 'wise-blog' ),
	"type" => "select",
	"options" => $fontweight,
	"def" => ""),
	
array( "type" => "close"),

// Color Scheme Settings
array( "name" => "Color Scheme Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Predefined Colors",
	"id" => $shortname."_pre_colors",
	"placeholder" => esc_attr__( 'Select color scheme from the list (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => array("", "darkcyan", "steelblue", "olive", "wallnut", "sienna", "hotpink", "neonpurple"),
	"def" => ""),
	
array( "name" => "Header Lines Color",
	"id" => $shortname."_hline_color",
	"placeholder" => esc_attr__( 'Pick a color for header lines color.', 'wise-blog' ),
	"type" => "color",
	"def" => ""),
	
array( "name" => "Buttons and Tabs Color",
	"id" => $shortname."_button_color",
	"placeholder" => esc_attr__( 'Pick a color for buttons and tabs.', 'wise-blog' ),
	"type" => "color",
	"def" => ""),
	
array( "name" => "Text and Links Color",
	"id" => $shortname."_text_color",
	"placeholder" => esc_attr__( 'Pick a color for text and links.', 'wise-blog' ),
	"type" => "color",
	"def" => ""),
	
array( "name" => "Borders and Objects Color",
	"id" => $shortname."_line_color",
	"placeholder" => esc_attr__( 'Pick a color for lines, borders and objects.', 'wise-blog' ),
	"type" => "color",
	"def" => ""),

array( "type" => "close"),

// Code and Optimization Settings
array( "name" => "Code and Optimization Settings",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Before &lt;/head&gt; Tag",
	"id" => $shortname."_code_before_head",
	"placeholder" => esc_attr__( 'Add custom code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "After &lt;body&gt; Tag",
	"id" => $shortname."_code_after_body",
	"placeholder" => esc_attr__( 'Add custom code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "Before &lt;/body&gt; Tag",
	"id" => $shortname."_code_before_body",
	"placeholder" => esc_attr__( 'Add custom code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "Optimize Site Speed",
	"id" => $shortname."_minify_optimize",
	"placeholder" => esc_attr__( 'Check this to optimize site speed to its maximum performance.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "type" => "close"),

// Header Settings
array( "name" => "Header Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Header Logo",
	"id" => $shortname."_header_logo",
	"placeholder" => esc_attr__( 'Add header logo here (186x76px). Leave blank to display default image.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Header Logo @2x",
	"id" => $shortname."_header_logo_hq",
	"placeholder" => esc_attr__( 'Add header logo here (372x152px). Add @2x at its name: mylogo@2x.png', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Headhesive Logo",
	"id" => $shortname."_headhesive_logo",
	"placeholder" => esc_attr__( 'Add headhesive logo here (100x41px). Leave blank to display default image.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Headhesive Logo @2x",
	"id" => $shortname."_headhesive_logo_hq",
	"placeholder" => esc_attr__( 'Add header logo here (200x82px). Add @2x at its name: mylogo@2x.png', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),

array( "name" => "Header Tag Lines Title",
	"id" => $shortname."_tag_lines_title",
	"placeholder" => esc_attr__( 'Enter your header tag lines title.', 'wise-blog' ),
	"type" => "text",
	"def" => ""),
	
array( "name" => "Header Tag Lines Span",
	"id" => $shortname."_tag_lines_span",
	"placeholder" => esc_attr__( 'Enter your header tag lines span.', 'wise-blog' ),
	"type" => "text",
	"def" => ""),
	
array( "name" => "Header Tag Lines Link",
	"id" => $shortname."_tag_lines_links",
	"placeholder" => esc_attr__( 'Enter your header tag lines links.', 'wise-blog' ),
	"type" => "text",
	"def" => ""),
	
array( "name" => "Custom Login Form Logo",
	"id" => $shortname."_login_image_url",
	"placeholder" => esc_attr__( 'Add custom login form logo here, from 186x76px. Leave blank to display default image.', 'wise-blog' ),
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Disable Top Header",
	"id" => $shortname."_top_header",
	"placeholder" => esc_attr__( 'Check this to disable the entire top header.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Disable Secondary Menu",
	"id" => $shortname."_secondary_menu",
	"placeholder" => esc_attr__( 'Check this to remove the secondary header from top header.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Disable Login/Register Links",
	"id" => $shortname."_login",
	"placeholder" => esc_attr__( 'Check this to remove the login or register links from top header.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "name" => "Disable Header Date",
	"id" => $shortname."_date_header",
	"placeholder" => esc_attr__( 'Check this to remove header date from top header.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Disable Headhesive Menu",
	"id" => $shortname."_headhesive",
	"placeholder" => esc_attr__( 'Check this to disable headhesive menu.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "type" => "close"),

// Archive and Content Settings
array( "name" => "Archive and Content Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Posts Layout Type",
	"id" => $shortname."_posts_layout",
	"placeholder" => esc_attr__( 'Select Posts Layout Type (Leave blank for defaults)', 'wise-blog' ),
	"type" => "select",
	"options" => array("", "grid"),
	"def" => ""),
	
array( "name" => "Time Format for Posts and Comments",
	"id" => $shortname."_date_format",
	"placeholder" => esc_attr__( 'Select Time Format', 'wise-blog' ),
	"type" => "select",
	"options" => array("human readable", "default format"),
	"def" => ""),
	
array( "name" => "Disable Date on Posts",
	"id" => $shortname."_disable_post_date",
	"placeholder" => esc_attr__( 'Check this to disable date on posts.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Disable Author Info on Posts",
	"id" => $shortname."_disable_author_posts",
	"placeholder" => esc_attr__( 'Check this to disable Author Biography for single posts.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Affiliates Auto Disclaimer",
	"id" => $shortname."_aff_disclaimer",
	"placeholder" => esc_attr__( 'Enter your affiliate disclaimer here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),

array( "name" => "Enable Affiliates Disclaimer to Top Posts",
	"id" => $shortname."_enable_aff_top",
	"placeholder" => esc_attr__( 'Check this to enable affiliates disclaimer to top post. If uncheck it will show at the bottom of post.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
		
array( "type" => "close"),

// Ads for Posts Settings
array( "name" => "Ads for Posts Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Top Post",
	"id" => $shortname."_top_post",
	"placeholder" => esc_attr__( 'Enter your Ads code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),

array( "name" => "Middle Post",
	"id" => $shortname."_middle_post",
	"placeholder" => esc_attr__( 'Enter your Ads code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "Bottom Post 1",
	"id" => $shortname."_bottom_post_1",
	"placeholder" => esc_attr__( 'Enter your Ads code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "Bottom Post 2",
	"id" => $shortname."_bottom_post_2",
	"placeholder" => esc_attr__( 'Enter your Ads code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),
	
array( "name" => "Bottom Post 3",
	"id" => $shortname."_bottom_post_3",
	"placeholder" => esc_attr__( 'Enter your Ads code here.', 'wise-blog' ),
	"type" => "textarea",
	"def" => ""),

array( "type" => "close"),

// Social Media Settings
array( "name" => "Social Media Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "RSS Link",
	"placeholder" => esc_attr__( 'Enter RSS URL.', 'wise-blog' ),
	"id" => $shortname."_soc_rss_links",
	"type" => "text",
	"def" => ""),
	
array( "name" => "Facebook Link",
	"placeholder" => esc_attr__( 'Enter Facebook URL.', 'wise-blog' ),
	"id" => $shortname."_soc_fb_links",
	"type" => "text",
	"def" => ""),

array( "name" => "Twitter Link",
	"placeholder" => esc_attr__( 'Enter Twitter URL.', 'wise-blog' ),
	"id" => $shortname."_soc_twitter_links",
	"type" => "text",
	"def" => ""),
	
array( "name" => "Twitter Account Name for Share Buttons",
	"placeholder" => esc_attr__( 'Enter Twitter Account Name.', 'wise-blog' ),
	"id" => $shortname."_twitter_acc",
	"type" => "text",
	"def" => ""),

array( "name" => "Google Plus Link",
	"placeholder" => esc_attr__( 'Enter Facebook URL.', 'wise-blog' ),
	"id" => $shortname."_soc_gplus_links",
	"type" => "text",
	"def" => ""),
	
array( "name" => "YouTube Link",
	"placeholder" => esc_attr__( 'Enter Youtube URL.', 'wise-blog' ),
	"id" => $shortname."_soc_yt_links",
	"type" => "text",
	"def" => ""),
	
array( "type" => "close"),

// Security Settings
array( "name" => "Security Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Disable Error Details for Login Form",
	"id" => $shortname."_disable_error_details",
	"placeholder" => esc_attr__( 'Check this to display error details in login form.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "name" => "Enable Google reCAPTCHA for Login Form",
	"id" => $shortname."_enable_login_reCAPTCHA",
	"placeholder" => esc_attr__( 'Check this to enable Google reCAPTCHA in login form.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Enable Google reCAPTCHA for Registration Form",
	"placeholder" => esc_attr__( 'Check this to enable Google reCAPTCHA in registration form.', 'wise-blog' ),
	"id" => $shortname."_enable_registration_reCAPTCHA",
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Enable Google reCAPTCHA for Comment Form",
	"placeholder" => esc_attr__( 'Check this to enable Google reCAPTCHA in comment form.', 'wise-blog' ),
	"id" => $shortname."_enable_comment_reCAPTCHA",
	"type" => "checkbox",
	"def" => ""),

array( "name" => "Google reCAPTCHA Site Key",
	"id" => $shortname."_captcha_sitekey",
	"placeholder" => esc_attr__( 'Enter your Google reCAPTCHA site key.', 'wise-blog'),
	"type" => "text",
	"def" => ""),
	
array( "name" => "Google reCAPTCHA Secret Key",
	"id" => $shortname."_captcha_secretkey",
	"placeholder" => esc_attr__( 'Enter your Google reCAPTCHA secret key.', 'wise-blog'),
	"type" => "text",
	"def" => ""),
	
array( "type" => "close"),

// WooCommerce Settings
array( "name" => "WooCommerce Settings",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Shop Site Title",
	"placeholder" => esc_attr__( 'Change your shop site title.', 'wise-blog' ),
	"id" => $shortname."_woo_shop_title",
	"type" => "text",
	"def" => ""),
	
array( "name" => "Product Category Base",
	"placeholder" => esc_attr__( 'Please change your permalinks to /%category%/%postname%/ or /%postname%/', 'wise-blog' ),
	"id" => $shortname."_custom_woo_shop_links",
	"type" => "text",
	"def" => ""),
	
array( "name" => "Number of products to show on archive",
	"placeholder" => esc_attr__( 'Set the number of products to display on product archive.', 'wise-blog' ),
	"id" => $shortname."_woo_archive_num",
	"type" => "text",
	"def" => ""),
	
array( "name" => "Product Archive Layout Type",
	"id" => $shortname."_prod_layout",
	"type" => "select",
	"placeholder" => esc_attr__( 'Select Product Layout Type (Leave blank to disable it)', 'wise-blog' ),
	"options" => array("", "grid"),
	"def" => ""),
	
array( "type" => "close"),
	
// Footer Settings
array( "name" => "Footer Settings",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Choose Footer Style",
	"id" => $shortname."_footer_style",
	"type" => "select",
	"placeholder" => esc_attr__( 'Select Footer Style', 'wise-blog' ),
	"options" => array("widgetized", "single"),
	"def" => ""),
	
array( "name" => "Disable Footer Social Icons",
	"id" => $shortname."_disable_footericons",
	"placeholder" => esc_attr__( 'Check this to disable footer social icons.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Disable Footer Menu",
	"id" => $shortname."_disable_footermenu",
	"placeholder" => esc_attr__( 'Check this to disable footer menu.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "name" => "Disable Footer About Logo",
	"id" => $shortname."_footer_about_logo",
	"placeholder" => esc_attr__( 'Check this to disable footer logo from about widget.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),

array( "name" => "Disable Footer Logo",
	"id" => $shortname."_footer_logo",
	"placeholder" => esc_attr__( 'Check this to disable footer logo.', 'wise-blog' ),
	"type" => "checkbox",
	"def" => ""),
	
array( "name" => "Footer Logo URL",
	"placeholder" => esc_attr__( 'Add footer logo URL here (49x20px). Leave blank to display default image.', 'wise-blog' ),
	"id" => $shortname."_footer_logo_url",
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Footer Logo URL @2x",
	"placeholder" => esc_attr__( 'Add footer logo here (98x40px). Add @2x at its name: mylogo@2x.png', 'wise-blog' ),
	"id" => $shortname."_footer_logo_url_hq",
	"type" => "upload",
	"def" => ""),
	
array( "name" => "Footer Text",
	"placeholder" => esc_attr__( 'Add your footer text here.', 'wise-blog' ),
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"def" => ""),

array( "type" => "close")
);

// End Wise Panel Options