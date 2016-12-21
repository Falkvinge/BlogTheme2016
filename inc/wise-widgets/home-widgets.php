<?php
use Carbon_Fields\Widget;
use Carbon_Fields\Field;

/* Wise Ticker */
class WiseTicker extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Wise Ticker', 'wise-blog' ), esc_attr__( 'Displays trending/news ticker.', 'wise-blog' ) , array(
			Field::make('text', 'wise_tname', esc_attr__( 'Wise Ticker Label', 'wise-blog' ) )->set_default_value( esc_attr__( 'Trending Now', 'wise-blog' ) ),
			Field::make("select", "wise_ttype", esc_attr__( 'Type of Posts to Show', 'wise-blog' ) )
				->add_options(array(
					'trending' => esc_attr__( 'Trending Posts', 'wise-blog' ),
					'latest' => esc_attr__( 'Latest Posts', 'wise-blog' ),
				))->set_default_value('trending'),
            Field::make('text', 'wise_tnumber', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('7'),
			Field::make("checkbox", "tdis_home", esc_attr__( 'Disable on Homepage', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "tdis_arch", esc_attr__( 'Disable on Archive', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "tdis_post", esc_attr__( 'Disable on Posts', 'wise-blog' ) )
				->set_option_value('yes'),
			Field::make("checkbox", "tdis_page", esc_attr__( 'Disable on Pages', 'wise-blog' ) )
				->set_option_value('yes')
			
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_tnumber, $wise_ttype;
		$wise_tname = $instance['wise_tname'];
		$wise_ttype = $instance['wise_ttype'];
		$wise_tnumber = $instance['wise_tnumber'];
		$wise_tds_home = $instance['tdis_home'];
		$wise_tds_archive = $instance['tdis_arch'];
		$wise_tds_post = $instance['tdis_post'];
		$wise_tds_page = $instance['tdis_page'];
		if( is_single() || is_page() ) { global $post; $disable_ads = get_post_meta($post->ID, 'wise_ads_post', true); } else { null; }
		
		if( function_exists('is_woocommerce') && function_exists('is_bbpress') ) { // If WooCommerce and bbPress exists
			if( !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && !is_bbpress() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true  ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php echo esc_html($wise_tname); ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} elseif( function_exists('is_woocommerce') ) { // If WooCommerce exists
			if( !is_404() && !is_search() && !is_attachment() && !is_woocommerce() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php echo esc_html($wise_tname); ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} elseif( function_exists('is_bbpress') ) { // If bbPress exists
			if( !is_404() && !is_search() && !is_attachment() && !is_bbpress() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php echo esc_html($wise_tname); ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		} else {
			if( !is_404() && !is_search() && !is_attachment() && ($wise_tds_home == true ? ( !is_home() && !is_front_page() ) : true ) && ($wise_tds_archive == true ? !is_archive() : true ) && ($wise_tds_page == true ? !is_page() || is_front_page() : true ) && ($wise_tds_post == true ? !is_single() : true ) ) {
				?><div class="wise-ticker clear<?php if( !is_active_sidebar('sidebar-6') || $disable_ads == true ) : echo ' forty-padding-top'; endif; ?>">
					<div class="wise-tcaption"><h4><?php echo esc_html($wise_tname); ?></h4></div>
					<div class="wise-tcont"><?php get_template_part('templates/custom_templates/content', 'wise-ticker'); ?></div>
				</div><?php
			} else { null; }
		}		
		
    }
}

/* Home Slider */
class HomeSlider extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Featured Contents', 'wise-blog' ), esc_attr__( 'Displays home slider in grid or carousel format.', 'wise-blog' ), array(
			Field::make('text', 'wise_featured_id', esc_attr__( 'Posts ID (separate by comma: 1, 2, 3; leave blank to automate)', 'wise-blog' ) ),
			Field::make("select", "wise_featured_type", esc_attr__( 'Block Type', 'wise-blog' ) )
				->add_options(array(
					'grid' => esc_attr__( 'Grid Type', 'wise-blog' ),
					'carousel' => esc_attr__( 'Carousel Type', 'wise-blog' ),
				)),
			Field::make("select", "wise_slider_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
            Field::make('text', 'wise_featured_number', esc_attr__( 'No. of Featured Posts', 'wise-blog' ) )->set_default_value('3')
			
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_feat_num, $wise_slider_categ, $wise_feat_id;
        $wise_feat_type = $instance['wise_featured_type'];
		$wise_feat_num = $instance['wise_featured_number'];
		$wise_slider_categ = $instance['wise_slider_categ'];
		$wise_feat_id = $instance['wise_featured_id'];
		get_template_part( 'templates/custom_templates/content', 'featured-' . $wise_feat_type );
    }
}

/* Home Defaults Block */
class HomeDefaults extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Defaults Block', 'wise-blog' ), esc_attr__( 'Displays latest posts.', 'wise-blog' ), array(
			Field::make('text', 'wise_lpost_title', esc_attr__( 'Latest Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Latest Posts', 'wise-blog' ) ),
			Field::make("select", "wise_title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'light' => esc_attr__( 'Light', 'wise-blog' ),
					'back' => esc_attr__( 'Background', 'wise-blog' ),
				)),
			Field::make("select", "wise_post_layout", esc_attr__( 'Post Layout', 'wise-blog' ) )
				->add_options(array(
					'defaults' => esc_attr__( 'Default Block', 'wise-blog' ),
					'grid' => esc_attr__( 'Grid Block', 'wise-blog' ),
				)),
			Field::make("select", "wise_post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_lpost_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('0'),
			Field::make("radio", "wise_lpost_pagination", esc_attr__( 'Pagination', 'wise-blog' ) )
				->add_options(array(
					'notpaginated' => esc_attr__( 'Not Paginated', 'wise-blog' ),
					'paginate' => esc_attr__( 'Paginated', 'wise-blog' ),
				))->set_default_value('paginate'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_post_layout, $wise_lpost_number, $wise_lpost_pagination, $wise_post_categ;
        $wise_lpost_title = $instance['wise_lpost_title'];
		$wise_title_type = $instance['wise_title_type'];
		$wise_post_layout = $instance['wise_post_layout'];
		$wise_post_categ = $instance['wise_post_categ'];
		$wise_lpost_number = $instance['wise_lpost_number'];
		$wise_lpost_pagination = $instance['wise_lpost_pagination'];
		
		$cat_id = get_cat_ID( $wise_post_categ );
		$cat_url = get_category_link( $cat_id );
		$get_the_excerpt = get_the_excerpt();
		
		if( !empty($wise_lpost_title) ) : // if title is not empty
			if( $wise_title_type == 'light' ) {
				if( $wise_post_categ == true ) {					
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2></a>';
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header></div>';
				} else {					
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_lpost_title) . '</h2>';
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header>';
				}
			} else {
				if( $wise_post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2></a>';
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_lpost_title) . '</h2>';
					if( !empty($get_the_excerpt) ) : echo '<div class="taxonomy-description"><p>' . esc_html($get_the_excerpt) . '</p></div>'; endif;
					echo '</header>';
				}
			}
		endif;
        get_template_part( 'templates/content', 'defaults' );
    }
}

/* Home Complex 1 Block */
class HomeComplex1 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Complex 1 Block', 'wise-blog' ), esc_attr__( 'Displays complex 1 posts block.', 'wise-blog' ), array(
			Field::make('text', 'wise_c1post_title', esc_attr__( 'Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Complex 1 Title', 'wise-blog' ) ),
			Field::make("select", "wise_c1title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'back' => esc_attr__( 'Background', 'wise-blog' ),
					'light' => esc_attr__( 'Light', 'wise-blog' ),
				)),
			Field::make("select", "wise_c1post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_c1post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c1post_number, $wise_c1post_categ;
        $wise_c1post_title = $instance['wise_c1post_title'];
		$wise_c1title_type = $instance['wise_c1title_type'];
		$wise_c1post_categ = $instance['wise_c1post_categ'];
		$wise_c1post_number = $instance['wise_c1post_number'];
		
		$cat_id = get_cat_ID( $wise_c1post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( !empty($wise_c1post_title) ) : // if title is not empty
			if( $wise_c1title_type == 'light' ) {
				if( $wise_c1post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c1post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c1post_title) . '</h2></header>';
				}
			} else {
				if( $wise_c1post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c1post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c1post_title) . '</h2></header>';
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-1' ); ?>
		</div><?php endif;
    }
}

/* Home Complex 2 Block */
class HomeComplex2 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Complex 2 Block', 'wise-blog' ), esc_attr__( 'Displays complex 2 posts block.', 'wise-blog' ), array(
			// Complex 2-1
			Field::make("separator", "wise_comp_21", esc_attr__( 'Complex 2-1', 'wise-blog' ) ),
			Field::make('text', 'wise_c21post_title', esc_attr__( 'Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Complex 2-1 Title', 'wise-blog' ) ),
			Field::make("select", "wise_c21title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'back' => esc_attr__( 'Background', 'wise-blog' ),
					'light' => esc_attr__( 'Light', 'wise-blog' ),
				)),
			Field::make("select", "wise_c21post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_c21post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('5'),

			// Complex 2-2
			Field::make("separator", "wise_comp_22", esc_attr__( 'Complex 2-2', 'wise-blog' ) ),
			Field::make('text', 'wise_c22post_title', esc_attr__( 'Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Complex 2-2 Title', 'wise-blog') ),
			Field::make("select", "wise_c22title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'back' => esc_attr__( 'Background', 'wise-blog' ),
					'light' => esc_attr__( 'Light', 'wise-blog' ),
				)),
			Field::make("select", "wise_c22post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_c22post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		// Complex 2-1
		global $wise_c21post_number, $wise_c21post_categ;
        $wise_c21post_title = $instance['wise_c21post_title'];
		$wise_c21title_type = $instance['wise_c21title_type'];
		$wise_c21post_categ = $instance['wise_c21post_categ'];
		$wise_c21post_number = $instance['wise_c21post_number'];
		
		$cat_id1 = get_cat_ID( $wise_c21post_categ );
		$cat_url1 = get_category_link( $cat_id1 );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><div class="complex-design comp-1"><?php
		if( !empty($wise_c21post_title) ) : // if title is not empty
			if( $wise_c21title_type == 'light' ) {
				if( $wise_c21post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c21post_title) . '</h2></header>';
				}
			} else {
				if( $wise_c21post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url1) . '"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c21post_title) . '</h2></header>';
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-2-1' ); ?>
		</div><?php endif;
		
		// Complex 2-2
		global $wise_c22post_number, $wise_c22post_categ;
        $wise_c22post_title = $instance['wise_c22post_title'];
		$wise_c22title_type = $instance['wise_c22title_type'];
		$wise_c22post_categ = $instance['wise_c22post_categ'];
		$wise_c22post_number = $instance['wise_c22post_number'];
		
		$cat_id2 = get_cat_ID( $wise_c22post_categ );
		$cat_url2 = get_category_link( $cat_id2 );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design comp-2"><?php
		if( !empty($wise_c22post_title) ) : // if title is not empty
			if( $wise_c22title_type == 'light' ) {
				if( $wise_c22post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c22post_title) . '</h2></header>';
				}
			} else {
				if( $wise_c22post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url2) . '"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c22post_title) . '</h2></header>';
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-2-2' ); ?>
		</div></div><?php endif;
    }
}

/* Home Complex 3 Block */
class HomeComplex3 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Complex 3 Block', 'wise-blog' ), esc_attr__( 'Displays complex 3 posts block.', 'wise-blog' ), array(
			Field::make('text', 'wise_c3post_title', esc_attr__( 'Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Complex 3 Title', 'wise-blog' ) ),
			Field::make("select", "wise_c3title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'back' => esc_attr__( 'Background', 'wise-blog' ),
					'light' => esc_attr__( 'Light', 'wise-blog' ),
				)),
			Field::make("select", "wise_c3post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_c3post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('5'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c3post_number, $wise_c3post_categ;
        $wise_c3post_title = $instance['wise_c3post_title'];
		$wise_c3title_type = $instance['wise_c3title_type'];
		$wise_c3post_categ = $instance['wise_c3post_categ'];
		$wise_c3post_number = $instance['wise_c3post_number'];
		
		$cat_id = get_cat_ID( $wise_c3post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( !empty($wise_c3post_title) ) : // if title is not empty
			if( $wise_c3title_type == 'light' ) {
				if( $wise_c3post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c3post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c3post_title) . '</h2></header>';
				}
			} else {
				if( $wise_c3post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c3post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c3post_title) . '</h2></header>';
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-3' ); ?>
		</div><?php endif;
    }
}

/* Home Complex 4 Block */
class HomeComplex4 extends Widget {
	// Width of Widget
	protected $form_options = array(
		'width' => 400
	);
	
    // Register widget function. Must have the same name as the class
    function __construct() {
		global $wp_cats;
        $this->setup( esc_attr__( '#Home - Complex 4 Block', 'wise-blog' ), esc_attr__( 'Displays complex 4 posts block.', 'wise-blog' ), array(
			Field::make('text', 'wise_c4post_title', esc_attr__( 'Posts Title', 'wise-blog' ) )->set_default_value( esc_attr__( 'Complex 4 Title', 'wise-blog' ) ),
			Field::make("select", "wise_c4title_type", esc_attr__( 'Title Design', 'wise-blog' ) )
				->add_options(array(
					'back' => esc_attr__( 'Background', 'wise-blog' ),
					'light' => esc_attr__( 'Light', 'wise-blog' ),
				)),
			Field::make("select", "wise_c4post_categ", esc_attr__( 'Post Categories', 'wise-blog' ) )
				->add_options($wp_cats),
			Field::make('text', 'wise_c4post_number', esc_attr__( 'No. of Posts', 'wise-blog' ) )->set_default_value('6'),
        ));
		$this->print_wrappers = false; // disable wrapper
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance) {
		global $wise_c4post_number, $wise_c4post_categ;
        $wise_c4post_title = $instance['wise_c4post_title'];
		$wise_c4title_type = $instance['wise_c4title_type'];
		$wise_c4post_categ = $instance['wise_c4post_categ'];
		$wise_c4post_number = $instance['wise_c4post_number'];
		
		$cat_id = get_cat_ID( $wise_c4post_categ );
		$cat_url = get_category_link( $cat_id );
		
		if( !is_paged() ) : // Avoids pagination
		?><div class="complex-design"><?php
		if( !empty($wise_c4post_title) ) : // if title is not empty
			if( $wise_c4title_type == 'light' ) {
				if( $wise_c4post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title-archive">' . esc_html($wise_c4post_title) . '</h2></header>';
				}
			} else {
				if( $wise_c4post_categ == true ) {
					echo '<div class="complex-titles"><header class="page-header"><a href="' . esc_url($cat_url) . '"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></a></header></div>';
				} else {
					echo '<header class="page-header"><h2 class="page-title">' . esc_html($wise_c4post_title) . '</h2></header>';
				}
			}
		endif;
			get_template_part( 'templates/custom_templates/content', 'complex-4' ); ?>
		</div><?php endif;
    }
}

/* Register Widget */
register_widget('WiseTicker');
register_widget('HomeSlider');
register_widget('HomeDefaults');
register_widget('HomeComplex1');
register_widget('HomeComplex2');
register_widget('HomeComplex3');
register_widget('HomeComplex4');