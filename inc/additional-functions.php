<?php
/*
* Additional Functions
*
*/

/*--------------------------------------------------------------
-----TABLE OF CONTENTS------------------------------------------
----------------------------------------------------------------
1. Pagination
2. Single Post Navigation
3. Meta Data for Date, Time, and Author
	3.1 Date and Time Meta
	3.2 Author Meta
4. Comments
5. Get The Child Category
6. Get Categories Info
7. Get Tags Info
8. Excerpt Properties
9. Popular Posts Count
10. Custom Page Links
11. Get Category Slug from ID
12. Customize Password Protected Fields
13. Breadcrumbs
14. Custom Admin Login Form
15. WordPress Customizer
16. Add Categories and Tags to Pages
17. Add Excerpt Features to Pages
18. Disable Automatic Image Sizes Thumbnail
19. CSS and JavaScript Minifier
20. Custom Code
21. Remove Version Query String
22. WooCommerce Functions
	22.1 Added WooCommerce Support
	22.2 Number of products to display in archives
	22.3 Custom Demo Store Notice (Display only in shop)
	22.4 Add Share Buttons
	22.5 Woocommerce Parent Category and Link
	22.6 Custom Post Type Labels
	22.7 Customize Breadcrumbs
	22.8 Revert Default Lost Password Form
	22.9 No. of Related Products to Display
23. Remove Default bbPress Style
24. Remove WordPress Unecessary Tags and Function
25. Google reCAPTCHA
26. Custom Comment List, Date Format
27. Panel Fields
28. Add Items to Menus
29. Redirect Attachment URL to Parent Post
30. Ads Functionalities
	30.1 Enable or Disable Ads on Specific Post or Page
	30.2 Ads Conditionals
	30.3 Single Content with Ads
31. Color and Font Customizations
32. Wise prettyPhoto Lightbox
33. Google Fonts
	33.1 700+ Google Fonts
	33.2 Google Fonts Settings
34. Affiliates Auto Disclaimer
	34.1 Enable or Disable Affiliates Disclaimer on Specific Post or Page
	34.2 Display Affiliates Disclaimer
35. Featured Homepage Posts
36. Video Fix Embed
37. Navigation Menus
	37.1 Headhesive Menu
	37.2 Main Menu
	37.3 Secondary Menu
	37.4 Responsive Main Menu
	37.5 Responsive Secondary Menu
	37.6 Footer Menu
38. Social Menus
	38.1 Headhesive Social Menu
	38.2 Main Social Menu
	38.3 Footer Social Menu
39. Preloader
40. Featured Homepage Posts
--------------------------------------------------------------*/

/*--------------------------------------------------------------
1. Pagination
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_paging_nav' ) ) :
	function wise_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_attr__( 'Previous', 'wise-blog' ),
			'next_text' => esc_attr__( 'Next', 'wise-blog' ),
			'type'      => 'list',
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation">
			<span class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'wise-blog' ); ?></span>
				<?php echo wp_kses_post($links); ?>
		</nav><!-- .navigation -->
		<?php
		endif;
	}
endif;

/*--------------------------------------------------------------
2. Single Post Navigation
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_single_post_nav' ) ) :
	function wise_single_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation">
			<div class="post-nav-wrapper">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wise-blog' ); ?></h2>
				<div class="nav-links">
					<?php
						previous_post_link( '<div class="nav-previous"><div class="nav-indicator">' . esc_html__( 'Previous Post', 'wise-blog' ) . '</div><h4>%link</h4></div>', '%title' );
						next_post_link(     '<div class="nav-next"><div class="nav-indicator">' . esc_html__( 'Next Post', 'wise-blog' ) . '</div><h4>%link</h4></div>', '%title' );
					?>
				</div><!-- .nav-links -->
			</div>
		</nav><!-- .navigation -->
		<?php
	}
endif;

/*--------------------------------------------------------------
3. Meta Data for Date, Time, and Author
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	3.1 Date and Time Meta
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_posted_on' ) ) :
		function wise_posted_on() {
			if( get_option('wise_disable_post_date') == false) { // If true, disables date on posts
				
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
				
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);
				
				if(get_option('wise_date_format') == 'human readable') {
					
					$wise_times = get_the_time( 'U' );
					
					$posted_on = sprintf(
						human_time_diff( $wise_times, current_time('timestamp') ) . ' ago ',
						esc_html_x( '%s', 'post date', 'wise-blog' ),
						'<a href="' . esc_url( esc_url(get_permalink()) ) . '" rel="bookmark">' . $time_string . '</a>'
					);
				} else {
					$posted_on = sprintf(
						esc_html_x( '%s ', 'post date', 'wise-blog' ), $time_string );
				}

				echo '<span class="posted-on updated">' . wp_kses_post(@$posted_on) . '</span>'; // WPCS: XSS OK.
			
			} else { null; }

		}
	endif;

	/*--------------------------------------------------------------
	3.2 Author Meta
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_posted_by' ) ) :
		function wise_posted_by() {

			$byline = sprintf(
				esc_html_x( 'by %s', 'post author', 'wise-blog' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="byline">' . ' &mdash;' . wp_kses_post($byline) . '</span>'; // WPCS: XSS OK.

		}
	endif;

/*--------------------------------------------------------------
4. Comments
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_comments' ) ) :
	function wise_comments() {	
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-only"><i class="fa fa-comment-o"></i> &nbsp;';
			comments_popup_link( '0', '1', '%' );
			echo '</span>';
		}
	}
	function wise_comments_attributes(){
		return ' data-scroll ';
	}
	add_filter( 'comments_popup_link_attributes', 'wise_comments_attributes' );
endif;

/*--------------------------------------------------------------
5. Get The Child Category
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_parent_cat' ) ) : 
	function wise_parent_cat() {
		
		global $post;

		// Grab all post categories
		$cats = get_the_category($post->ID);

		// Look at the 1st category returned and get its parent. This is the key limitation here, and means that a post with multiple categories that leads to separate parents will return the parent belonging to the 1st category returned.
		$parent = get_category($cats[0]->category_child);

		// Should WP throw an error message, that means we're already on the parent category.
		if (is_wp_error($parent)){
			$cat = get_category($cats[0]);
		} 
		// Otherwise, we set the category we'll be working with to be equal to the parent.
		else{
			$cat = $parent;
		}

		$cat_link = get_category_link($cat);
		$cat_name = $cat->name;
		echo '<a href="' . esc_url($cat_link) . '">' . esc_html($cat_name) . '</a>';

	}
endif;

/*--------------------------------------------------------------
6. Get Categories Info
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_entry_header' ) ) : 
	function wise_entry_header() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( ' &nbsp;' );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'wise-blog' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

/*--------------------------------------------------------------
7. Get Tags Info
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_entry_footer' ) ) : 
	function wise_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '<ul class="tag-list"><li>', '</li><li>', '</li></ul>' );
			if ( $tags_list ) {
				printf( '<div class="tags-links">' . esc_html__( '%1$s', 'wise-blog' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link( esc_html__( 'Edit', 'wise-blog' ), '<span class="edit-link">', '</span>' );
	}
endif;

/*--------------------------------------------------------------
8. Excerpt Properties
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_custom_excerpt_length' ) ) :
	function wise_custom_excerpt_length( $length ) {
		return 20;
	}
	add_filter( 'excerpt_length', 'wise_custom_excerpt_length', 999 );
endif;

if ( ! function_exists( 'wise_new_excerpt_more' ) ) :
	function wise_new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'wise_new_excerpt_more');
endif;

/*--------------------------------------------------------------
9. Popular Posts Count
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_set_post_views' ) ) :
	function wise_set_post_views($postID) {
		$count_key = 'wise_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}
		else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	// To keep the count accurate, lets get rid of prefetching
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
endif;

if ( ! function_exists( 'wise_track_post_views' ) ) :
	// Track which is the most popular
	function wise_track_post_views ($post_id) {
		if ( !is_single() ) return;
		if ( empty ( $post_id) ) {
			global $post;
			$post_id = get_the_ID();    
		}
		wise_set_post_views($post_id);
	}
	add_action( 'wp_head', 'wise_track_post_views');
endif;

if ( ! function_exists( 'wise_get_post_views' ) ) :
	// Post view count
	function wise_get_post_views($postID){
		$count_key = 'wise_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return " 0";
		}
		return '' . esc_attr($count);
	}
endif;

/*--------------------------------------------------------------
10. Custom Page Links
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_custom_wp_link_pages' ) ) :
	function wise_custom_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before' => '<div class="post-navigation-outer"><nav class="post-navigation-wrapper"><ul class="post-pagination">', 
			'after' => '</ul></nav></div>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => esc_html__( 'Next page', 'wise-blog' ),
			'previouspagelink' => esc_html__( 'Previous page', 'wise-blog' ),
			'pagelink' => '%',
			'echo' => 1
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= '<li> ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= _wp_link_page( $i );
					else
						$output .= '<span class="post-pagination current-post-page">';

					$output .= $text_before . $j . $text_after;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</span></li>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo ) {
			echo wp_kses_post($output);
		}
		return $output;
	}
endif;

/*--------------------------------------------------------------
11. Get Category Slug from ID
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_get_cat_slug' ) ) :
	function wise_get_cat_slug($cat_ID) {
		$cat_ID = (int)$cat_ID;
		$category = get_category($cat_ID);
		return $category->slug;
	}
endif;

/*--------------------------------------------------------------
12. Customize Password Protected Fields
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_my_password_form' ) ) :
	function wise_my_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		' . '<p>' . esc_html__( "To view this protected post, enter the password below", 'wise-blog' ) . ':</p>' . '
		<label for="' . esc_attr($label) . '">' . ' </label><input name="post_password" id="' . esc_attr($label) . '" type="password" size="20" maxlength="20" placeholder="' . esc_attr__('Enter Password', 'wise-blog') . '"><input type="submit" name="Submit" value="' . esc_attr__( "Submit", 'wise-blog' ) . '"></form>';
		return $o;
	}
	add_filter( 'the_password_form', 'wise_my_password_form' );
endif;

/*--------------------------------------------------------------
13. Breadcrumbs
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_breadcrumbs' ) ) :
	function wise_breadcrumbs( $args = array() ) {
		// Do not display on the homepage
		if ( is_front_page() ) {
			return;
		}
		// Set default arguments
		$defaults = array(
			'separator_icon'      => '<i class="fa fa-angle-right"></i>',
			'breadcrumbs_id'      => 'breadcrumbs',
			'breadcrumbs_classes' => 'breadcrumb-trail breadcrumbs',
			'home_title'          => 'Home'
		);
		// Parse any arguments added
		$args = apply_filters( 'wise_breadcrumbs_args', wp_parse_args( $args, $defaults ) );
		// Set variable for adding separator markup
		$separator = '<span class="separator"> ' . $args['separator_icon'] . ' </span>';
		// Get global post object
		global $post;
		/* Begin Markup */
		// Open the breadcrumbs
		$html = '<div id="' . esc_attr( $args['breadcrumbs_id'] ) . '" class="' . esc_attr( $args['breadcrumbs_classes']) . '">';
		// Add Homepage link & separator (always present)
		$html .= '<span class="item-home"><a class="bread-link bread-home" href="' . get_home_url('/') . '" title="' . esc_attr( $args['home_title'] ) . '">' . esc_attr( $args['home_title'] ) . '</a></span>';
		$html .= $separator;
		// Post
		if ( is_singular( 'post' ) ) {
			// Get post category info
			$category = get_the_category();
			// Get category values
			$category_values = array_values( $category );
			// Get last category post is in
			$last_category = end( $category_values );
			// Get parent categories
			$cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
			// Convert into array
			$cat_parents = explode( ',', $cat_parents );
			// Loop through parent categories and add to breadcrumb trail
			foreach ( $cat_parents as $parent ) {
				$html .= '<span class="item-cat">' . wp_kses( $parent, wp_kses_allowed_html( 'a' ) ) . '</span>';
				$html .= $separator;
			}
			// add name of Post
			$html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></span>';
		} elseif ( is_singular( 'page' ) ) { // Page
			// if page has a parent page
			if ( $post->post_parent ) {
				// Get all parents
				$parents = get_post_ancestors( $post->ID );
				// Sort parents into the right order
				$parents = array_reverse( $parents );
				// Add each parent to markup
				foreach ( $parents as $parent ) {
					$html .= '<span class="item-parent item-parent-' . esc_attr( $parent ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent ) . '" href="' . get_permalink( $parent ) . '" title="' . get_the_title( $parent ) . '">' . get_the_title( $parent ) . '</a></span>';
					$html .= $separator;
				}
			}
			// Current page
			$html .= '<span class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></span>';
		} elseif ( is_singular( 'attachment' ) ) { // Attachment
			// Get the parent post ID
			$parent_id = $post->post_parent;
			// Get the parent post title
			$parent_title = get_the_title( $parent_id );
			// Get the parent post permalink
			$parent_permalink = get_permalink( $parent_id );
			// Add markup
			$html .= '<span class="item-parent"><a class="bread-parent" href="' . esc_url( $parent_permalink ) . '" title="' . esc_attr( $parent_title ) . '">' . esc_attr( $parent_title ) . '</a></span>';
			$html .= $separator;
			// Add name of attachment
			$html .= '<span class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></span>';
		} elseif ( is_singular() ) { // Custom Post Types
			// Get the post type
			$post_type = get_post_type();
			// Get the post object
			$post_type_object = get_post_type_object( $post_type );
			// Get the post type archive
			$post_type_archive = get_post_type_archive_link( $post_type );
			// Add taxonomy link and separator
			$html .= '<span class="item-cat item-custom-post-type-' . esc_attr( $post_type ) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr( $post_type ) . '" href="' . esc_url( $post_type_archive ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . esc_attr( $post_type_object->labels->name ) . '</a></span>';
			$html .= $separator;
			// Add name of Post
			$html .= '<span class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . $post->post_title . '">' . $post->post_title . '</span></span>';
		} elseif ( is_category() ) { // Category
			// Get category object
			$parent = get_queried_object()->category_parent;
			// If there is a parent category...
			if ( $parent !== 0 ) {
				// Get the parent category object
				$parent_category = get_category( $parent );
				// Get the link to the parent category
				$category_link = get_category_link($parent);
				// Output the markup for the parent category item
				$html .= '<span class="item-parent item-parent-' . esc_attr( $parent_category->slug ) . '"><a class="bread-parent bread-parent-' . esc_attr( $parent_category->slug ) . '" href="' . esc_url( $category_link ) . '" title="' . esc_attr( $parent_category->name ) . '">' . esc_attr( $parent_category->name ) . '</a></span>';
				$html .= $separator;
			}
			// Add category markup
			$html .= '<span class="item-current item-cat"><span class="bread-current bread-cat" title="' . $post->ID . '">' . single_cat_title( '', false ) . '</span></span>';
		} elseif ( is_tag() ) { // Tag
			// Add tag markup
			$html .= '<span class="item-current item-tag"><span class="bread-current bread-tag">' . single_tag_title( '', false ) . '</span></span>';
		} elseif ( is_author() ) { // Author
			// Add author markup
			$html .= '<span class="item-current item-author"><span class="bread-current bread-author">' . get_queried_object()->display_name . '</span></span>';
		} elseif ( is_day() ) { // Day
			// Add day markup
			$html .= '<span class="item-current item-day"><span class="bread-current bread-day">' . get_the_date() . '</span></span>';
		} elseif ( is_month() ) { // Month
			// Add month markup
			$html .= '<span class="item-current item-month"><span class="bread-current bread-month">' . get_the_date( 'F Y' ) . '</span></span>';
		} elseif ( is_year() ) { // Year
			// Add year markup
			$html .= '<span class="item-current item-year"><span class="bread-current bread-year">' . get_the_date( 'Y' ) . '</span></span>';
		} elseif ( is_archive() && is_tax() ) { // Custom Taxonomy
			// get the name of the taxonomy
			$custom_tax_name = get_queried_object()->name;
			// Add markup for taxonomy
			$html .= '<span class="item-current item-archive"><span class="bread-current bread-archive">' . esc_attr($custom_tax_name) . '</span></span>';
		} elseif ( is_search() ) { // Search
			// Add search markup
			$html .= '<span class="item-current item-search"><span class="bread-current bread-search">' . esc_html_e('Search results for: ', 'wise-blog') . get_search_query() . '</span></span>';
		} elseif ( is_404() ) { // 404
			// Add 404 markup
			$html .= '<span>' . esc_html__('Error 404', 'wise-blog') . '</span>';
		} elseif ( is_home() ) { // blog when not on homepage
			$html .= '<span>' . get_the_title( get_option('page_for_posts' ) ) . '</span>';
		}
		// Close breadcrumb container
		$html .= '</div>';
		$html = apply_filters( 'wise_breadcrumbs_filter', $html );
		echo wp_kses_post( $html );
	}
endif;

/*--------------------------------------------------------------
14. Custom Admin Login Form
--------------------------------------------------------------*/
// Custom Login
if ( ! function_exists( 'wise_custom_login' ) ) :
	function wise_custom_login() {
		wp_enqueue_style ( 'wise-login-css', get_template_directory_uri() . '/css/wise-login.css' );
	}
	add_action('login_head', 'wise_custom_login');
endif;

// Custom Logo
if ( ! function_exists( 'wise_login_logo' ) ) :
	if (get_option('wise_login_image_url')==true ) {		
		function wise_login_logo() {
			$login_image_url = get_option('wise_login_image_url');		
			echo '<style>';
			echo 'body.login h1 a { background-image: url("' . esc_url($login_image_url) . '"); }';
			echo '</style>';
		}		
		add_action( 'login_head', 'wise_login_logo' );	
	} else {		
		function wise_login_logo() {
			$def_login_image_url = get_template_directory_uri() . '/img/header_img@2x.png';
			echo '<style>';
			echo 'body.login h1 a { background-image: url("' . esc_url($def_login_image_url) . '"); }';
			echo '</style>';
		}
		add_action( 'login_head', 'wise_login_logo' );
	}	
endif;

// Logo Links URL
if ( ! function_exists( 'wise_login_logo_url' ) ) :
	function wise_login_logo_url() {
		return esc_url( home_url('/') );
	}
	add_filter( 'login_headerurl', 'wise_login_logo_url' );
endif;

// Logo title
if ( ! function_exists( 'wise_login_logo_url_title' ) ) :
	function wise_login_logo_url_title() {
		return get_bloginfo('name');
	}
	add_filter( 'login_headertitle', 'wise_login_logo_url_title' );
endif;

// Login Credentials
$login_details = get_option('wise_disable_error_details');
if ( ! function_exists( 'wise_login_error_override' ) && $login_details==true ) :
	function wise_login_error_override()
	{
		return 'Incorrect details.';
	}
	add_filter('login_errors', 'wise_login_error_override');
endif;

// Login Redirection
if ( ! function_exists( 'wise_admin_login_redirect' ) ) :
	function wise_admin_login_redirect( $redirect_to, $request, $user ) {
		global $user;
		if( isset( $user->roles ) && is_array( $user->roles ) ) {
			if( in_array( "administrator", $user->roles ) ) {
				return $redirect_to;
			} else {
				return home_url('/'); }
		}
		else {
		return $redirect_to; }
	}
	add_filter("login_redirect", "wise_admin_login_redirect", 10, 3);
endif;

/*--------------------------------------------------------------
15. WordPress Customizer
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_customize_register' ) ) :
	function wise_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
	add_action( 'customize_register', 'wise_customize_register' );
endif;

if ( ! function_exists( 'wise_customize_preview_js' ) ) :
	function wise_customize_preview_js() {
		wp_enqueue_script( 'wise_customizer', get_template_directory_uri() . '/js/all-settings.js', array( 'customize-preview' ), '20130508', true );
	}
	add_action( 'customize_preview_init', 'wise_customize_preview_js' );
endif;

if ( ! function_exists( 'wise_body_classes' ) ) :
	function wise_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		return $classes;
	}
	add_filter( 'body_class', 'wise_body_classes' );
endif;

/*--------------------------------------------------------------
16. Add Categories and Tags to Pages
--------------------------------------------------------------*/
class wise_page_dynamic{

  function __construct(){

    add_action( 'init', array( $this, 'wise_taxonomies_for_pages' ) );

    /**
     * Want to make sure that these query modifications don't
     * show on the admin side or we're going to get pages and
     * posts mixed in together when we click on a term
     * in the admin
     *
     */
    if ( ! is_admin() ) {
      add_action( 'pre_get_posts', array( $this, 'wise_category_archives' ) );
      add_action( 'pre_get_posts', array( $this, 'wise_tag_archives' ) );
    } // ! is_admin

  } // __construct

  /**
   * Registers the taxonomy terms for the post type
   *
   *
   * @uses register_taxonomy_for_object_type
   */
  function wise_taxonomies_for_pages() {
      register_taxonomy_for_object_type( 'post_tag', 'page' );
      register_taxonomy_for_object_type( 'category', 'page' );
  } // wise_taxonomies_for_pages

  /**
   * Includes the tags in archive pages
   *
   * Modifies the query object to include pages
   * as well as posts in the items to be returned
   * on archive pages
   *
   */
  function wise_tag_archives( $wp_query ) {

    if ( $wp_query->get( 'tag' ) )
      $wp_query->set( 'post_type', 'any' );

  } // end wise_tag_archives

  /**
   * Includes the categories in archive pages
   *
   * Modifies the query object to include pages
   * as well as posts in the items to be returned
   * on archive pages
   *
   */
  function wise_category_archives( $wp_query ) {

    if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
      $wp_query->set( 'post_type', 'any' );

  } // end wise_category_archives

} // end wise_page_dynamic

$wise_page_dynamic = new wise_page_dynamic();

/*--------------------------------------------------------------
17. Add Excerpt Features to Pages
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_add_excerpts_to_pages' ) ) :
	function wise_add_excerpts_to_pages() {
		 add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'wise_add_excerpts_to_pages' );
endif;

/*--------------------------------------------------------------
18. Disable Automatic Image Sizes Thumbnail
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_filter_image_sizes' ) ) :
	function wise_filter_image_sizes( $sizes) {
	 
	unset( $sizes['medium']);
	unset( $sizes['large']);
	 
	return $sizes;
	}
	add_filter('intermediate_image_sizes_advanced', 'wise_filter_image_sizes');
endif;

/*--------------------------------------------------------------
19. CSS and JavaScript Minifier
**	@by Probewise
**	@Dynamic minification of CSS and Scripts
--------------------------------------------------------------*/
function wise_minify($wiseminify) {
	$wiseminify = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $wiseminify);
	$wiseminify = str_replace(': ', ':', $wiseminify);
	$wiseminify = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $wiseminify);
	return $wiseminify;
}

/*--------------------------------------------------------------
20. Custom Code
--------------------------------------------------------------*/
function wise_code_before_head() {
	$wise_before_head = get_option('wise_code_before_head');
	
	if($wise_before_head != null) :
		echo $wise_before_head; // no need for escape, it is filtered in wise panel like WordPress text widget
	endif;
}

function wise_code_after_body() {
	$wise_after_body = get_option('wise_code_after_body');
	
	if($wise_after_body != null) :
		echo $wise_after_body; // no need for escape, it is filtered in wise panel like WordPress text widget
	endif;
}

function wise_code_before_body() {
	$wise_before_body = get_option('wise_code_before_body');
	
	if($wise_before_body != null) :
		echo $wise_before_body; // no need for escape, it is filtered in wise panel like WordPress text widget
	endif;
}

/*--------------------------------------------------------------
21. Remove Version Query String
--------------------------------------------------------------*/
if ( get_option('wise_minify_optimize') == true ) {
	if ( ! function_exists( 'wise_remove_script_version' ) ) :
		function wise_remove_script_version( $src ){
			$parts = explode( '&ver', $src );
			return $parts[0];
		}
		add_filter( 'script_loader_src', 'wise_remove_script_version', 15, 1 );
		add_filter( 'style_loader_src', 'wise_remove_script_version', 15, 1 );
	endif;

	if ( ! function_exists( 'wise_remove_script_version1' ) ) :
		function wise_remove_script_version1( $src ){
			$parts = explode( '?ver', $src );
			return $parts[0];
		}
		add_filter( 'script_loader_src', 'wise_remove_script_version1', 15, 1 );
		add_filter( 'style_loader_src', 'wise_remove_script_version1', 15, 1 );
	endif;
}

/*--------------------------------------------------------------
22. WooCommerce Functions
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	22.1 Added WooCommerce Support
	--------------------------------------------------------------*/
	add_action( 'after_setup_theme', 'wise_woocommerce_support' );
	function wise_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	/*--------------------------------------------------------------
	22.2 Number of products to display in archives
	--------------------------------------------------------------*/
	add_filter( 'loop_shop_per_page', function ( $cols ) { // $cols contains default products per page
		$wise_woo_num = get_option( 'wise_woo_archive_num' );
		return $wise_woo_num; // returns to your desired number of products to display
	}, 20 );

	/*--------------------------------------------------------------
	22.3 Custom Demo Store Notice (Display only in shop)
	--------------------------------------------------------------*/
	if ( !function_exists( 'wise_woocommerce_demo_store' ) ) {
		function wise_woocommerce_demo_store() {
			if ( get_option( 'woocommerce_demo_store_notice' ) == null ) {
				return; }

			$notice = get_option( 'woocommerce_demo_store_notice' );
			if ( function_exists('is_woocommerce') && is_woocommerce() && $notice != null && is_store_notice_showing() ) {
				echo apply_filters( 'woocommerce_demo_store', '<div class="alert"><p class="demo_store">' . wp_kses_post($notice) . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p></div>'  ); }
			else {
				echo apply_filters( 'woocommerce_demo_store', '<p class="demo_store" style="display:none;">' . wp_kses_post($notice) . '</p>'  ); }
			}
	}
	
	remove_action( 'wp_footer', 'woocommerce_demo_store' );
	add_action( 'wp_footer', 'wise_woocommerce_demo_store' ); // move notice to footer

	/*--------------------------------------------------------------
	22.4 Add Share Buttons
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_wooshare' ) ) :
		function wise_wooshare() {
			echo '<div class="share-entry-meta">';
			echo get_template_part('templates/custom-social');
			echo '</div><!-- Custom Social -->';
		}
		add_action('woocommerce_share','wise_wooshare');
	endif;

	/*--------------------------------------------------------------
	22.5 Woocommerce Parent Category and Link
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_woo_cat' ) ) :
		function wise_woo_cat() {
			global $post;
			$product_category = wp_get_post_terms( $post->ID, 'product_cat' );				
			foreach( $product_category as $cat ):
				if( 0 == $cat->parent )
					$term_link = get_term_link($cat);
				if ( is_wp_error( $term_link ) ) {
					continue;
				}
					echo '<a href="' . esc_url( $term_link ) . '">' . esc_html($cat->name) . '</a>';
			endforeach;
		}
	endif;

	/*--------------------------------------------------------------
	22.6 Custom Post Type Labels
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_woo_custom_post_type' ) ) :
		function wise_woo_custom_post_type( $args ){
			if(get_option('wise_custom_woo_shop_links') == true) {
				$custom_woo_shop_links = get_option( 'wise_custom_woo_shop_links' ); 
			}
			else {
				$custom_woo_shop_links = 'product';
			}
			$product_permalink = empty( $permalinks['product_base'] ) ? esc_attr( $custom_woo_shop_links, 'slug', 'wise-blog' ) : $permalinks['product_base'];
			$custom_woo_name = get_option( 'wise_woo_shop_title' );
			$labels = array(
			'name' 					=> esc_attr( $custom_woo_name, 'wise-blog' ),
			'singular_name'         => esc_attr__( 'Product', 'wise-blog' ),
			'menu_name'             => esc_attr_x( 'Products', 'Admin menu name', 'wise-blog' ),
			'add_new'               => esc_attr__( 'Add Product', 'wise-blog' ),
			'add_new_item'          => esc_attr__( 'Add New Product', 'wise-blog' ),
			'edit'                  => esc_attr__( 'Edit', 'wise-blog' ),
			'edit_item'             => esc_attr__( 'Edit Product', 'wise-blog' ),
			'new_item'              => esc_attr__( 'New Product', 'wise-blog' ),
			'view'                  => esc_attr__( 'View Product', 'wise-blog' ),
			'view_item'             => esc_attr__( 'View Product', 'wise-blog' ),
			'search_items'          => esc_attr__( 'Search Products', 'wise-blog' ),
			'not_found'             => esc_attr__( 'No Products found', 'wise-blog' ),
			'not_found_in_trash'    => esc_attr__( 'No Products found in trash', 'wise-blog' ),
			'parent'                => esc_attr__( 'Parent Product', 'wise-blog' ),
			'featured_image'        => esc_attr__( 'Product Image', 'wise-blog' ),
			'set_featured_image'    => esc_attr__( 'Set product image', 'wise-blog' ),
			'remove_featured_image' => esc_attr__( 'Remove product image', 'wise-blog' ),
			'use_featured_image'    => esc_attr__( 'Use as product image', 'wise-blog' ),
			);
			 
			$args['labels'] = $labels;
			$args['description'] = esc_html__( 'This is where you can add new products to your store.', 'wise-blog' );
			$args['rewrite'] = $product_permalink ? array( 'slug' => untrailingslashit( $product_permalink ), 'with_front' => false, 'feeds' => true ) : false;
			return $args;
		}
		add_filter( 'woocommerce_register_post_type_product', 'wise_woo_custom_post_type' );
	endif;

	/*--------------------------------------------------------------
	22.7 Customize Breadcrumbs
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_woo_breadcrumbs' ) ) :
		function wise_woo_breadcrumbs() {
			return array(
					'delimiter'   => ' <i class="fa fa-angle-right"></i> ',
					'wrap_before' => '<div id="breadcrumbs">',
					'wrap_after'  => '</div>',
					'before'      => '',
					'after'       => '',
					'home'        => esc_html_x( 'Home', 'breadcrumb', 'wise-blog' ),
				);
		}
		add_filter( 'woocommerce_breadcrumb_defaults', 'wise_woo_breadcrumbs' );
	endif;
	
	/*--------------------------------------------------------------
	22.8 Revert Default Lost Password Form
	--------------------------------------------------------------*/
	if ( !function_exists('is_woocommerce') ) :
		function wise_revert_lost_url() {
			$homeURL = esc_url( home_url('/') );
			return $homeURL . "wp-login.php?action=lostpassword";
		}
		add_filter( 'lostpassword_url',  'wise_revert_lost_url', 11, 0 );
	endif;
	
	/*--------------------------------------------------------------
	22.9 No. of Related Products to Display
	--------------------------------------------------------------*/
	if ( !function_exists('wise_related_products_limit') ) :
		function wise_related_products_limit() {
			global $product;
			$args['posts_per_page'] = 3;
			return $args;
		}
	endif;
	
	if ( !function_exists('wise_related_products_args') ) :
		function wise_related_products_args( $args ) {
			$args['posts_per_page'] = 3; // 3 related products
			// $args['columns'] = 2; // arranged in 2 columns
			return $args;
		}
		add_filter( 'woocommerce_output_related_products_args', 'wise_related_products_args' );
	endif;

/*--------------------------------------------------------------
23. Remove Default bbPress Style
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_deregister_bbpress_styles' ) ) :
	function wise_deregister_bbpress_styles() {
		wp_deregister_style( 'bbp-default' );
	}
	add_action( 'wp_print_styles', 'wise_deregister_bbpress_styles', 15 );
endif;

/*--------------------------------------------------------------
24. Remove WordPress Unecessary Tags and Function
--------------------------------------------------------------*/
/* Removes RSD, XMLRPC, WLW, WP Generator, ShortLink and Comment Feed links */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action('wp_head', 'feed_links_extra', 3 );

/* Removes prev and next article links */
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

/* Avoid URL Guessing */
if ( ! function_exists( 'stop_guessing' ) ) :
	function wise_stop_guessing($url) {
	 if (is_404()) {
	   return false;
	 }
	 return $url;
	}
	add_filter('redirect_canonical', 'wise_stop_guessing');
endif;

/*--------------------------------------------------------------
25. Google reCAPTCHA
--------------------------------------------------------------*/
$captlogin = get_option('wise_enable_login_reCAPTCHA');
$captregister = get_option('wise_enable_registration_reCAPTCHA');
$captcomment = get_option('wise_enable_comment_reCAPTCHA');
if(($captlogin || $captregister || $captcomment)==true ) :
	// Add reCAPTCHA script
	function wise_reCAPTCHA_script() {
		$google_api_url = 'https://www.google.com/recaptcha/api.js';
		echo '<script src="' . esc_url($google_api_url) . '" async defer></script>';
	}
	// to header of login page
	add_action( 'login_enqueue_scripts', 'wise_reCAPTCHA_script' );

	// to header of the main page
	add_action( 'wp_head', 'wise_reCAPTCHA_script' );

	// Output form
	function show_captcha() {
		$data_sitekey = get_option('wise_captcha_sitekey');
		echo '<div class="g-recaptcha" style="display:table; margin: auto;" data-sitekey="' . esc_attr($data_sitekey) . '"></div>';
	}

	/**
	 * Verify CAPTCHA challenge by sending GET request
	 *
	 * @return bool
	 */
	function wise_verify_captcha() {

		$response = isset( $_POST['g-recaptcha-response'] ) ? esc_attr( $_POST['g-recaptcha-response'] ) : '';

		$remote_ip = $_SERVER["REMOTE_ADDR"];

		// create a GET request to the Google reCAPTCHA Server
		$data_secretkey = get_option('wise_captcha_secretkey');
		$request = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $data_secretkey . '&response=' . $response . '&remoteip=' . $remote_ip );

		// retrieve the request from the response body
		$response_body = wp_remote_retrieve_body( $request );

		$result = json_decode( $response_body, true );

		return $result['success'];
	}
endif; // End reCAPTCHA initialization

if($captlogin==true) :
	// reCAPTCHA for login form
	add_action( 'login_form', 'show_captcha' );

	// reCAPTCHA authentication for login form
	add_action( 'wp_authenticate_user', 'wise_validate_captcha', 10, 2 );

	/**
	 * reCAPTCHA verification for login form
	 *
	 * @param $user string login username
	 * @param $password string login password
	 *
	 * @return WP_Error|WP_user
	 */
	function wise_validate_captcha( $user, $password ) {
		if ( isset( $_POST['g-recaptcha-response'] ) && !wise_verify_captcha() ) {
			return new WP_Error( 'empty_captcha', '<strong>ERROR</strong>: Please try reCAPTCHA again!' );
		}
		return $user;
	}
endif; // End login form

if($captregister==true) :
	// reCAPTCHA for registration form
	add_action( 'register_form', 'show_captcha' );

	// reCAPTCHA authentication for registration form
	add_action( 'registration_errors', 'wise_validate_captcha_registration_field', 10, 3 );

	/**
	 * reCAPTCHA verification for registration form
	 *
	 * @param $user string login username
	 * @param $password string login password
	 *
	 * @return WP_Error|WP_user
	 */
	function wise_validate_captcha_registration_field( $errors, $sanitized_user_login, $user_email ) {
		if ( isset( $_POST['g-recaptcha-response'] ) && !wise_verify_captcha() ) {
			$errors->add( 'failed_verification', '<strong>ERROR</strong>: Please try reCAPTCHA again!' );
		}

		return $errors;
	}
endif; // End registration form

if($captcomment==true) :
	// reCAPTCHA for comment form
	add_action( 'comment_form', 'show_captcha' );

	// reCAPTCHA authentication for comment form
	add_filter( 'preprocess_comment', 'wise_validate_captcha_comment_field');

	/**
	 * reCAPTCHA verification for comment form
	 *
	 * @param $commentdata object comment object
	 *
	 * @return object
	 */
	function wise_validate_captcha_comment_field( $commentdata ) {
		global $captcha_error;
		if ( isset( $_POST['g-recaptcha-response'] ) && ! (wise_verify_captcha()) ) {
			$captcha_error = 'failed';
		}
		return $commentdata;
	}

	add_filter( 'comment_post_redirect', 'wise_redirect_fail_captcha_comment', 10, 2 );

	/**
	 * Delete the SPAM from comments
	 * 
	 * Add query string to the comment redirect location
	 *
	 * @param $location string location to redirect to after comment
	 * @param $comment object comment object
	 *
	 * @return string
	 */
	function wise_redirect_fail_captcha_comment( $location, $comment ) {
		global $captcha_error;
		if ( ! empty( $captcha_error ) ) {
			// delete failed comment, set to true: to delete completely, set to false: to move only to trash
			wp_delete_comment( absint( $comment->comment_ID ), true );

			// add failed query string for @parent::show_captcha to display error message
			$location = add_query_arg( 'captcha', 'failed', $location );
			
			// remove the obnoxious comment string i.e comment-15
			$deleted_comment_id = strstr( $location, '#' );
			$location = str_replace( $deleted_comment_id, '#comments', $location );
		}
		return $location;
	}
endif; // End comment form

/*--------------------------------------------------------------
26. Custom Comment List, Date Format
--------------------------------------------------------------*/
if( get_option('wise_date_format' ) == 'human readable') :

	// Modify date format
	function wise_comment_date_format() {
		return human_time_diff(get_comment_time('U'), current_time('timestamp')) . " " . esc_html__('ago', 'wise-blog');
	}
	add_filter( 'get_comment_date', 'wise_comment_date_format' );	

endif; // End conditionals

// Callback function
function wise_comment_settings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo wp_kses_post($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body clear">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php echo '<b class="fn">' . get_comment_author_link() . '</b>' ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wise-blog' ); ?></em>
		<br >
	<?php endif; ?>

	<div class="comment-meta comment-metadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php printf( '<time>%1$s</time>', get_comment_date(),  get_comment_time() ); ?></a><br><?php edit_comment_link( esc_html__( 'Edit', 'wise-blog' ), '  ', '' ); /* translators: 1: date, 2: time, add this to get time: %2$s */ ?>
	</div>

	<div class="comment-content">
	<p><?php comment_text(); ?></p>
	</div>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/*--------------------------------------------------------------
27. Panel Fields
--------------------------------------------------------------*/
function wise_panel_fields() { ?>
	<div class="wise-footer-functions">
		<?php $author_url = 'http://www.probewise.com'; $wise_version = '1.1.3'; $wise_name = 'Wise Blog'; $wise_author = 'Probewise'; ?>
		<div class="wise-help-functions"><p><?php echo esc_html_e( 'Need help? Documentations or support forum may help you.', 'wise-blog' ); ?></p>
			<p><?php esc_html_e( 'Visit our documentation page here:', 'wise-blog' ); ?> <a href="<?php echo esc_url($author_url . '/docs/wise-blog/'); ?>"><?php esc_html_e( 'Wise Blog Documentation', 'wise-blog' ); ?></a></p>
			<p><?php esc_html_e( 'Or post questions here:', 'wise-blog' ); ?> <a href="<?php echo esc_url($author_url . '/support/forum/themes/wise-blog/'); ?>"><?php esc_html_e( 'Probewise Support Forum', 'wise-blog' ); ?></a></p>
		</div>
		<div class="wise-theme-info">
			<p><?php esc_html_e( 'Theme Name:', 'wise-blog' ); ?><?php echo '&nbsp;' . esc_html($wise_name); ?></p>
			<p><?php esc_html_e( 'Version:', 'wise-blog' ); ?> <?php echo esc_html($wise_version); ?></p>
			<p><?php esc_html_e( 'Author:', 'wise-blog' ); ?> <a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($wise_author); ?></a></p>
		</div>
	</div>
<?php }

if( !function_exists('wise_panel_fields_footer') ) :
	function wise_panel_fields_footer() {
		$author_link = 'http://www.probewise.com';
		$author_name = 'Probewise';
		echo '&nbsp;Powered by ' . '<a href="' . esc_url($author_link) . '">' . esc_html($author_name) . '</a>.';
	}
endif;

/*--------------------------------------------------------------
28. Add Items to Menus
--------------------------------------------------------------*/
function wise_primary_menu_item ( $items, $args ) {
    if ( ($args->theme_location == 'primary') || ($args->theme_location == 'woocommerce') || ($args->theme_location == 'bbpress') ) {
		$tag_links = get_option('wise_tag_lines_links');
		$tag_title = get_option('wise_tag_lines_title');
		$added_item_bottom = '<li class="res-close"><a href="#res-nav">' . esc_html__( 'Close Menu', 'wise-blog' ) . ' <i class="fa fa-times"></i></a></li>';
		
		if( ( function_exists('is_woocommerce') && is_woocommerce() ) || function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) : 
			$add_item_top = null;
		else :
			$add_item_top = '<li class="mobile-tag-line"><a href="' . $tag_links . '">' . $tag_title . '</a></li>';
		endif;

		$items = $add_item_top . $items . @$added_item_bottom;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'wise_primary_menu_item', 10, 2 );

function wise_secondary_menu_item ( $items, $args ) {
    if ($args->theme_location == 'secondary') {
        $added_item = '<li class="res-close-top"><a href="#res-nav-top">' . esc_html__( 'Close Menu', 'wise-blog' ) . ' <i class="fa fa-times"></i></a></li>';
		$items = $added_item . $items;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'wise_secondary_menu_item', 10, 2 );

// Fallback for Menu
function wise_menu_message() {
	?><ul>                  
		<li><a href="<?php echo admin_url('nav-menus.php'); ?>"><?php esc_html_e( 'Please add a menu.', 'wise-blog' ); ?></a></li>
	</ul><?php
}
	
/*--------------------------------------------------------------
29. Redirect Attachment URL to Parent Post
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_attachment_redirect' ) ) :
	function wise_attachment_redirect(){
		global $post;
		if ( is_attachment() ) :
			wp_redirect( get_permalink( $post->post_parent ), 301 );
			exit();
		endif;
	}
	add_action( 'template_redirect', 'wise_attachment_redirect' );
endif;

/*--------------------------------------------------------------
30. Ads Functionalities
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	30.1 Enable or Disable Ads on Specific Post or Page
	--------------------------------------------------------------*/
	if ( ! function_exists( 'wise_ads_post' ) ) :
		function wise_ads_post()
		{
			global $post;
			if (get_post_type($post) != 'post' || 'page') {

			$value = get_post_meta($post->ID, 'wise_ads_post', true);
			?>
				<div class="misc-pub-section">
					<label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null); ?> value="1" name="wise_ads_post" /> <?php esc_html_e( 'Disable Ads', 'wise-blog' ); ?></label>
				</div>
			<?php } else { return; }
		}
		add_action( 'post_submitbox_misc_actions', 'wise_ads_post' );
	endif;

	if ( ! function_exists( 'wise_save_ads' ) ) :
		function wise_save_ads($postid) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

			if ( !current_user_can( 'edit_pages', $postid ) ) return false;
			
			if ( !current_user_can( 'edit_posts', $postid ) ) return false;

			if(empty($postid)) return false;

			if(isset($_POST['wise_ads_post'])){
				add_post_meta($postid, 'wise_ads_post', 1, true );
			}
			else{
				delete_post_meta($postid, 'wise_ads_post');
			}
		}
		add_action( 'save_post', 'wise_save_ads');
	endif;

	/*--------------------------------------------------------------
	30.2 Ads Conditionals
	--------------------------------------------------------------*/
	// Top Post Ads
	if ( ! function_exists( 'ads_top_post' ) ) :
		function ads_top_post() {
			if (get_option('wise_top_post') && !is_404() && !is_search() && !is_attachment() ) :
					echo '<div class="ads-layout_top">' . get_option('wise_top_post') . '</div>'; // no need for escape, it is filtered in wise panel like WordPress text widget
			endif;
		}
	endif;

	// Middle Post Ads
	if ( ! function_exists( 'ads_middle_post' ) ) :
		function ads_middle_post() {
			if (get_option('wise_middle_post') && !is_404() && !is_search() && !is_attachment() ) :
				echo '<div class="ads-layout_bottom">' . get_option('wise_middle_post') . '</div>'; // no need for escape, it is filtered in wise panel like WordPress text widget
			endif;
		}
	endif;

	// Bottom Post 1 Ads
	if ( ! function_exists( 'ads_bottom_post_1' ) ) :
		function ads_bottom_post_1() {
			if (get_option('wise_bottom_post_1') && !is_404() && !is_search() && !is_attachment() ) :
				echo '<div class="ads-layout_bottom">' . get_option('wise_bottom_post_1') . '</div>'; // no need for escape, it is filtered in wise panel like WordPress text widget
			endif;
		}
	endif;

	// Bottom Post 2 Ads
	if ( ! function_exists( 'ads_bottom_post_2' ) ) :
		function ads_bottom_post_2() {
			if (get_option('wise_bottom_post_2') && !is_404() && !is_search() && !is_attachment() ) :
				echo '<div class="ads-layout_bottom">' . get_option('wise_bottom_post_2') . '</div>'; // no need for escape, it is filtered in wise panel like WordPress text widget
			endif;
		}
	endif;

	// Bottom Post 3 Ads
	if ( ! function_exists( 'ads_bottom_post_3' ) ) :
		function ads_bottom_post_3() {
			if (get_option('wise_bottom_post_3') && !is_404() && !is_search() && !is_attachment() ) :
				echo '<div class="ads-layout_bottom">' . get_option('wise_bottom_post_3') . '</div>'; // no need for escape, it is filtered in wise panel like WordPress text widget
			endif;
		}
	endif;
	
	/*--------------------------------------------------------------
	30.3 Single Content with Ads
	--------------------------------------------------------------*/
	function wise_cont_ads() {
		global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true);
		$get_cont = get_the_content();
		$wise_content = apply_filters('the_content', $get_cont);
		
		$wise_content = str_replace('</p></blockquote>','</blockquote>', $wise_content);
		
		$wise_content = explode ('</p>', $wise_content);
		$fragments = ceil(count($wise_content) / 2);
		$first_cont = implode(' ', array_slice($wise_content, 0, $fragments));
		$second_cont = implode(' ', array_slice($wise_content, $fragments));
		
		echo $first_cont . ''; // no need for escape, it uses WordPress core function
		if($disable_ads == false) : echo ads_middle_post(); endif;
		echo $second_cont; // no need for escape, it uses WordPress core function
	}

/*--------------------------------------------------------------
31. Color and Font Customizations
--------------------------------------------------------------*/
function wise_customization() {
	// Colors
	$headlinecolor = get_option( 'wise_hline_color' );
	$buttoncolor = get_option( 'wise_button_color' );
	$textcolor = get_option( 'wise_text_color' );
	$linecolor = get_option( 'wise_line_color' );
	
	// Fonts
	$headfonts = get_option('wise_head_fonts');
	$paragfonts = get_option('wise_parag_fonts');
	$metafonts = get_option('wise_meta_fonts');
	$buttonfonts = get_option('wise_button_fonts');
	$navfonts = get_option('wise_nav_fonts');
	$descfonts = get_option('wise_desc_fonts');
	
	$headweight = get_option('wise_head_weight');
	$paragweight = get_option('wise_parag_weight');
	$metaweight = get_option('wise_meta_weight');
	$buttonweight = get_option('wise_button_weight');
	$navweight = get_option('wise_nav_weight');
	$descweight = get_option('wise_desc_weight');
	
	// Background
	$wise_main_back = get_option('wise_mainback');
	$wise_dis_back = get_option('wise_disable_back');
	?>
	<style type="text/css">
		<?php if( ( $headfonts || $paragfonts || $metafonts || $buttonfonts || $navfonts || $descfonts ) != null ) : // Font Settings ?>
			/*--------------------------------------------------------------
			1. Heading Fonts
			--------------------------------------------------------------*/
			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			.page-title-recent {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			.feat-title-content-index-carousel h1 a {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: 700;
			}
			
			.headhesive-tag-lines {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '600'; } ?>;
			}

			.comment-author .fn {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '600'; } ?>;
			}

			.logo-message {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: 400;
			}

			.welcome-message h1,
			.welcome-message-down h1 {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			.carousel-title {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: 700;
			}

			.titles-cover h1 a {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: 700;
			}

			.ctc-single-title {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: 700;
			}

			.ctc-alignleft-side {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			.nav-pills {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			.related h2 {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}
			
			.ctc-button-event {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}
			
			.widget_rss li a {
				font-family: <?php if( $headfonts != null ) { echo esc_attr($headfonts); } else { echo '"Roboto", sans-serif'; } ?>;
				font-weight: <?php if( $headweight != null ) { echo esc_attr($headweight); } else { echo '500'; } ?>;
			}

			/*--------------------------------------------------------------
			2. Paragraph Fonts
			--------------------------------------------------------------*/
			body,
			button,
			input,
			select,
			textarea {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.widget {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.widget-area-left {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.share-count span {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.entry-content blockquote {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.reply, .reply a {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.comment-form {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.comment-awaiting-moderation {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.footer-side {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.menu-footer-menu-container {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			#bbpress-forums div.bbp-topic-author a.bbp-author-name, #bbpress-forums div.bbp-reply-author a.bbp-author-name {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.triple-description p {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.profile-details,
			.profile-details a {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			.site-footer {
				font-family: <?php if( $paragfonts != null ) { echo esc_attr($paragfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $paragweight != null ) { echo esc_attr($paragweight); } else { echo '400'; } ?>;
			}

			/*--------------------------------------------------------------
			3. Input and Meta Fonts
			--------------------------------------------------------------*/
			input,
			select,
			textarea {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			input[type="text"],
			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"],
			textarea {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			input[type="email"],
			input[type="url"],
			input[type="password"],
			input[type="search"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			input[type="search"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.search-form2 input[type="search"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-meta-popular {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.index-cat a{
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-meta-index,
			.entry-meta-index a {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-style: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.top-meta {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.comments-count,
			.comments-count a {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-meta {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-style: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.share-entry-meta {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-content ol > li:before {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			blockquote cite {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-footer {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.comment-metadata,
			.comment-metadata a {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.comment-form textarea {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.comment-form input {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.wp-caption .wp-caption-text {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.gallery-caption {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.subscribe-sidebar input[type="email"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-content input[type="password"],
			.entry-content input[type="text"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.subscribe-footer input[type="email"] {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.top-meta-2 {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			#breadcrumbs, #breadcrumbs .separator,
			.bread-current {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			#bbpress-forums .bbp-forum-info .bbp-forum-content,
			#bbpress-forums p.bbp-topic-meta {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-content #bbpress-forums ol > li:before {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.entry-content .bbp-breadcrumb p {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.quotation-one cite {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			.profile-single {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}
			
			.widget_rss span.rss-date {
				font-family: <?php if( $metafonts != null ) { echo esc_attr($metafonts); } else { echo '"Ubuntu", sans-serif'; } ?>;
				font-weight: <?php if( $metaweight != null ) { echo esc_attr($metaweight); } else { echo '400'; } ?>;
			}

			/*--------------------------------------------------------------
			4. Button Fonts
			--------------------------------------------------------------*/
			a.button-1 {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			a.button-2 {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			a.button-orig {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			.give-btn {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce a.button-orig, .woocommerce button.button, .woocommerce input.button {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}

			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}
			
			.comment-form input.submit {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?>;
			}
			
			div#schat-widget .schat-button {
				font-family: <?php if( $buttonfonts != null ) { echo esc_attr($buttonfonts); } else { echo '"Open Sans", sans-serif'; } ?> !important;
				font-weight: <?php if( $buttonweight != null ) { echo esc_attr($buttonweight); } else { echo '600'; } ?> !important;
			}

			/*--------------------------------------------------------------
			5. Navigation Fonts
			--------------------------------------------------------------*/
			.header-login {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.response-nav ul li {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.headhesive-menu {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.headhesive-social {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.main-navigation {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.site-main .comment-navigation,
			.site-main .paging-navigation,
			.site-main .post-navigation {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.secondary-menu {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.paging-navigation .current {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			.screen-reader-text:focus {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}
			
			.tag-lines {
				font-family: <?php if( $navfonts != null ) { echo esc_attr($navfonts); } else { echo '"Open Sans", sans-serif'; } ?>;
				font-weight: <?php if( $navweight != null ) { echo esc_attr($navweight); } else { echo '600'; } ?>;
			}

			/*--------------------------------------------------------------
			6. Description Fonts
			--------------------------------------------------------------*/
			.taxonomy-description p {
				font-family: <?php if( $descfonts != null ) { echo esc_attr($descfonts); } else { echo '"Raleway", sans-serif'; } ?>;
				font-weight: <?php if( $descweight != null ) { echo esc_attr($descweight); } else { echo '400'; } ?>;
			}
			
			.term-description p {
				font-family: <?php if( $descfonts != null ) { echo esc_attr($descfonts); } else { echo '"Raleway", sans-serif'; } ?>;
				font-weight: <?php if( $descweight != null ) { echo esc_attr($descweight); } else { echo '400'; } ?>;
			}

			.welcome-message p,
			.welcome-message-down p {
				font-family: <?php if( $descfonts != null ) { echo esc_attr($descfonts); } else { echo '"Raleway", sans-serif'; } ?>;
				font-weight: <?php if( $descweight != null ) { echo esc_attr($descweight); } else { echo '400'; } ?>;
			}

			.quotation-one p {
				font-family: <?php if( $descfonts != null ) { echo esc_attr($descfonts); } else { echo '"Raleway", sans-serif'; } ?>;
				font-weight: <?php if( $descweight != null ) { echo esc_attr($descweight); } else { echo '400'; } ?>;
			}

			.tab-sermon .tab-content .ctf-audio span.ctf-audio-title {
				font-family: <?php if( $descfonts != null ) { echo esc_attr($descfonts); } else { echo '"Raleway", sans-serif'; } ?>;
				font-weight: <?php if( $descweight != null ) { echo esc_attr($descweight); } else { echo '400'; } ?>;
			}
		<?php endif; // End Font Settings ?>
		
		<?php if( ( $headlinecolor || $buttoncolor || $textcolor || $linecolor ) != null ) : // Color Settings ?>
			/*--------------------------------------------------------------
			1. Header Lines
			--------------------------------------------------------------*/
			.header-wrapper {
				border-bottom: 9px solid <?php if( $headlinecolor != null ) { echo esc_attr($headlinecolor); } else { echo '#555'; } ?>;
			}

			.headhesive {
				border-bottom: 5px solid <?php if( $headlinecolor != null ) { echo esc_attr($headlinecolor); } else { echo '#555'; } ?>;
			}

			/*--------------------------------------------------------------
			2. Buttons and Tabs
			--------------------------------------------------------------*/
			a.button-2:hover,
			a.button-2:active,
			a.button-2:focus {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			a.button-orig:hover,
			a.button-orig:active,
			a.button-orig:focus {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.res-button a:hover,
			.res-button a.active,
			.res-button a:visited,
			.res-button-top a:hover,
			.res-button-top a.active,
			.res-button-top a:visited {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.search-icon2 a:hover, 
			.search-icon2 a.active {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.cd-top:hover {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.no-touch .cd-top:hover {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			#sc_chat_box .sc-chat-wrapper .sc-start-chat-btn > a:hover {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.bbp-login-form .bbp-login-links a:hover {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			#bbpress-forums a:hover {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.bbp-login-form .bbp-login-links a:hover {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.nav-pills > li.active > a,
			.nav-pills > li.active > a:hover,
			.nav-pills > li.active > a:focus {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.woocommerce #respond input#submit:hover, 
			.woocommerce a.button:hover, 
			.woocommerce button.button:hover, 
			.woocommerce input.button:hover {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.index-cart:hover {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.woocommerce span.onsale {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.woocommerce span.onsale:after {
				border-left: 14px solid <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce #respond input#submit:disabled[disabled], .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce a.button:disabled[disabled], .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled] {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.ctc-alignleft-side {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}
							
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?> !important;
			}
			
			div#schat-widget .schat-button.schat-primary:hover {
				background-color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?> !important;
			}

			div#schat-widget .schat-popup a.schat-button:hover {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?> !important;
			}
			
			a.next,
			span.next {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			a.next:after,
			span.next:after {
				border-left: 11px solid <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			.paging-navigation .current {
				color: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.feat-home-index-thumb .index-cat {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.search-iconhead a:hover, 
			.search-iconhead a.active {
				background: <?php if( $buttoncolor != null ) { echo esc_attr($buttoncolor); } else { echo '#3a90fd'; } ?>;
			}

			/*--------------------------------------------------------------
			3. Text and Links
			--------------------------------------------------------------*/
			.login-top a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.tag-span {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.search-top a:hover, 
			.search-top a.active {
				background: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.headhesive-menu li:hover > a,
			.headhesive-menu li.focus > a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.headhesive-menu .sf-arrows > li > .sf-with-ul:focus:after,
			.headhesive-menu .sf-arrows > li:hover > .sf-with-ul:after,
			.headhesive-menu .sf-arrows > .sfHover > .sf-with-ul:after {
				border-top-color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.headhesive-tag-lines a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.headhesive-social a:hover,
			.headhesive-social a .fa-caret-down:hover,
			.headhesive-social a.active {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			a:hover,
			a:active {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.main-navigation .sf-arrows > li > .sf-with-ul:focus:after,
			.main-navigation .sf-arrows > li:hover > .sf-with-ul:after,
			.main-navigation .sf-arrows > .sfHover > .sf-with-ul:after {
				border-top-color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.secondary-menu li:hover > a,
			.secondary-menu li.focus > a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.secondary-menu .sf-arrows > li > .sf-with-ul:focus:after,
			.secondary-menu .sf-arrows > li:hover > .sf-with-ul:after,
			.secondary-menu .sf-arrows > .sfHover > .sf-with-ul:after {
				border-top-color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.widget a:hover,
			.widget li a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.read-more:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?> !important;
			}

			.entry-title-index a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.entry-title-index-feat a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.entry-title-index-grid a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.top-meta a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.comments-count,
			.comments-count a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.entry-title a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.entry-content a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.post-pagination a,
			.post-pagination span {
				background: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			blockquote p:before{
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.related-wise-post-thumb a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.custom-posts ul li a h4:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			a.default-url:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.top-meta-2 a {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.config-please a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.complex-titles a > .page-title:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.entry-title-index-compsub a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.titles-cover h1 a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}

			.woocommerce .lost_password a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.custom-posts ul li a h4:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?>;
			}
			
			div#schat-widget .schat-links a:hover {
				color: <?php if( $textcolor != null ) { echo esc_attr($textcolor); } else { echo '#3a90fd'; } ?> !important;
			}

			/*--------------------------------------------------------------
			4. Lines, Borders and Objects
			--------------------------------------------------------------*/
			.widget-title:after {
				background: <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}

			.page-title {
				border-left: 7px solid <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}
			
			.page-title-archive:after {
				background: <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}

			.comment-awaiting-moderation {
				background: <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}

			.titles-cover {
				border-bottom: 7px solid <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}

			.related h2 {
				border-left: 7px solid <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}

			p.demo_store {
				background-color: <?php if( $linecolor != null ) { echo esc_attr($linecolor); } else { echo '#3a90fd'; } ?>;
			}
		
		<?php endif; ?>
	
		<?php if (get_option('wise_minify_optimize') == true) : // Fix for images ?>

			.feat-title-content-index-carousel {
				background: url(<?php echo get_template_directory_uri() . '/img/bg-slider.png'; ?>) repeat;
			}
		<?php endif; // End Color Settings ?>
		
		<?php if( $wise_dis_back == false ) : // For Background ?>
			@media screen and (min-width: 437px) {
				body {
					background: url(<?php $wise_def_back = get_template_directory_uri() . '/img/background.jpg'; if($wise_main_back) { echo esc_url($wise_main_back); } else { echo esc_url($wise_def_back); } ?>) no-repeat center center fixed; 
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
				}
			}
		<?php endif; ?>
		
	</style>
	<?php
}
add_action('wp_head', 'wise_customization');

/*--------------------------------------------------------------
32. Wise prettyPhoto Lightbox
--------------------------------------------------------------*/
if( !function_exists('wise_lightbox') ) :
	function wise_lightbox() {
		global $woocommerce;
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$woocommerce_lightbox = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;

		if ( function_exists('is_woocommerce') && $woocommerce_lightbox ) {
			wp_enqueue_script( 'wise-prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $min . '.js', array( 'jquery' ), $woocommerce->version, true );
			wp_enqueue_script( 'wise-prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $min . '.js', array( 'jquery' ), $woocommerce->version, true );
			wp_enqueue_style( 'wise-prettyPhoto-css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
		}
		else {
			wp_enqueue_script( 'wise-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'wise-prettyPhoto-init', get_template_directory_uri() . '/js/jquery.prettyPhoto.init.min.js', array( 'jquery' ), null, true );
			wp_enqueue_style( 'wise-prettyPhoto-css', get_template_directory_uri() . '/css/prettyPhoto.min.css' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wise_lightbox' );

	function wise_prettyPhoto_img($content) {
		global $post;
		$pattern = "/(<a(?![^>]*?data-rel=['\"]prettyPhoto.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)['\"][^\>]*)>/i";
		$replacement = '$1 data-rel="prettyPhoto['.$post->ID.']">';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}
	add_filter("the_content","wise_prettyPhoto_img");

	function wise_prettyPhoto_gallery($link) {
		global $post;
		$pattern = "/(<a(?![^>]*?data-rel=['\"]prettyPhoto.*)[^>]*?href=['\"][^'\"]+?\.(?:bmp|gif|jpg|jpeg|png)['\"][^\>]*)>/i";
		$replacement = '$1 data-rel="prettyPhoto['.$post->ID.']">';
		$link = preg_replace($pattern, $replacement, $link);
		return $link;
	}
	add_filter('wp_get_attachment_link', 'wise_prettyPhoto_gallery');

endif;

/*--------------------------------------------------------------
33. Google Fonts
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	33.1 700+ Google Fonts
	--------------------------------------------------------------*/
	if( !function_exists('wise_google_fonts') ) :
		function wise_google_fonts() {
			$font_lists = array( "", "ABeeZee", "Abel", "Abril Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent Pro", "Aguafina Script", "Akronim", "Aladin", "Aldrich", "Alef", "Alegreya", "Alegreya SC", "Alegreya Sans", "Alegreya Sans SC", "Alex Brush", "Alfa Slab One", "Alice", "Alike", "Alike Angular", "Allan", "Allerta", "Allerta Stencil", "Allura", "Almendra", "Almendra Display", "Almendra SC", "Amarante", "Amaranth", "Amatic SC", "Amethysta", "Amiri", "Amita", "Anaheim", "Andada", "Andika", "Angkor", "Annie Use Your Telescope", "Anonymous Pro", "Antic", "Antic Didone", "Antic Slab", "Anton", "Arapey", "Arbutus", "Arbutus Slab", "Architects Daughter", "Archivo Black", "Archivo Narrow", "Arimo", "Arizonia", "Armata", "Artifika", "Arvo", "Arya", "Asap", "Asar", "Asset", "Astloch", "Asul", "Atomic Age", "Aubrey", "Audiowide", "Autour One", "Average", "Average Sans", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre", "Averia Serif Libre", "Bad Script", "Balthazar", "Bangers", "Basic", "Battambang", "Baumans", "Bayon", "Belgrano", "Belleza", "BenchNine", "Bentham", "Berkshire Swash", "Bevan", "Bigelow Rules", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Biryani", "Bitter", "Black Ops One", "Bokor", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC", "Brawler", "Bree Serif", "Bubblegum Sans", "Bubbler One", "Buda", "Buenard", "Butcherman", "Butterfly Kids", "Cabin", "Cabin Condensed", "Cabin Sketch", "Caesar Dressing", "Cagliostro", "Calligraffitti", "Cambay", "Cambo", "Candal", "Cantarell", "Cantata One", "Cantora One", "Capriola", "Cardo", "Carme", "Carrois Gothic", "Carrois Gothic SC", "Carter One", "Catamaran", "Caudex", "Caveat", "Caveat Brush", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chau Philomene One", "Chela One", "Chelsea Market", "Chenla", "Cherry Cream Soda", "Cherry Swash", "Chewy", "Chicle", "Chivo", "Chonburi", "Cinzel", "Cinzel Decorative", "Clicker Script", "Coda", "Coda Caption", "Codystar", "Combo", "Comfortaa", "Coming Soon", "Concert One", "Condiment", "Content", "Contrail One", "Convergence", "Cookie", "Copse", "Corben", "Courgette", "Cousine", "Coustard", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crete Round", "Crimson Text", "Croissant One", "Crushed", "Cuprum", "Cutive", "Cutive Mono", "Damion", "Dancing Script", "Dangrek", "Dawning of a New Day", "Days One", "Dekko", "Delius", "Delius Swash Caps", "Delius Unicase", "Della Respira", "Denk One", "Devonshire", "Dhurjati", "Didact Gothic", "Diplomata", "Diplomata SC", "Domine", "Donegal One", "Doppio One", "Dorsa", "Dosis", "Dr Sugiyama", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Duru Sans", "Dynalight", "EB Garamond", "Eagle Lake", "Eater", "Economica", "Eczar", "Ek Mukta", "Electrolize", "Elsie", "Elsie Swash Caps", "Emblema One", "Emilys Candy", "Engagement", "Englebert", "Enriqueta", "Erica One", "Esteban", "Euphoria Script", "Ewert", "Exo", "Exo 2", "Expletus Sans", "Fanwood Text", "Fascinate", "Fascinate Inline", "Faster One", "Fasthand", "Fauna One", "Federant", "Federo", "Felipa", "Fenix", "Finger Paint", "Fira Mono", "Fira Sans", "Fjalla One", "Fjord One", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky", "Forum", "Francois One", "Freckle Face", "Fredericka the Great", "Fredoka One", "Freehand", "Fresca", "Frijole", "Fruktur", "Fugaz One", "GFS Didot", "GFS Neohellenic", "Gabriela", "Gafata", "Galdeano", "Galindo", "Gentium Basic", "Gentium Book Basic", "Geo", "Geostar", "Geostar Fill", "Germania One", "Gidugu", "Gilda Display", "Give You Glory", "Glass Antiqua", "Glegoo", "Gloria Hallelujah", "Goblin One", "Gochi Hand", "Gorditas", "Goudy Bookletter 1911", "Graduate", "Grand Hotel", "Gravitas One", "Great Vibes", "Griffy", "Gruppo", "Gudea", "Gurajada", "Habibi", "Halant", "Hammersmith One", "Hanalei", "Hanalei Fill", "Handlee", "Hanuman", "Happy Monkey", "Headland One", "Henny Penny", "Herr Von Muellerhoff", "Hind", "Hind Siliguri", "Hind Vadodara", "Holtwood One SC", "Homemade Apple", "Homenaje", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC", "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Iceberg", "Iceland", "Imprima", "Inconsolata", "Inder", "Indie Flower", "Inika", "Inknut Antiqua", "Irish Grover", "Istok Web", "Italiana", "Italianno", "Itim", "Jacques Francois", "Jacques Francois Shadow", "Jaldi", "Jim Nightshade", "Jockey One", "Jolly Lodger", "Josefin Sans", "Josefin Slab", "Joti One", "Judson", "Julee", "Julius Sans One", "Junge", "Jura", "Just Another Hand", "Just Me Again Down Here", "Kadwa", "Kalam", "Kameron", "Kantumruy", "Karla", "Karma", "Kaushan Script", "Kavoon", "Kdam Thmor", "Keania One", "Kelly Slab", "Kenia", "Khand", "Khmer", "Khula", "Kite One", "Knewave", "Kotta One", "Koulen", "Kranky", "Kreon", "Kristi", "Krona One", "Kurale", "La Belle Aurore", "Laila", "Lakki Reddy", "Lancelot", "Lateef", "Lato", "League Script", "Leckerli One", "Ledger", "Lekton", "Lemon", "Libre Baskerville", "Life Savers", "Lilita One", "Lily Script One", "Limelight", "Linden Hill", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid", "Lora", "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Lusitana", "Lustria", "Macondo", "Macondo Swash Caps", "Magra", "Maiden Orange", "Mako", "Mallanna", "Mandali", "Marcellus", "Marcellus SC", "Marck Script", "Margarine", "Marko One", "Marmelad", "Martel", "Martel Sans", "Marvel", "Mate", "Mate SC", "Maven Pro", "McLaren", "Meddon", "MedievalSharp", "Medula One", "Megrim", "Meie Script", "Merienda", "Merienda One", "Merriweather", "Merriweather Sans", "Metal", "Metal Mania", "Metamorphous", "Metrophobic", "Michroma", "Milonga", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modak", "Modern Antiqua", "Molengo", "Molle", "Monda", "Monofett", "Monoton", "Monsieur La Doulaise", "Montaga", "Montez", "Montserrat", "Montserrat Alternates", "Montserrat Subrayada", "Moul", "Moulpali", "Mountains of Christmas", "Mouse Memoirs", "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Muli", "Mystery Quest", "NTR", "Neucha", "Neuton", "New Rocker", "News Cycle", "Niconne", "Nixie One", "Nobile", "Nokora", "Norican", "Nosifer", "Nothing You Could Do", "Noticia Text", "Noto Sans", "Noto Serif", "Nova Cut", "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Numans", "Nunito", "Odor Mean Chey", "Offside", "Old Standard TT", "Oldenburg", "Oleo Script", "Oleo Script Swash Caps", "Open Sans", "Open Sans Condensed", "Oranienbaum", "Orbitron", "Oregano", "Orienta", "Original Surfer", "Oswald", "Over the Rainbow", "Overlock", "Overlock SC", "Ovo", "Oxygen", "Oxygen Mono", "PT Mono", "PT Sans", "PT Sans Caption", "PT Sans Narrow", "PT Serif", "PT Serif Caption", "Pacifico", "Palanquin", "Palanquin Dark", "Paprika", "Parisienne", "Passero One", "Passion One", "Pathway Gothic One", "Patrick Hand", "Patrick Hand SC", "Patua One", "Paytone One", "Peddana", "Peralta", "Permanent Marker", "Petit Formal Script", "Petrona", "Philosopher", "Piedra", "Pinyon Script", "Pirata One", "Plaster", "Play", "Playball", "Playfair Display", "Playfair Display SC", "Podkova", "Poiret One", "Poller One", "Poly", "Pompiere", "Pontano Sans", "Poppins", "Port Lligat Sans", "Port Lligat Slab", "Pragati Narrow", "Prata", "Preahvihear", "Press Start 2P", "Princess Sofia", "Prociono", "Prosto One", "Puritan", "Purple Purse", "Quando", "Quantico", "Quattrocento", "Quattrocento Sans", "Questrial", "Quicksand", "Quintessential", "Qwigley", "Racing Sans One", "Radley", "Rajdhani", "Raleway", "Raleway Dots", "Ramabhadra", "Ramaraja", "Rambla", "Rammetto One", "Ranchers", "Rancho", "Ranga", "Rationale", "Ravi Prakash", "Redressed", "Reenie Beanie", "Revalia", "Rhodium Libre", "Ribeye", "Ribeye Marrow", "Righteous", "Risque", "Roboto", "Roboto Condensed", "Roboto Mono", "Roboto Slab", "Rochester", "Rock Salt", "Rokkitt", "Romanesco", "Ropa Sans", "Rosario", "Rosarivo", "Rouge Script", "Rozha One", "Rubik", "Rubik Mono One", "Rubik One", "Ruda", "Rufina", "Ruge Boogie", "Ruluko", "Rum Raisin", "Ruslan Display", "Russo One", "Ruthie", "Rye", "Sacramento", "Sahitya", "Sail", "Salsa", "Sanchez", "Sancreek", "Sansita One", "Sarala", "Sarina", "Sarpanch", "Satisfy", "Scada", "Scheherazade", "Schoolbell", "Seaweed Script", "Sevillana", "Seymour One", "Shadows Into Light", "Shadows Into Light Two", "Shanti", "Share", "Share Tech", "Share Tech Mono", "Shojumaru", "Short Stack", "Siemreap", "Sigmar One", "Signika", "Signika Negative", "Simonetta", "Sintony", "Sirin Stencil", "Six Caps", "Skranji", "Slabo 13px", "Slabo 27px", "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Snowburst One", "Sofadi One", "Sofia", "Sonsie One", "Sorts Mill Goudy", "Source Code Pro", "Source Sans Pro", "Source Serif Pro", "Special Elite", "Spicy Rice", "Spinnaker", "Spirax", "Squada One", "Sree Krushnadevaraya", "Stalemate", "Stalinist One", "Stardos Stencil", "Stint Ultra Condensed", "Stint Ultra Expanded", "Stoke", "Strait", "Sue Ellen Francisco", "Sumana", "Sunshiney", "Supermercado One", "Sura", "Suranna", "Suravaram", "Suwannaphum", "Swanky and Moo Moo", "Syncopate", "Tangerine", "Taprom", "Tauri", "Teko", "Telex", "Tenali Ramakrishna", "Tenor Sans", "Text Me One", "The Girl Next Door", "Tienne", "Tillana", "Timmana", "Tinos", "Titan One", "Titillium Web", "Trade Winds", "Trocchi", "Trochut", "Trykker", "Tulpen One", "Ubuntu", "Ubuntu Condensed", "Ubuntu Mono", "Ultra", "Uncial Antiqua", "Underdog", "Unica One", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Vampiro One", "Varela", "Varela Round", "Vast Shadow", "Vesper Libre", "Vibur", "Vidaloka", "Viga", "Voces", "Volkhov", "Vollkorn", "Voltaire", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat", "Warnes", "Wellfleet", "Wendy One", "Wire One", "Work Sans", "Yanone Kaffeesatz", "Yantramanav", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada" );
			return $font_lists;
		}
	endif;
	
	/*--------------------------------------------------------------
	33.2 Google Fonts Settings
	** @by Probewise
	** @Faster Google Fonts
	** @Less font resources
	** @Enqueued in functions with minification enabled
	** @Uses single font weight which is only needed to adapt on the theme
	** @No need to add indiviual fonts, all fonts are possible to be used
	--------------------------------------------------------------*/
	function wise_google_fonts_settings() {
		$google_fonts = '';
		
		$headfonts = get_option('wise_head_fonts');
		// $headfonts = str_replace(" ", "+", $headfonts);
		$headweight = get_option('wise_head_weight');
		if( $headfonts != null ) : $headfonts .= ':' . $headweight . ',' . $headweight . 'italic|'; endif;			

		$paragfonts = get_option('wise_parag_fonts');
		// $paragfonts = str_replace(" ", "+", $paragfonts);
		$paragweight = get_option('wise_parag_weight');
		if( $paragfonts != null ) : $paragfonts .= ':' . $paragweight . ',' . $paragweight . 'italic|'; endif;
		
		$metafonts = get_option('wise_meta_fonts');
		// $metafonts = str_replace(" ", "+", $metafonts);
		$metaweight = get_option('wise_meta_weight');
		if( $metafonts != null ) : $metafonts .= ':' . $metaweight . ',' . $metaweight . 'italic|'; endif;
		
		$buttonfonts = get_option('wise_button_fonts');
		// $buttonfonts = str_replace(" ", "+", $buttonfonts);
		$buttonweight = get_option('wise_button_weight');
		if( $buttonfonts != null ) : $buttonfonts .= ':' . $buttonweight . ',' . $buttonweight . 'italic|'; endif;

		$navfonts = get_option('wise_nav_fonts');
		// $navfonts = str_replace(" ", "+", $navfonts);
		$navweight = get_option('wise_nav_weight');
		if( $navfonts != null ) : $navfonts .= ':' . $navweight . ',' . $navweight . 'italic|'; endif;
		
		$descfonts = get_option('wise_desc_fonts');		
		// $descfonts = str_replace(" ", "+", $descfonts);
		$descweight = get_option('wise_desc_weight');
		if( $descfonts != null ) : $descfonts .= ':' . $descweight . ',' . $descweight . 'italic|'; endif;

		/*
		* Translator Option
		* Translators: If there are characters in your language that are not supported
		* by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		if ( 'off' !== esc_attr_x( 'on', 'Google font: on or off', 'wise-blog' ) ) :
		
				/*
				* Multiple word Google Fonts are encoded using urlencode even if it has spaces.
				* Uses https or http depending on needs.
				*/
				if( $headfonts != null ) { $google_fonts .= $headfonts; } else { $google_fonts .= 'Roboto:400,500,700|'; }
				if( $paragfonts != null ) { $google_fonts .= $paragfonts; } else { $google_fonts .= 'Open Sans:400,400italic|'; }
				if( $metafonts != null ) { $google_fonts .= $metafonts; } else { $google_fonts .= 'Ubuntu:400,500|'; }
				if( $buttonfonts != null ) { $google_fonts .= $buttonfonts; } else { $google_fonts .= 'Open Sans:400,400italic|'; }
				if( $navfonts != null ) { $google_fonts .= $navfonts; } else { $google_fonts .= 'Open Sans:600,600italic|'; }
				if( $descfonts != null ) { $google_fonts .= $descfonts; } else { $google_fonts .= 'Raleway:400'; }
				
				$wise_protocol = is_ssl() ? 'https' : 'http';
				$wise_google_url = $wise_protocol . '://fonts.googleapis.com/css';
				$google_fonts = esc_url( add_query_arg( 'family', urlencode($google_fonts), $wise_google_url ) );
				
		endif; // End Translator Option

		return $google_fonts;
	}
	
/*--------------------------------------------------------------
34. Affiliates Auto Disclaimer
--------------------------------------------------------------*/
	/*--------------------------------------------------------------------
	34.1 Enable or Disable Affiliates Disclaimer on Specific Post or Page
	--------------------------------------------------------------------*/
	if ( ! function_exists( 'wise_aff_post' ) ) :
		function wise_aff_post()
		{
			global $post;
			if (get_post_type($post) != 'post' || 'page') {

			$value = get_post_meta($post->ID, 'wise_aff_post', true);
			?>
				<div class="misc-pub-section">
					<label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null); ?> value="1" name="wise_aff_post"> <?php esc_html_e( 'Enable Affiliates Disclaimer', 'wise-blog' ); ?></label>
				</div>
			<?php } else { return; }
		}
		add_action( 'post_submitbox_misc_actions', 'wise_aff_post' );
	endif;

	if ( ! function_exists( 'wise_save_aff' ) ) :
		function wise_save_aff($postid) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

			if ( !current_user_can( 'edit_pages', $postid ) ) return false;
			
			if ( !current_user_can( 'edit_posts', $postid ) ) return false;

			if(empty($postid)) return false;

			if(isset($_POST['wise_aff_post'])){
				add_post_meta($postid, 'wise_aff_post', 1, true );
			}
			else{
				delete_post_meta($postid, 'wise_aff_post');
			}
		}
		add_action( 'save_post', 'wise_save_aff');
	endif;

	/*--------------------------------------------------------------
	34.2 Display Affiliates Disclaimer
	--------------------------------------------------------------*/
	if( !function_exists('wise_affiliates_disclaimer') ) :
		function wise_affiliates_disclaimer() {		
			global $post; $enable_aff = get_post_meta($post->ID, 'wise_aff_post', true);		
			
			if($enable_aff == true) :
				$auto_disclaimer = get_option('wise_aff_disclaimer');
				echo '<p class="auto-disclaimer">' . esc_html($auto_disclaimer) . '</p>';
			endif;
		}
	endif;
	
/*--------------------------------------------------------------
35. Featured Homepage Posts
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_featured_post' ) ) :
	function wise_featured_post()
	{
		global $post;
		if (get_post_type($post) != 'post' || 'page') {

		$value = get_post_meta($post->ID, 'wise_featured_post', true);
		?>
			<div class="misc-pub-section">
				<label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null); ?> value="1" name="wise_featured_post"> <?php esc_html_e( 'Set as Featured', 'wise-blog' ); ?></label>
			</div>
		<?php } else { return; }
	}
	add_action( 'post_submitbox_misc_actions', 'wise_featured_post' );
endif;

if ( ! function_exists( 'wise_save_featured' ) ) :
	function wise_save_featured($postid) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

		if ( !current_user_can( 'edit_pages', $postid ) ) return false;
		
		if ( !current_user_can( 'edit_posts', $postid ) ) return false;

		if(empty($postid)) return false;

		if(isset($_POST['wise_featured_post'])){
			add_post_meta($postid, 'wise_featured_post', 1, true );
		}
		else{
			delete_post_meta($postid, 'wise_featured_post');
		}
	}
	add_action( 'save_post', 'wise_save_featured');
endif;

/*--------------------------------------------------------------
36. Video Fix Embed
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_embed_oembed_html' ) ) :
	function wise_embed_oembed_html($html, $url, $attr, $post_id) {
		if( strpos($html, 'twitter') == false ) {
			return '<div class="wise-container">' . $html . '</div>';
		} else { return $html; }
	}
	add_filter('embed_oembed_html', 'wise_embed_oembed_html', 99, 4);
endif;

/*--------------------------------------------------------------
37. Navigation Menus
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	37.1 Headhesive Menu
	--------------------------------------------------------------*/
	function wise_headhesive_menu() {
		if( function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) {
			wp_nav_menu( array( 'theme_location' => 'bbpress', 'menu_id' => 'bbpress-menu-headhesive', 'fallback_cb' => 'wise_menu_message' ) );
		} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
			wp_nav_menu( array( 'theme_location' => 'woocommerce', 'menu_id' => 'woocommerce-menu-headhesive', 'fallback_cb' => 'wise_menu_message' ) );
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu-headhesive', 'fallback_cb' => 'wise_menu_message' ) );
		}
	}

	/*--------------------------------------------------------------
	37.2 Main Menu
	--------------------------------------------------------------*/
	function wise_main_menu() {
		if( function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) {
			wp_nav_menu( array( 'theme_location' => 'bbpress', 'menu_id' => 'bbpress-menu', 'fallback_cb' => 'wise_menu_message' ) );
		} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
			wp_nav_menu( array( 'theme_location' => 'woocommerce', 'menu_id' => 'woocommerce-menu', 'fallback_cb' => 'wise_menu_message' ) );
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'fallback_cb' => 'wise_menu_message' ) );
		}
	}

	/*--------------------------------------------------------------
	37.3 Secondary Menu
	--------------------------------------------------------------*/
	function wise_secondary_menu() {
		wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => 'wise_menu_message' ) );
	}

	/*--------------------------------------------------------------
	37.4 Responsive Main Menu
	--------------------------------------------------------------*/
	function wise_responsive_main_menu() {
		if( function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) {
			wp_nav_menu( array( 'theme_location' => 'bbpress', 'menu_id' => 'bbpress-menu-mobile', 'fallback_cb' => 'wise_menu_message' ) );
		} elseif( function_exists('is_woocommerce') && is_woocommerce() ) {
			wp_nav_menu( array( 'theme_location' => 'woocommerce', 'menu_id' => 'woocommerce-menu-mobile', 'fallback_cb' => 'wise_menu_message' ) );
		} else {
			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu-mobile', 'fallback_cb' => 'wise_menu_message' ) );
		}
	}

	/*--------------------------------------------------------------
	37.5 Responsive Secondary Menu
	--------------------------------------------------------------*/
	function wise_responsive_secondary_menu() {
		wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary', 'fallback_cb' => 'wise_menu_message' ) );
	}
	
	/*--------------------------------------------------------------
	37.6 Footer Menu
	--------------------------------------------------------------*/
	function wise_footer_single_menu() {
		wp_nav_menu( array( 'theme_location' => 'footers', 'menu_id' => 'footer-menu', 'fallback_cb' => 'wise_menu_message' ) );
	}

/*--------------------------------------------------------------
38. Social Menus
--------------------------------------------------------------*/
	/*--------------------------------------------------------------
	38.1 Headhesive Social Menu
	--------------------------------------------------------------*/
	function wise_headhesive_social_menu() { ?>
		<div class="social-like-wrapper">
			<div class="social-like-headhesive" id="share-top">
			  <ul class="social-links-headhesive">
			  
				<?php
					if (get_option('wise_soc_rss_links', true)) { 
						echo '<li><a href="';
						echo esc_url(get_option('wise_soc_rss_links'));
						echo '" target="_blank"><i class="fa fa-rss"></i></a></li>';
					}
					else  {
						echo'';
					}
				?>
				<?php
					if (get_option('wise_soc_fb_links', true)) { 
						echo '<li><a href="';
						echo esc_url(get_option('wise_soc_fb_links'));
						echo '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
					}
					else  {
						echo'';
					}
				?>
				<?php
					if (get_option('wise_soc_twitter_links', true)) { 
						echo '<li><a href="';
						echo esc_url(get_option('wise_soc_twitter_links'));
						echo '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
					}
					else  {
						echo'';
					}
				?>
				<?php
					if (get_option('wise_soc_gplus_links', true)) { 
						echo '<li><a href="';
						echo esc_url(get_option('wise_soc_gplus_links'));
						echo '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
					}
					else  {
						echo'';
					}
				?>
				<?php
					if (get_option('wise_soc_yt_links', true)) { 
						echo '<li><a href="';
						echo esc_url(get_option('wise_soc_yt_links'));
						echo '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
					}
					else  {
						echo'';
					}
				?>

			  </ul>
			</div><!--End Social Links Headhesive-->
		</div><!--End Social Like Wrapper Headhesive--><?php
	}

	/*--------------------------------------------------------------
	38.2 Main Social Menu
	--------------------------------------------------------------*/
	function wise_main_social_menu() { ?>
		<div class="social-top">
		  <ul class='social-links-top'>
			
			<?php
				if (get_option('wise_soc_rss_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_rss_links'));
					echo '" target="_blank"><i class="fa fa-rss"></i></a></li>';
				}
				else  {
					echo'';
				}
			?>
			<?php
				if (get_option('wise_soc_fb_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_fb_links'));
					echo '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
				}
				else  {
					echo'';
				}
			?>
			<?php
				if (get_option('wise_soc_twitter_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_twitter_links'));
					echo '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
				}
				else  {
					echo'';
				}
			?>
			<?php
				if (get_option('wise_soc_gplus_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_gplus_links'));
					echo '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
				}
				else  {
					echo'';
				}
			?>
			<?php
				if (get_option('wise_soc_yt_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_yt_links'));
					echo '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
				}
				else  {
					echo'';
				}
			?>

		  </ul>
		</div><!-- End Social-Top --><?php
	}

	/*--------------------------------------------------------------
	38.3 Footer Social Menu
	--------------------------------------------------------------*/
	function wise_footer_social_menu() { ?>
		<div class="social-cover-footer">
			<?php
				echo '<ul class="social-links-footer">';

				if (get_option('wise_soc_rss_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_rss_links'));
					echo '" target="_blank"><i class="fa fa-rss"></i></a></li>';
				}
				else  {
					echo'';
				}

				if (get_option('wise_soc_fb_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_fb_links'));
					echo '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
				}
				else  {
					echo'';
				}

				if (get_option('wise_soc_twitter_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_twitter_links'));
					echo '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
				}
				else  {
					echo'';
				}

				if (get_option('wise_soc_gplus_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_gplus_links'));
					echo '" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
				}
				else  {
					echo'';
				}

				if (get_option('wise_soc_yt_links', true)) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_yt_links'));
					echo '" target="_blank"><i class="fa fa-youtube"></i></a></li>';
				}
				else  {
					echo'';
				}

			echo '</ul>';
			?>
		</div><?php
	}
	
/*--------------------------------------------------------------
39. Preloader
**	@by Probewise
**	@Use .png, .jpeg with bouncing animation or .gif
**	@Compatible with Retina Display
--------------------------------------------------------------*/
function wise_preloader() {
	if( get_option('wise_disable_preloader') == false ) : ?>
		<div id="wiseload">
			<?php 	$pre_default = get_template_directory_uri() . '/img/header_img@2x.png'; // For Preloader
					$pre_upload = get_option( 'wise_preload' );					
					
					if( $pre_upload != null ) {
						$wise_preloader = $pre_upload;
					} else {
						$wise_preloader = $pre_default;
					}					
					list($width) = getimagesize($wise_preloader);
					$wise_chunks = explode('.', $wise_preloader); 
					$wise_ext = end($wise_chunks); // Get the image extension
			?>
			<div id="stats" <?php if($wise_ext != 'gif') : echo 'class="animated bounce infinite"'; endif; ?> style="background: url('<?php echo esc_url($wise_preloader); ?>') no-repeat center; <?php if($width > 200) : echo 'background-size: 100% !important;'; endif; ?>"></div>
		</div>
	<?php endif; ?><?php
}

/*--------------------------------------------------------------
40. Featured Homepage Posts
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_featured_post' ) ) :
	function wise_featured_post()
	{
		global $post;
		if (get_post_type($post) != 'post' || 'page') {

		$value = get_post_meta($post->ID, 'wise_featured_post', true);
		?>
			<div class="misc-pub-section">
				<label><input type="checkbox"<?php echo (!empty($value) ? ' checked="checked"' : null); ?> value="1" name="wise_featured_post"> <?php esc_html_e( 'Set as Featured', 'wise-blog' ); ?></label>
			</div>
		<?php } else { return; }
	}
	add_action( 'post_submitbox_misc_actions', 'wise_featured_post' );
endif;

if ( ! function_exists( 'wise_save_featured' ) ) :
	function wise_save_featured($postid) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return false;

		if ( !current_user_can( 'edit_pages', $postid ) ) return false;
		
		if ( !current_user_can( 'edit_posts', $postid ) ) return false;

		if(empty($postid)) return false;

		if(isset($_POST['wise_featured_post'])){
			add_post_meta($postid, 'wise_featured_post', 1, true );
		}
		else{
			delete_post_meta($postid, 'wise_featured_post');
		}
	}
	add_action( 'save_post', 'wise_save_featured');
endif;