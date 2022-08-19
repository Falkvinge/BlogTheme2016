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
9. Custom Page Links
10. Get Category Slug from ID
11. Customize Password Protected Fields
12. Custom Admin Login Form
    12.1 Login CSS
    12.2 Login URL
    12.3 Logo Title
    12.4 Login Credentials
    12.5 Login Redirection
13. Add Categories and Tags to Pages
14. Add Excerpt Features to Pages
15. Disable Automatic Image Sizes Thumbnail
16. Dynamic Block Animation
17. WooCommerce Functions
    17.1 Added WooCommerce Support
    17.2 Number of products to display in archives
    17.3 Custom Demo Store Notice (Display only in shop)
    17.4 Add Share Buttons
    17.5 Woocommerce Parent Category and Link
    17.6 Customize Breadcrumbs
    17.7 Revert Default Lost Password Form
    17.8 No. of Related Products to Display
    17.9 Shopping Icon
18. Remove Default bbPress Style
19. wp_body_open() Backwards Compatibility
20. Custom Comment List, Date Format
21. Add Items to Menus
22. Remove Obsolete features for W3C validation
23. Featured Homepage Posts
24. Video Fix Embed
25. Navigation Menus
25.1 Headhesive Menu
    25.2 Main Menu
    25.3 Secondary Menu
    25.4 Responsive Main Menu
    25.5 Responsive Secondary Menu
    25.6 Footer Menu
    26. Sticky Sidebar Settings and Fix
27. Convert Hex Color String to RGBA String
28. Remove Archive Prefix Post Type Title
29. Tag: "wise-noads", "wise-noticker" Removal
30. Customizer Preview Fix
31. Wise prettyPhoto Lightbox
32. Fix Empty Excerpt
33. Panel Fields
34. Gutenberg Blocks Placeholder
35. Disable widgets block editor
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
						next_post_link( '<div class="nav-next"><div class="nav-indicator">' . esc_html__( 'Next Post', 'wise-blog' ) . '</div><h4>%link</h4></div>', '%title' );
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
		if( get_theme_mod('wise_disable_post_date') == false) { // If true, disables date on posts
			
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = is_single() ? '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> &bull; ' . esc_html__('Updated', 'wise-blog') . ' %4$s</time>' : '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			} else {
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			}
			
			if(get_theme_mod('wise_date_format') == 'human readable') {
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( human_time_diff( get_the_date('U'), current_time('timestamp') ) . esc_attr__(' ago', 'wise-blog') ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( human_time_diff( get_the_modified_date('U'), current_time('timestamp') ) . esc_attr__(' ago', 'wise-blog') )
				);
			} else {
				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);
			}
			
			printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Posted on', 'Used before publish date.', 'wise-blog' ),
				$time_string
			);
		
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

		echo '<span class="byline">' . '&nbsp;&mdash;' . wp_kses_post($byline) . '</span>'; // WPCS: XSS OK.

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
				printf( '<footer class="entry-footer"><div class="tags-links">' . esc_html__( '%1$s', 'wise-blog' ) . '</div></footer><div class="clear"></div>', $tags_list ); // WPCS: XSS OK.
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
		return 24;
	}
	add_filter( 'excerpt_length', 'wise_custom_excerpt_length', 998 );
endif;

if ( ! function_exists( 'wise_new_excerpt_more' ) ) :
	function wise_new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'wise_new_excerpt_more');
endif;

/*--------------------------------------------------------------
9. Custom Page Links
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
10. Get Category Slug from ID
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_get_cat_slug' ) ) :
	function wise_get_cat_slug($cat_ID) {
		$cat_ID = (int)$cat_ID;
		$category = get_category($cat_ID);
		return $category->slug;
	}
endif;

/*--------------------------------------------------------------
11. Customize Password Protected Fields
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_my_password_form' ) ) :
	function wise_my_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$o = '<form action="' . esc_url( home_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		' . '<p>' . esc_html__( "To view this protected post, enter the password below", 'wise-blog' ) . ':</p>' . '
		<label for="' . esc_attr($label) . '">' . ' </label><input name="post_password" id="' . esc_attr($label) . '" type="password" size="20" maxlength="20" placeholder="' . esc_attr__('Enter Password', 'wise-blog') . '"><input type="submit" name="Submit" value="' . esc_attr__( "Submit", 'wise-blog' ) . '"></form>';
		return $o;
	}
	add_filter( 'the_password_form', 'wise_my_password_form' );
endif;

/*--------------------------------------------------------------
12. Custom Admin Login Form
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
12.1 Login CSS
--------------------------------------------------------------*/
if( !function_exists('wise_login_inline_styles') ) :
    function wise_login_inline_styles() {
        $wise_bodycont_font = get_theme_mod('wise_bodycont_font') ? get_theme_mod('wise_bodycont_font') : 'Open Sans';
        $wise_bodycont_weight = get_theme_mod('wise_bodycont_weight') ? get_theme_mod('wise_bodycont_weight') : '400';
		$wise_bodycont_categ = $wise_bodycont_font ? wise_google_fonts('category', $wise_bodycont_font) : 'sans-serif';
		$wise_textcolor = get_theme_mod('wise_text_color') ? get_theme_mod('wise_text_color') : '#3a90fd';

        $wise_button_font = get_theme_mod('wise_button_font') ? get_theme_mod('wise_button_font') : 'Open Sans';
        $wise_button_weight = get_theme_mod('wise_button_weight') ? get_theme_mod('wise_button_weight') : '600';
		$wise_button_categ = $wise_button_font ? wise_google_fonts('category', $wise_button_font) : 'sans-serif';
		$wise_buttoncolor = get_theme_mod('wise_button_color') ? get_theme_mod('wise_button_color') : '#3a90fd';

        $wise_inmeta_font = get_theme_mod('wise_inmeta_font') ? get_theme_mod('wise_inmeta_font') : 'Ubuntu';
        $wise_inmeta_weight = get_theme_mod('wise_inmeta_weight') ? get_theme_mod('wise_inmeta_weight') : '400';
		$wise_inmeta_categ = $wise_inmeta_font ? wise_google_fonts('category', $wise_inmeta_font) : 'sans-serif';
		
		$def_login_image_url = get_template_directory_uri() . '/img/header_img.png';
		$wise_login_image = get_theme_mod('wise_login_image_url') ? get_theme_mod('wise_login_image_url') : $def_login_image_url;
		$file_chunks = pathinfo($wise_login_image);
		$wise_login_image_2x = $file_chunks['dirname'] . '/' . $file_chunks['filename'] .'@2x' . '.' . $file_chunks['extension'];

        $wise_login_inline_css = "body, html,
body.login {
    background: #ffffff;
    font-family: '{$wise_bodycont_font}', {$wise_bodycont_categ};
    font-weight: {$wise_bodycont_weight};
}

.login #backtoblog a:hover, .login #nav a:hover, .login h1 a:hover {
	color: {$wise_textcolor};
}

.wp-core-ui .button-primary {	
    font-family: '{$wise_button_font}', {$wise_button_categ};
	font-weight: {$wise_button_weight};
}

.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
	background: {$wise_buttoncolor};
}

input,
select,
textarea {
	font-family: '{$wise_inmeta_font}', {$wise_inmeta_categ};
	font-weight: {$wise_inmeta_weight};
}

body.login h1 a {
	background-image: url('{$wise_login_image}'); 
}

@media all and (-webkit-min-device-pixel-ratio: 1.5) {
	body.login h1 a {
		background-image: url('{$wise_login_image_2x}'); 
	}
}

.login .button.wp-hide-pw {
    right: 10px;
    top: 10px;
}

.dashicons-visibility:before,
.dashicons-hidden:before {
    color: #aaa;
}";
		wp_enqueue_style ( 'wise-login', get_template_directory_uri() . '/css/wise-login.css' );

		// Inline
		wp_register_style( 'wise-login-inline', false );
		wp_enqueue_style( 'wise-login-inline' );
        wp_add_inline_style( 'wise-login-inline',  $wise_login_inline_css );
        
        if( get_theme_mod('wise_header_type') == 'simple' ) :
            $wise_login_headsimple_css = ".login h1 a {
    background-size: 240px;
    height: 60px;
    width: 240px;
}";
            wp_register_style( 'wise-login-headsimple', false );
            wp_enqueue_style( 'wise-login-headsimple' );
            wp_add_inline_style( 'wise-login-headsimple',  $wise_login_headsimple_css );
        endif;

		// Google Fonts
		$wise_google_fonts_settings = function_exists('wise_google_fonts_settings') ? wise_google_fonts_settings() : null;
		wp_enqueue_style( 'wise-google-fonts', $wise_google_fonts_settings, false, null, 'all' );
    }

    add_action( 'login_head', 'wise_login_inline_styles', 998 );

endif; // End if function_exists

/*--------------------------------------------------------------
12.2 Login URL
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_login_logo_url' ) ) :
	function wise_login_logo_url() {
		return esc_url( home_url('/') );
	}
	add_filter( 'login_headerurl', 'wise_login_logo_url' );
endif;

/*--------------------------------------------------------------
12.3 Logo Title
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_login_logo_url_title' ) ) :
	function wise_login_logo_url_title() {
		return get_bloginfo('name');
	}
	add_filter( 'login_headertext', 'wise_login_logo_url_title' );
endif;

/*--------------------------------------------------------------
12.4 Login Credentials
--------------------------------------------------------------*/
$login_details = get_theme_mod('wise_disable_error_details');
if ( ! function_exists( 'wise_login_error_override' ) && $login_details==true ) :
	function wise_login_error_override()
	{
		return 'Incorrect details.';
	}
	add_filter('login_errors', 'wise_login_error_override');
endif;

/*--------------------------------------------------------------
12.5 Login Redirection
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_admin_login_redirect' ) ) :
	function wise_admin_login_redirect( $redirect_to, $request, $user ) {
		global $user;
		if( isset( $user->roles ) && is_array( $user->roles ) ) {
			if( in_array( "administrator", $user->roles ) ) {
				return $redirect_to;
			} else {
				return esc_url( home_url('/') ); }
		}
		else {
		return $redirect_to; }
	}
	add_filter("login_redirect", "wise_admin_login_redirect", 10, 3);
endif;

/*--------------------------------------------------------------
13. Add Categories and Tags to Pages
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
14. Add Excerpt Features to Pages
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_add_excerpts_to_pages' ) ) :
	function wise_add_excerpts_to_pages() {
		 add_post_type_support( 'page', 'excerpt' );
	}
	add_action( 'init', 'wise_add_excerpts_to_pages' );
endif;

/*--------------------------------------------------------------
15. Disable Automatic Image Sizes Thumbnail
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
16. Dynamic Block Animation
**	@by Probewise
--------------------------------------------------------------*/
function wiseEffects() {
	$wise_effects = array('' => '', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInLeft' => 'fadeInLeft', 'fadeInRight' => 'fadeInRight', 'fadeInUp' => 'fadeInUp', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'lightSpeedIn' => 'lightSpeedIn', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rollIn' => 'rollIn', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'slideInDown' => 'slideInDown', 'slideInLeft' => 'slideInLeft', 'slideInRight' => 'slideInRight', 'slideInUp' => 'slideInUp');
	return $wise_effects;
}

function wiseTransparency() {
	$wise_transparency = array('' => null, '.1' => '10%', '.2' => '20%', '.3' => '30%', '.4' => '40%', '.5' => '50%', '.6' => '60%', '.7' => '70%', '.8' => '80%', '.9' => '90%', '1' => '100%');
	return $wise_transparency;
}

/*--------------------------------------------------------------
17. WooCommerce Functions
--------------------------------------------------------------*/
/*--------------------------------------------------------------
17.1 Added WooCommerce Support
--------------------------------------------------------------*/
add_action( 'after_setup_theme', 'wise_woocommerce_support' );
function wise_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/*--------------------------------------------------------------
17.2 Number of products to display in archives
--------------------------------------------------------------*/
add_filter( 'loop_shop_per_page', function ( $cols ) { // $cols contains default products per page
	if( !empty( get_theme_mod( 'wise_woo_archive_num' ) ) ) :
		$wise_woo_num = get_theme_mod( 'wise_woo_archive_num' );
		return $wise_woo_num; // returns to your desired number of products to display
	endif;
}, 20 );

/*--------------------------------------------------------------
17.3 Custom Demo Store Notice (Display only in shop)
--------------------------------------------------------------*/
if ( !function_exists( 'wise_woocommerce_demo_store' ) ) {
	function wise_woocommerce_demo_store() {
		if ( get_theme_mod( 'woocommerce_demo_store_notice' ) == null ) {
			return; }

		$notice = get_theme_mod( 'woocommerce_demo_store_notice' );
		if ( function_exists('is_woocommerce') && is_woocommerce() && $notice != null && is_store_notice_showing() ) {
			echo apply_filters( 'woocommerce_demo_store', '<div class="alert"><p class="demo_store">' . wp_kses_post($notice) . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p></div>'  ); }
		else {
			echo apply_filters( 'woocommerce_demo_store', '<p class="demo_store" style="display:none;">' . wp_kses_post($notice) . '</p>'  ); }
		}
}

remove_action( 'wp_footer', 'woocommerce_demo_store' );
add_action( 'wp_footer', 'wise_woocommerce_demo_store' ); // move notice to footer

/*--------------------------------------------------------------
17.4 Add Share Buttons
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_wooshare' ) ) :
	function wise_wooshare() {
		get_template_part('templates/custom-social');
	}
	add_action('woocommerce_share','wise_wooshare');
endif;

/*--------------------------------------------------------------
17.5 Woocommerce Parent Category and Link
--------------------------------------------------------------*/
if ( !function_exists( 'wise_woo_cat' ) ) :
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
17.6 Customize Breadcrumbs
--------------------------------------------------------------*/
if ( !function_exists( 'wise_woo_breadcrumbs' ) ) :
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
17.7 Revert Default Lost Password Form
--------------------------------------------------------------*/
if ( !function_exists('is_woocommerce') ) :
	function wise_revert_lost_url() {
		$homeURL = home_url('/');
		return esc_url( $homeURL . "wp-login.php?action=lostpassword" );
	}
	add_filter( 'lostpassword_url',  'wise_revert_lost_url', 11, 0 );
endif;

/*--------------------------------------------------------------
17.8 No. of Related Products to Display
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
17.9 Shopping Icon
--------------------------------------------------------------*/
if ( !function_exists('wise_woo_icon') ) :
	function wise_woo_icon() {
		global $woocommerce;
		$wise_qnty = $woocommerce->cart->get_cart_contents_count();
		$wise_total = $woocommerce->cart->get_cart_total();
        $wise_curl = wc_get_cart_url();
        $wise_login = get_theme_mod('wise_login');
        $wise_head_shopcart_dis = get_theme_mod('wise_head_shopcart_dis');
        $wise_disable_headsocial = get_theme_mod('wise_disable_headsocial');
        $wise_header_type = get_theme_mod('wise_header_type');
        
        if( ( ($wise_login == false) && !is_user_logged_in() ) && ($wise_head_shopcart_dis == false) ) {
            $wise_cart_space_fix = ' style="margin-left: 10px; padding-left: 10px; border-left: 1px solid #eee;"';
        } elseif( ($wise_header_type == 'simple') && ($wise_disable_headsocial == false) && ( ($wise_login == true) || is_user_logged_in() ) && ($wise_head_shopcart_dis == false) ) {
            $wise_cart_space_fix = ' style="margin-left: -5px; padding-left: 10px; border-left: 1px solid #eee;"';
        } else {
            $wise_cart_space_fix = null;
        }

		if( $wise_qnty > 1 ) {
			echo '<a href="' . esc_url($wise_curl) . '"><span class="wise-shop-icon"' . $wise_cart_space_fix . '><span class="wnumber">' . esc_html($wise_qnty) . '</span><span class="wtotal">' . wp_kses_post($wise_total) . '</span></span></a>';
		} elseif( $wise_qnty == 1 ) {
			echo '<a href="' . esc_url($wise_curl) . '"><span class="wise-shop-icon"' . $wise_cart_space_fix . '><span class="wnumber">1</span><span class="wtotal">' . wp_kses_post($wise_total) . '</span></span></a>';
		} else {
			echo '<a href="' . esc_url($wise_curl) . '"><span class="wise-shop-icon"' . $wise_cart_space_fix . '><span class="wnumber">0</span><span class="wtotal">' . wp_kses_post($wise_total) . '</span></span></a>';
		}
	}
endif;

/*--------------------------------------------------------------
18. Remove Default bbPress Style
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_deregister_bbpress_styles' ) ) :
	function wise_deregister_bbpress_styles() {
		wp_deregister_style( 'bbp-default' );
	}
	add_action( 'wp_print_styles', 'wise_deregister_bbpress_styles', 15 );
endif;

/*--------------------------------------------------------------
19. wp_body_open() Backwards Compatibility
--------------------------------------------------------------*/
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/*--------------------------------------------------------------
20. Custom Comment List, Date Format
--------------------------------------------------------------*/
// Modify date format
function wise_comment_date_format() {
	if( get_theme_mod('wise_date_format' ) == 'human readable') {
		return human_time_diff(get_comment_time('U'), current_time('timestamp')) . " " . esc_html__('ago', 'wise-blog');
	} else {
		return comment_date();
	}
}

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
	<?php if ( $args['avatar_size'] != 0 ) : echo get_avatar( $comment, $args['avatar_size'] ); endif; ?>
	<?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
	<div class="comment-meta comment-metadata">
		<?php printf( '<time>%1$s</time>', wise_comment_date_format() ); ?></a><br><?php /* translators: 1: date, 2: time, add this to get time: %2$s */ ?>
	</div>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'wise-blog' ); ?></em>
		<br >
	<?php endif; ?>

	<div class="comment-content">
	<p><?php comment_text(); ?></p>
	<?php edit_comment_link( esc_html__( 'Edit', 'wise-blog' ), '  ', '' ); ?>
	</div>

	<?php if ( $depth < $args['max_depth'] ) : ?>
	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php endif; ?>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/*--------------------------------------------------------------
21. Add Items to Menus
--------------------------------------------------------------*/
function wise_primary_menu_item ( $items, $args ) {
    if ( ($args->theme_location == 'primary') || ($args->theme_location == 'woocommerce') || ($args->theme_location == 'bbpress') ) {
		$tag_linker = get_theme_mod('wise_tag_lines_links');
		if( !empty($tag_linker) ) {
			$tag_links = '<a href="' . $tag_linker . '">';
		} else {
			$tag_links = null;
		}		
		
		if( get_theme_mod('wise_tag_lines_title') != null ) {
			$tag_title = get_theme_mod('wise_tag_lines_title');
		} else {
			$tag_title = esc_html__( 'Get this theme?', 'wise-blog' );
		}
		
		$added_item_bottom = '<li class="res-close"><a href="#res-nav">' . esc_html__( 'Close Menu', 'wise-blog' ) . ' <i class="fa fa-times"></i></a></li>';
		
		if( ( function_exists('is_woocommerce') && is_woocommerce() ) || function_exists('is_bbpress') && ( is_bbpress() || is_page_template('page-bbpress.php') || is_page_template('page-bbpress-topics.php') ) ) : 
			$add_item_top = null;
		else :
			if( get_theme_mod('wise_tag_lines_title_dis') == false && !empty($tag_links) && get_theme_mod('wise_header_type') == '' ) {
				$add_item_top = '<li class="mobile-tag-line">' . $tag_links . $tag_title . '</a></li>';
			} else {
				$add_item_top = null;
			}			
		endif;

		$items = $add_item_top . $items . $added_item_bottom;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'wise_primary_menu_item', 10, 2 );

function wise_secondary_menu_item ( $items, $args ) {
    if ($args->theme_location == 'secondary') {
        $added_item = '<li class="res-close-top"><a href="#res-nav-top">' . esc_html__( 'Close Menu', 'wise-blog' ) . ' <i class="fa fa-times"></i></a></li>';
		if (get_theme_mod('wise_login') == false) :
			$added_item .= is_user_logged_in() ? '<li class="login-mobile"><a href="' . esc_url( wp_logout_url(home_url('/')) ) . '">' . esc_html__( 'Logout', 'wise-blog' ) . ' <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>' : '<li class="login-mobile"><a href="' . esc_url( home_url('/') . 'wp-admin/') . '">' . esc_html__( 'Login', 'wise-blog' ) . ' <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>';
			$added_item .= is_user_logged_in() ? null : '<li class="login-mobile"><a href="' . esc_url( home_url('/') . 'wp-login.php?action=register') . '">' . esc_html__( 'Register', 'wise-blog' ) . ' <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>';
		endif;
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
22. Remove Obsolete features for W3C validation
** Autoptimize plugin should be installed
--------------------------------------------------------------*/
function wise_remove_obsolete_feature($wisecontent) {    
	$wisecontent = str_replace( array( " type='text/javascript'", ' type="text/javascript"', "type='text/javascript'", 'type="text/javascript"' ), '', $wisecontent );
	$wisecontent = str_replace( array( " type='text/css'", ' type="text/css"', "type='text/css'", 'type="text/css"' ), '', $wisecontent );
	$wisecontent = str_replace( array( " frameborder='0'", ' frameborder="0"', "frameborder='0'", 'frameborder="0"' ), '', $wisecontent );
	$wisecontent = str_replace( array( " scrolling='no'", ' scrolling="no"', "scrolling='no'", 'scrolling="no"' ), '', $wisecontent );

	$home_url = esc_url( home_url('/') );
    $wisecontent = str_replace( $home_url . '/wp-includes/js', '/wp-includes/js', $wisecontent );    
    $wisecontent = str_replace( $home_url . '/wp-wisecontent/themes/', '/wp-wisecontent/themes/', $wisecontent );
    $wisecontent = str_replace( $home_url . '/wp-wisecontent/uploads/', '/wp-wisecontent/uploads/', $wisecontent );
    $wisecontent = str_replace( $home_url . '/wp-wisecontent/plugins/', '/wp-wisecontent/plugins/', $wisecontent );
	$wisecontent = str_replace( $home_url . '/wp-wisecontent/cache/autoptimize', '/wp-wisecontent/cache/autoptimize', $wisecontent );
    return $wisecontent;
}
add_filter('autoptimize_html_after_minify', 'wise_remove_obsolete_feature', 10, 1);

/*--------------------------------------------------------------
23. Featured Homepage Posts
--------------------------------------------------------------*/
if ( ! function_exists( 'wise_featured_post' ) ) :
	function wise_featured_post(){
		$wise_featured_meta = array( array( 'key' => 'wise_featured_post', 'value' => 'yes') ); // default value is empty, if checked the value will be yes
		return $wise_featured_meta;
	}
endif;

/*--------------------------------------------------------------
24. Video Fix Embed
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
25. Navigation Menus
--------------------------------------------------------------*/
/*--------------------------------------------------------------
25.1 Headhesive Menu
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
25.2 Main Menu
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
25.3 Secondary Menu
--------------------------------------------------------------*/
function wise_secondary_menu() {
	wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'fallback_cb' => 'wise_menu_message' ) );
}

/*--------------------------------------------------------------
25.4 Responsive Main Menu
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
25.5 Responsive Secondary Menu
--------------------------------------------------------------*/
function wise_responsive_secondary_menu() {
	wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary', 'fallback_cb' => 'wise_menu_message' ) );
}

/*--------------------------------------------------------------
25.6 Footer Menu
--------------------------------------------------------------*/
function wise_footer_single_menu() {
	wp_nav_menu( array( 'theme_location' => 'footers', 'menu_id' => 'footer-menu', 'fallback_cb' => 'wise_menu_message' ) );
}
	
/*--------------------------------------------------------------
26. Sticky Sidebar Settings and Fix
--------------------------------------------------------------*/
function wise_sticky_kit() {
	$wise_headhesive = get_theme_mod('wise_headhesive');
	if( $wise_headhesive == true ) { // sticky menu disabled
		$wise_stick_offset = '0';
	} else { // sticky menu enabled
		$wise_stick_offset = '54';
	}
	if( get_theme_mod('wise_disable_sticky') == false ) : // Customizer conditionals fix?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				"use strict";
				var breakpoint = 946;
				
				if($(window).width() > breakpoint){
					$('.widget-area-right').attr('data-sticky_column','');
					wiseSticky();		
				} else {
					$('.widget-area-right').removeAttr('data-sticky_column');
				}
				
				$(window).on('resize',function() {
					var breakpoint = 946;
					if($(window).width() > breakpoint){
						$('.widget-area-right').attr('data-sticky_column','');
						wiseSticky();			
					} else {
						$('.widget-area-right').removeAttr('data-sticky_column');
					}
				});

				function wiseSticky() {
					$("[data-sticky_column]").stick_in_parent({
					parent: "[data-sticky_parent]",
					offset_top: <?php echo esc_js($wise_stick_offset); ?>,
					spacer: ".sidebar-wrapper-outer"
					});
				}
				
			}); /* End jQuery */
		</script>
<?php endif; }
add_action('wp_footer', 'wise_sticky_kit');

/*--------------------------------------------------------------
27. Convert Hex Color String to RGBA String
--------------------------------------------------------------*/
function convertRGBA($color, $opacity = false) { 
	$default = 'rgb(0,0,0)';
 
	// Return default if no color provided
	if( empty($color) ) : return $default; endif; 
 
	// Sanitize $color if "#" is provided 
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	// Check if color has 6 or 3 characters and get values
	if ( strlen($color) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	// Convert hexadec to rgb
	$rgb = array_map('hexdec', $hex);

	// Check if opacity is set(RGBA or RGB)
	if( $opacity ) {
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} elseif( $opacity == '0' ){
		$output = 'rgba('.implode(",",$rgb).',0)';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}

	// Return RGBA color string
	return $output;
}

/*--------------------------------------------------------------
28. Remove Archive Prefix Post Type Title
--------------------------------------------------------------*/
function wise_modify_archive_title( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif( is_tax() ) {
		$title = single_term_title( '', false );
	}
	return $title;
} 
add_filter( 'get_the_archive_title', 'wise_modify_archive_title' );

/*--------------------------------------------------------------
29. Tag: "wise-noads", "wise-noticker" Removal
--------------------------------------------------------------*/
// Remove tags from get_tag_list()
function wise_remove_tags( $term_links ) {
    $result = array();
    $remove_tags = array( 'wise-noads', 'wise-noticker' );
    foreach ( $term_links as $link ) {
        foreach ( $remove_tags as $tag ) {
            if ( stripos( $link, $tag ) !== false ) continue 2;
        }
        $result[] = $link;
    }
    return $result;
}
add_filter( 'term_links-post_tag', 'wise_remove_tags', 100, 1 );

// Deindex wise-noads tag archive
function wise_tag_noindex() {
	if( is_tag('wise-noads') || is_tag('wise-noticker') ){
		echo '<meta name="robots" content="noindex,nofollow,noarchive">';
	}
}
add_action('wp_head','wise_tag_noindex');

// Redirect wise-noads tag to 404
function wise_redirect_tag(){
	if( is_tag('wise-noads') || is_tag('wise-noticker') ) {
		global $wp_query;
		$wp_query->set_404();
	}
}
add_action('template_redirect', 'wise_redirect_tag');

/*--------------------------------------------------------------
30. Customizer Preview Fix
--------------------------------------------------------------*/
// Customizer CSS
function wise_customizer_style() { ?>
	<style>
		/* Customizer */
		.customize-control {
			width: 100%;
			float: left;
			clear: both;
			margin-bottom: 12px;
			border-bottom: 1px solid #ddd;
			padding-bottom: 16px;
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'wise_customizer_style', 999 );

// Styles and Script Fix
function wise_customizer_style_script() {
	// Layout Style
	if(get_theme_mod('wise_layout') == 'two') { 
		wp_deregister_style( 'wise-three-column-layout' );
	} else {
		wp_deregister_style( 'wise-two-column-layout' );
	}

	// Predefined Color Scheme
	$wise_precs = get_theme_mod('wise_pre_colors');
	// newsred
	if( ($wise_precs == 'newsred') && ($wise_precs != ( 'orange' | 'coolblue' | 'darkcyan'| 'steelblue' | 'olive' | 'wallnut' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// orange
	} elseif( ($wise_precs == 'orange') && ($wise_precs != ( 'coolblue' | 'newsred' | 'darkcyan'| 'steelblue' | 'olive' | 'wallnut' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// darkcyan
	} elseif( ($wise_precs == 'darkcyan') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'steelblue' | 'olive' | 'wallnut' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// steelblue
	} elseif( ($wise_precs == 'steelblue') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'olive' | 'wallnut' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// olive
	} elseif( ($wise_precs == 'olive') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'steelblue' | 'wallnut' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// wallnut
	} elseif( ($wise_precs == 'wallnut') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'steelblue' | 'olive' | 'sienna' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// sienna
	} elseif( ($wise_precs == 'sienna') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'steelblue' | 'olive' | 'wallnut' | 'hotpink' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// hotpink
	} elseif( ($wise_precs == 'hotpink') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'steelblue' | 'olive' | 'wallnut' | 'sienna' | 'neonpurple' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	// neonpurple
	} elseif( ($wise_precs == 'neonpurple') && ($wise_precs != ( 'orange' | 'newsred' | 'coolblue'| 'darkcyan' | 'steelblue' | 'olive' | 'wallnut' | 'sienna' | 'hotpink' )) ) {
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-coolblue' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
	// coolblue
	} else {
		wp_deregister_style( 'wise-precs-newsred' );
		wp_deregister_style( 'wise-precs-orange' );
		wp_deregister_style( 'wise-precs-darkcyan' );
		wp_deregister_style( 'wise-precs-steelblue' );
		wp_deregister_style( 'wise-precs-olive' );
		wp_deregister_style( 'wise-precs-wallnut' );
		wp_deregister_style( 'wise-precs-sienna' );
		wp_deregister_style( 'wise-precs-hotpink' );
		wp_deregister_style( 'wise-precs-neonpurple' );
	}

}
add_action( 'wp_enqueue_scripts', 'wise_customizer_style_script' );

/*--------------------------------------------------------------
31. Wise prettyPhoto Lightbox
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
32. Fix Empty Excerpt
--------------------------------------------------------------*/
if( !function_exists('wise_fix_empty_excerpt') ) :
	function wise_fix_empty_excerpt( $excerpt ) {
		return trim( $excerpt );
	}
	add_filter( 'get_the_excerpt', 'wise_fix_empty_excerpt', 1 );
endif;

/*--------------------------------------------------------------
33. Panel Fields
--------------------------------------------------------------*/
function wise_panel_fields() { ?>
	<div class="wise-footer-functions">
		<?php 	$wise_geblog = wp_get_theme('wise-blog');
				$wise_getheme = $wise_geblog->exists() ? wp_get_theme('wise-blog') : wp_get_theme();
				$author_url = $wise_getheme->get( 'AuthorURI' );
				$wise_version = $wise_getheme->get( 'Version' );
				$wise_name = $wise_getheme->get( 'Name' );
				$wise_theme_uri = $wise_getheme->get( 'ThemeURI' );
				$wise_author = $wise_getheme->get( 'Author' ); ?>
		<div class="wise-help-functions"><p><?php echo esc_html_e( 'Need help? Documentation or support forum may help you.', 'wise-blog' ); ?></p>
			<p><a href="<?php echo esc_url($author_url . 'docs/wise-blog/'); ?>"><?php echo esc_html($wise_name) . ' ' . esc_html__( 'Documentation', 'wise-blog' ); ?></a></p>
			<p><a href="<?php echo esc_url($wise_theme_uri . '#cm_supp'); ?>"><?php echo esc_html($wise_author) . ' ' . esc_html__( 'Support', 'wise-blog' ); ?></a></p>
		</div>
		<div class="wise-theme-info">
			<p><?php echo esc_html__( 'Theme Name:', 'wise-blog' ); ?><?php echo '<a href="' . esc_html($wise_theme_uri) . '"> ' . esc_html($wise_name) . '</a>'; ?></p>
			<p><?php echo esc_html__( 'Version:', 'wise-blog' ); ?> <?php echo '<a href="' . esc_url($wise_theme_uri . '#cm_specs') . '">' . esc_html($wise_version) . '</a>'; ?></p>
			<p><?php echo esc_html__( 'Author:', 'wise-blog' ); ?> <a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($wise_author); ?></a></p>
		</div>
	</div>
<?php }

if( !function_exists('wise_panel_fields_footer') ) :
	function wise_panel_fields_footer() {
		global $wise_getheme;
		$wise_getheme = wp_get_theme('wise-blog');
		$author_link = $wise_getheme->get( 'AuthorURI' );
		$author_name = $wise_getheme->get( 'Author' );
		echo ' ' . '<span class="wise-author-link">' . esc_html__( 'Powered by', 'wise-blog' ) . ' <a href="' . esc_url($author_link) . '">' . esc_html($author_name) . '</a>.</span>';
	}
endif;

/*--------------------------------------------------------------
34. Gutenberg Blocks Placeholder
--------------------------------------------------------------*/
// Divs
if( !function_exists('wise_block_placeholder') ) :
    function wise_block_placeholder($wise_block_name = '', $wise_block_prev = '') {
        $wise_blocks_img = get_template_directory_uri() . '/img/wise-blocks-logo.png';
        $wise_blocks_imgnotice = wp_kses_post( __('<i><strong>Note:</strong> This is a preview image only. To see the actual preview, click <strong>Preview</strong> button. Click the <i class="fa fa-eye-slash" aria-hidden="true"></i> icon to disable image preview mode.</i>', 'wise-blog') );
        if(!is_page()) : ?>
            <div class="wise-block-section">
                <div class="wise-block-header">
                    <div class="wise-block-text">
                        <img src="<?php echo esc_url($wise_blocks_img); ?>">
                        <div class="wise-block-title"><?php echo esc_html($wise_block_name); ?></div>
                        <button onclick="wiseClickPreview()" class="wise-preview-button components-button is-secondary"><?php echo esc_html__('Preview', 'wise-blog'); ?></button>
                    </div>
                </div>
                <div class="wise-block-content">
                    <img src="<?php echo esc_url($wise_block_prev); ?>">
                </div>
                <span class="wise-block-notice"><?php echo wp_kses_post($wise_blocks_imgnotice); ?></span>
            </div>
        <?php endif;
    }
endif;

// Preview Button
if( !function_exists('wise_clickprev_script') ) :
	function wise_clickprev_script() {
echo "<script>
function wiseClickPreview() {
    jQuery(document).ready(function($) {
        $('.edit-post-header__settings button.block-editor-post-preview__button-toggle').on('click');
        $('.edit-post-header-preview__grouping-external a span.components-visually-hidden').on('click');
        setTimeout(function() {
            $('.edit-post-header__settings button.block-editor-post-preview__button-toggle').on('click');
        }, 3000);
    });
}
</script>";
    }
    
	add_action( 'admin_head', 'wise_clickprev_script' );

endif; // End if function_exists

// Styles
if( !function_exists('wise_gutenberg_wiseblocks_styles') ) :
	function wise_gutenberg_wiseblocks_styles() {
        $wise_heading_font = !empty( get_theme_mod('wise_heading_font') ) ? get_theme_mod('wise_heading_font') : 'Roboto';
        $wise_big_heading_weight = !empty( get_theme_mod('wise_big_heading_weight') ) ? get_theme_mod('wise_big_heading_weight') : '700';
        $wise_gen_heading_weight = !empty( get_theme_mod('wise_gen_heading_weight') ) ? get_theme_mod('wise_gen_heading_weight') : '500';
        $wise_other_heading_weight = !empty( get_theme_mod('wise_other_heading_weight') ) ? get_theme_mod('wise_other_heading_weight') : '400';
        $wise_heading_categ = $wise_heading_font ? wise_google_fonts('category', $wise_heading_font) : 'sans-serif';
        $wise_gutenberg_wiseblocks_css = ".wise-block-header {
    background: #f6f6f9;
    height: 60px;
    width: 100%;
}

.wise-block-text {
    display: block;
    position: relative;
    padding: 15px;
}

.wise-block-text img {
    width: 102px;
    height: 30px;
    float: left;
}

.wise-block-title {
	font-family: '{$wise_heading_font}', {$wise_heading_categ};
	font-weight: {$wise_gen_heading_weight};
    font-size: 16px;
    color: #191e23;
    float: left;
    padding-left: 20px;
}

.wise-block-section {
    border: 1px solid #e3e5e8;
}

.wise-block-content {
    background: #ffffff;
    height: auto;
    width: 100%;
    min-height: 96px;
}

.wise-preview-button {
    float: right;
}
 
.wise-block-notice {
    display: block;
    font-size: 12px;
    padding: 5px 10px;
}

.wise-contside-notice {
    margin: 0 0 20px;
}

.wise-contsidebar-name {
    display: block;
    text-transform: uppercase;
    font-size: 20px !important;
}

.edit-post-sidebar {
    width: 320px;
}";
	wp_register_style( 'wise-gutenberg', false );
	wp_enqueue_style( 'wise-gutenberg' );
	wp_add_inline_style( 'wise-gutenberg',  $wise_gutenberg_wiseblocks_css );
	}

	add_action( 'enqueue_block_editor_assets', 'wise_gutenberg_wiseblocks_styles' );

endif; // End if function_exists

				if (get_option('wise_soc_twitter_links') != null) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_twitter_links'));
					echo '" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
				} else {
					null;
				}

				if (get_option('wise_soc_gplus_links') != null) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_gplus_links'));
					echo '" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
				} else {
					null;
				}

				if (get_option('wise_soc_yt_links') != null) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_yt_links'));
					echo '" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>';
				} else {
					null;
				}
				
				if (get_option('wise_soc_in_links') != null) { 
					echo '<li><a href="';
					echo esc_url(get_option('wise_soc_in_links'));
					echo '" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
				} else {
					null;
				}

			echo '</ul>';
			?>
		</div><?php
	}
	
/*--------------------------------------------------------------
35. Disable widgets block editor
--------------------------------------------------------------*/
// Disables widget block editor from Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );

// Disables widget block editor.
add_filter( 'use_widgets_block_editor', '__return_false' );
